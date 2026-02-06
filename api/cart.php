<?php

require_once __DIR__ . '/db.php';

/**
 * Récupère le panier d’un utilisateur
 */
function getCartByUser(int $userId): array
{
    global $db;

    $stmt = $db->prepare("
        SELECT 
            a.id AS article_id,
            a.name,
            a.price,
            a.image_url,
            c.quantity,
            s.quantity AS stock
        FROM cart c
        JOIN articles a ON a.id = c.article_id
        JOIN stock s ON s.article_id = a.id
        WHERE c.user_id = ?
          AND a.is_active = 1
    ");

    $stmt->bind_param("i", $userId);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

/**
 * Ajoute un article au panier
 */
function addToCart(int $userId, int $articleId, int $quantity = 1): bool
{
    global $db;

    // Vérifier article actif + stock
    $stmt = $db->prepare("
        SELECT s.quantity
        FROM articles a
        JOIN stock s ON s.article_id = a.id
        WHERE a.id = ? AND a.is_active = 1
    ");

    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (!$result || $quantity > $result['quantity']) {
        return false;
    }

    // Ajouter ou mettre à jour
    $stmt = $db->prepare("
        INSERT INTO cart (user_id, article_id, quantity)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)
    ");

    $stmt->bind_param("iii", $userId, $articleId, $quantity);
    return $stmt->execute();
}

/**
 * Met à jour la quantité d’un article
 */
function updateCartQuantity(int $userId, int $articleId, int $quantity): bool
{
    global $db;

    if ($quantity <= 0) {
        return removeFromCart($userId, $articleId);
    }

    // Vérifier stock
    $stmt = $db->prepare("
        SELECT quantity
        FROM stock
        WHERE article_id = ?
    ");

    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $stock = $stmt->get_result()->fetch_assoc();

    if (!$stock || $quantity > $stock['quantity']) {
        return false;
    }

    $stmt = $db->prepare("
        UPDATE cart
        SET quantity = ?
        WHERE user_id = ? AND article_id = ?
    ");

    $stmt->bind_param("iii", $quantity, $userId, $articleId);
    return $stmt->execute();
}

/**
 * Supprime un article du panier
 */
function removeFromCart(int $userId, int $articleId): bool
{
    global $db;

    $stmt = $db->prepare("
        DELETE FROM cart
        WHERE user_id = ? AND article_id = ?
    ");

    $stmt->bind_param("ii", $userId, $articleId);
    return $stmt->execute();
}

/**
 * Vide le panier d’un utilisateur
 */
function clearCart(int $userId): bool
{
    global $db;

    $stmt = $db->prepare("
        DELETE FROM cart
        WHERE user_id = ?
    ");

    $stmt->bind_param("i", $userId);
    return $stmt->execute();
}
