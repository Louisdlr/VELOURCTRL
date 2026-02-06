<?php

require_once __DIR__ . '/api/admin.php';

// Désactiver un utilisateur
setUserActive(1, false);

// Désactiver un article
setArticleActive(1, false);

// Modifier le stock
updateStock(1, 20);

var_dump(getAllUsers());
var_dump(getAllArticles());
