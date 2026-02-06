<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/cart.php';

/**
 * Passe une commande pour un utilisateur
 */
function placeOrder(
    int $userId,
    string $billingAddress,
    string $billingCity,
    string $billingPostalCode
): bool {
    global $db;

    // 1. Récupérer le panier
    $cartItems = getCartByUser($userId);

    if (empty($cartItems)) {
        return false;
    }

    // 2. Vérifier stock + calcul total
    $totalAmount = 0;

    foreach ($cartItems as $item) {
        if ($item['quantity'] > $item['stock']) {
            return false;
        }
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // 3. Vérifier solde utilisateur
    $stmt = $db->prepare("
        SELECT balance
        FROM users
        WHERE id = ? AND is_active = 1
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if (!$user || $user['balance'] < $totalAmount) {
        return false;
    }

    // 4. Transaction
    $db->begin_transaction();

    try {
        // 5. Créer la facture
        $stmt = $db->prepare("
            INSERT INTO invoices (user_id, total_amount, billing_address, billing_city, billing_postal_code)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "idsss",
            $userId,
            $totalAmount,
            $billingAddress,
            $billingCity,
            $billingPostalCode
        );
        $stmt->execute();

        $invoiceId = $db->insert_id;

        // 6. Lignes facture + décrément stock
        foreach ($cartItems as $item) {
            $stmt = $db->prepare("
                INSERT INTO invoice_items (invoice_id, article_id, quantity, price_at_purchase)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->bind_param(
                "iiid",
                $invoiceId,
                $item['article_id'],
                $item['quantity'],
                $item['price']
            );
            $stmt->execute();

            $stmt = $db->prepare("
                UPDATE stock
                SET quantity = quantity - ?
                WHERE article_id = ?
            ");
            $stmt->bind_param(
                "ii",
                $item['quantity'],
                $item['article_id']
            );
            $stmt->execute();
        }

        // 7. Débiter solde
        $stmt = $db->prepare("
            UPDATE users
            SET balance = balance - ?
            WHERE id = ?
        ");
        $stmt->bind_param("di", $totalAmount, $userId);
        $stmt->execute();

        // 8. Vider panier
        clearCart($userId);

        // 9. Commit
        $db->commit();
        return true;

    } catch (Exception $e) {
        $db->rollback();
        return false;
    }
}
