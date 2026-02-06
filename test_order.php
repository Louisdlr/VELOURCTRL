<?php

require_once __DIR__ . '/api/orders.php';

$userId = 1;

$result = placeOrder(
    $userId,
    "12 rue du Rap",
    "Paris",
    "75001"
);

var_dump($result);
