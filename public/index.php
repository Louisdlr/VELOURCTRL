<?php
session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri !== '/' && str_ends_with($uri, '/')) {
    $uri = rtrim($uri, '/');
}

function render(string $view, array $data = []): void
{
    extract($data);

    ob_start();
    require __DIR__ . '/../views/' . $view . '.php';
    $content = ob_get_clean();

    require __DIR__ . '/../views/layout.php';
    exit;
}

if ($uri === '/') {
    render('home', ['title' => 'Accueil']);
}

http_response_code(404);
render('home', ['title' => '404 - Page introuvable']);
