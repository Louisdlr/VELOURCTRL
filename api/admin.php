<?php

require_once __DIR__ . '/db.php';

/* =========================
   USERS
   ========================= */

/**
 * Récupère tous les utilisateurs
 */
function getAllUsers(): array
{
    global $db;

    $result = $db->query("
        SELECT id, username, email, balance, role, is_active, created_at
        FROM users
    ");

    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Active / désactive un utilisateur
 */
function setUserActive(int $userId, bool $isActive): bool
{
    global $db;

    $stmt = $db->prepare("
        UPDATE users
        SET is_active = ?
        WHERE id = ?
    ");

    $active = $isActive ? 1 : 0;
    $stmt->bind_param("ii", $active, $userId);
    return $stmt->execute();
}

/* =========================
   ARTICLES
   ========================= */

/**
 * Récupère tous les articles (actifs et inactifs)
 */
function getAllArticles(): array
{
    global $db;

    $result = $db->query("
        SELECT id, name, price, is_active, created_at
        FROM articles
    ");

    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Active / désactive un article
 */
function setArticleActive(int $articleId, bool $isActive): bool
{
    global $db;

    $stmt = $db->prepare("
        UPDATE articles
        SET is_active = ?
        WHERE id = ?
    ");

    $active = $isActive ? 1 : 0;
    $stmt->bind_param("ii", $active, $articleId);
    return $stmt->execute();
}

/* =========================
   STOCK
   ========================= */

/**
 * Met à jour le stock d’un article
 */
function updateStock(int $articleId, int $quantity): bool
{
    global $db;

    if ($quantity < 0) {
        return false;
    }

    $stmt = $db->prepare("
        UPDATE stock
        SET quantity = ?
        WHERE article_id = ?
    ");

    $stmt->bind_param("ii", $quantity, $articleId);
    return $stmt->execute();
}
