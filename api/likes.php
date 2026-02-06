<?php

require_once __DIR__ . '/db.php';

/**
 * Vérifie si un utilisateur a liké un article
 */
function hasUserLiked(int $userId, int $articleId): bool
{
    global $db;

    $stmt = $db->prepare("
        SELECT 1
        FROM likes
        WHERE user_id = ? AND article_id = ?
        LIMIT 1
    ");

    $stmt->bind_param("ii", $userId, $articleId);
    $stmt->execute();

    return $stmt->get_result()->num_rows > 0;
}

/**
 * Ajoute un like
 */
function addLike(int $userId, int $articleId): bool
{
    global $db;

    $stmt = $db->prepare("
        INSERT IGNORE INTO likes (user_id, article_id)
        VALUES (?, ?)
    ");

    $stmt->bind_param("ii", $userId, $articleId);
    return $stmt->execute();
}

/**
 * Supprime un like
 */
function removeLike(int $userId, int $articleId): bool
{
    global $db;

    $stmt = $db->prepare("
        DELETE FROM likes
        WHERE user_id = ? AND article_id = ?
    ");

    $stmt->bind_param("ii", $userId, $articleId);
    return $stmt->execute();
}

/**
 * Compte les likes d’un article
 */
function countLikes(int $articleId): int
{
    global $db;

    $stmt = $db->prepare("
        SELECT COUNT(*) AS total
        FROM likes
        WHERE article_id = ?
    ");

    $stmt->bind_param("i", $articleId);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
    return (int) $result['total'];
}
