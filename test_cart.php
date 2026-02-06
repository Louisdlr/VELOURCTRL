<?php

require_once __DIR__ . '/api/cart.php';

// ⚠️ adapte avec un user_id et article_id EXISTANTS
$userId = 1;
$articleId = 1;

addToCart($userId, $articleId, 1);
updateCartQuantity($userId, $articleId, 2);

var_dump(getCartByUser($userId));
