<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/likes.php';


/**
 * Récupère un article avec son nombre de likes
 */
function getArticleWithLikes(int $articleId): ?array
{
    $article = getArticleById($articleId);

    if (!$article) {
        return null;
    }

    $article['likes'] = countLikes($articleId);
    return $article;
}

/**
 * Catalogue complet avec likes
 */
function getActiveArticlesWithLikes(): array
{
    $articles = getActiveArticles();

    foreach ($articles as &$article) {
        $article['likes'] = countLikes($article['id']);
    }

    return $articles;
}


/**
 * Récupère tous les articles actifs avec leur stock
 */
function getActiveArticles(): array
{
    global $db;

    $sql = "
        SELECT 
            a.id,
            a.name,
            a.description,
            a.price,
            a.image_url,
            a.created_at,
            s.quantity
        FROM articles a
        JOIN stock s ON s.article_id = a.id
        WHERE a.is_active = 1
    ";

    $result = $db->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Récupère un article actif par ID
 */
function getArticleById(int $articleId): ?array
{
    global $db;

    $stmt = $db->prepare("
        SELECT 
            a.id,
            a.name,
            a.description,
            a.price,
            a.image_url,
            a.created_at,
            s.quantity
        FROM articles a
        JOIN stock s ON s.article_id = a.id
        WHERE a.id = ? AND a.is_active = 1
    ");

    $stmt->bind_param("i", $articleId);
    $stmt->execute();

    $result = $stmt->get_result();
    $article = $result->fetch_assoc();

    return $article ?: null;
}