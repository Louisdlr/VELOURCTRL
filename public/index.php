<?php
require __DIR__ . '/../config/config.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Supprime le chemin de base du projet (XAMPP)
$basePath = BASE_URL;
if (str_starts_with($uri, $basePath)) {
    $uri = substr($uri, strlen($basePath));
    if ($uri === '') {
        $uri = '/';
    }
}

// Normalisation (retire le trailing slash sauf pour "/")
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

// ROUTES
if ($uri === '/') {
    $pdo = db();

    $stmt = $pdo->query("SELECT * FROM articles ORDER BY id DESC");
    $articles = $stmt->fetchAll();

    render('home', [
        'title' => 'Accueil',
        'articles' => $articles
    ]);
}


if ($uri === '/db-test') {
    $pdo = db();
    $ok = $pdo->query("SELECT 1")->fetchColumn();
    render('home', ['title' => 'DB OK', 'db_ok' => $ok]);
}
if (preg_match('#^/detail/([0-9]+)$#', $uri, $matches)) {
    $articleId = (int) $matches[1];

    $pdo = db();

    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->execute([$articleId]);
    $article = $stmt->fetch();

    if (!$article) {
        http_response_code(404);
        render('home', ['title' => 'Article introuvable']);
    }

    render('detail', [
        'title' => 'Détail article',
        'article' => $article
    ]);
}

if (preg_match('#^/cart/add/([0-9]+)$#', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = (int) $matches[1];

    // Initialise panier
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; // [id => qty]
    }

    // Ajoute +1
    if (!isset($_SESSION['cart'][$articleId])) {
        $_SESSION['cart'][$articleId] = 1;
    } else {
        $_SESSION['cart'][$articleId] += 1;
    }

    // Retour au détail
    header('Location: ' . BASE_URL . '/detail/' . $articleId);
    exit;
}

if (preg_match('#^/cart/inc/([0-9]+)$#', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = (int) $matches[1];
    $_SESSION['cart'] = $_SESSION['cart'] ?? [];

    $_SESSION['cart'][$articleId] = ($_SESSION['cart'][$articleId] ?? 0) + 1;

    header('Location: ' . BASE_URL . '/cart');
    exit;
}

if (preg_match('#^/cart/dec/([0-9]+)$#', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = (int) $matches[1];
    $_SESSION['cart'] = $_SESSION['cart'] ?? [];

    if (isset($_SESSION['cart'][$articleId])) {
        $_SESSION['cart'][$articleId] -= 1;
        if ($_SESSION['cart'][$articleId] <= 0) {
            unset($_SESSION['cart'][$articleId]);
        }
    }

    header('Location: ' . BASE_URL . '/cart');
    exit;
}

if (preg_match('#^/cart/remove/([0-9]+)$#', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = (int) $matches[1];
    $_SESSION['cart'] = $_SESSION['cart'] ?? [];

    unset($_SESSION['cart'][$articleId]);

    header('Location: ' . BASE_URL . '/cart');
    exit;
}

if ($uri === '/cart/clear' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['cart']);
    header('Location: ' . BASE_URL . '/cart');
    exit;
}


if ($uri === '/cart') {
    $pdo = db();

    $cart = $_SESSION['cart'] ?? []; // [id => qty]
    $items = [];
    $total = 0;

    if (!empty($cart)) {
        $ids = array_keys($cart);
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $stmt = $pdo->prepare("SELECT id, name, price, image_url FROM articles WHERE id IN ($placeholders)");
        $stmt->execute($ids);
        $articles = $stmt->fetchAll();

        // Index par id
        $byId = [];
        foreach ($articles as $a) {
            $byId[(int)$a['id']] = $a;
        }

        foreach ($cart as $id => $qty) {
            $id = (int)$id;
            $qty = (int)$qty;

            if (!isset($byId[$id])) continue;

            $price = (float)($byId[$id]['price'] ?? 0);
            $lineTotal = $price * $qty;
            $total += $lineTotal;

            $items[] = [
                'id' => $id,
                'name' => $byId[$id]['name'] ?? 'Article',
                'price' => $price,
                'image_url' => $byId[$id]['image_url'] ?? null,
                'qty' => $qty,
                'line_total' => $lineTotal
            ];
        }
    }
    $error = $_SESSION['cart_error'] ?? null;
    unset($_SESSION['cart_error']);

    render('cart', [
        'title' => 'Panier',
        'items' => $items,
        'total' => $total,
        'error' => $error
    ]);
}

if ($uri === '/cart/validate' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1) être connecté
    if (empty($_SESSION['user']['id'])) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    $userId = (int)$_SESSION['user']['id'];
    $cart = $_SESSION['cart'] ?? [];

    // 2) panier non vide
    if (empty($cart)) {
        header('Location: ' . BASE_URL . '/cart');
        exit;
    }

    $pdo = db();
    $pdo->beginTransaction();

    try {
        $ids = array_keys($cart);
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        // 3) récup articles + stock
        $stmt = $pdo->prepare("
            SELECT a.id, a.name, a.price, COALESCE(s.quantity, 0) AS quantity
            FROM articles a
            LEFT JOIN stock s ON s.article_id = a.id
            WHERE a.id IN ($placeholders)
            FOR UPDATE
        ");
        $stmt->execute($ids);
        $rows = $stmt->fetchAll();

        // index par id
        $byId = [];
        foreach ($rows as $r) {
            $byId[(int)$r['id']] = $r;
        }

        // vérif stock + total
        $total = 0;
        foreach ($cart as $id => $qty) {
            $id = (int)$id;
            $qty = (int)$qty;

            if (!isset($byId[$id])) {
                throw new Exception("Article introuvable (id=$id)");
            }

            $available = (int)$byId[$id]['quantity'];
            if ($qty > $available) {
                throw new Exception("Stock insuffisant pour: " . $byId[$id]['name']);
            }

            $total += ((float)$byId[$id]['price']) * $qty;
        }

        // 4) créer invoice
        // (adresse facturation simple pour l'instant)
        $billingAddress = trim($_POST['billing_address'] ?? 'Adresse inconnue');
        $billingCity = trim($_POST['billing_city'] ?? 'Ville');
        $billingPostal = trim($_POST['billing_postal_code'] ?? '00000');

        $stmtInv = $pdo->prepare("
            INSERT INTO invoices (user_id, total_amount, billing_address, billing_city, billing_postal_code)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmtInv->execute([$userId, $total, $billingAddress, $billingCity, $billingPostal]);
        $invoiceId = (int)$pdo->lastInsertId();

        // 5) invoice_items + 6) décrément stock
        $stmtItem = $pdo->prepare("
            INSERT INTO invoice_items (invoice_id, article_id, quantity, price_at_purchase)
            VALUES (?, ?, ?, ?)
        ");
        $stmtStock = $pdo->prepare("
            UPDATE stock SET quantity = quantity - ? WHERE article_id = ?
        ");

        foreach ($cart as $id => $qty) {
            $id = (int)$id;
            $qty = (int)$qty;
            $price = (float)$byId[$id]['price'];

            $stmtItem->execute([$invoiceId, $id, $qty, $price]);
            $stmtStock->execute([$qty, $id]);
        }

        $pdo->commit();

        // 7) vider panier
        unset($_SESSION['cart']);

        // 8) confirmation
        render('cart_validate', [
            'title' => 'Commande validée',
            'invoice_id' => $invoiceId,
            'total' => $total
        ]);

   } catch (Exception $e) {
    $pdo->rollBack();

    // On garde le panier (session) et on affiche l'erreur sur /cart
    $_SESSION['cart_error'] = $e->getMessage();
    header('Location: ' . BASE_URL . '/cart');
    exit;
    }
}


if ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    render('auth/register', ['title' => 'Inscription', 'errors' => []]);
}

if ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = db();

    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $pass     = (string)($_POST['password'] ?? '');

    $errors = [];
    if ($username === '') $errors[] = "Nom d'utilisateur obligatoire.";
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
    if (strlen($pass) < 6) $errors[] = "Mot de passe trop court (min 6).";

    // username unique
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ((int)$stmt->fetchColumn() > 0) {
            $errors[] = "Nom d'utilisateur déjà utilisé.";
        }
    }

    // email unique
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ((int)$stmt->fetchColumn() > 0) {
            $errors[] = "Email déjà utilisé.";
        }
    }

    if (!empty($errors)) {
        render('auth/register', [
            'title' => 'Inscription',
            'errors' => $errors,
            'old' => ['username' => $username, 'email' => $email]
        ]);
    }

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hash]);

    $_SESSION['user'] = [
        'id' => (int)$pdo->lastInsertId(),
        'username' => $username,
        'email' => $email
    ];

    header('Location: ' . BASE_URL . '/');
    exit;
}


if ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    render('auth/login', ['title' => 'Connexion', 'errors' => []]);
}

if ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = db();

    $email = trim($_POST['email'] ?? '');
    $pass  = (string)($_POST['password'] ?? '');

    $errors = [];
    if ($email === '' || $pass === '') {
        $errors[] = "Email et mot de passe obligatoires.";
        render('auth/login', ['title' => 'Connexion', 'errors' => $errors]);
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1 LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($pass, $user['password'])) {
        $errors[] = "Identifiants invalides.";
        render('auth/login', ['title' => 'Connexion', 'errors' => $errors]);
    }

    $_SESSION['user'] = [
        'id' => (int)$user['id'],
        'username' => $user['username'] ?? '',
        'email' => $user['email'] ?? ''
    ];

    header('Location: ' . BASE_URL . '/');
    exit;
}

if ($uri === '/logout') {
    unset($_SESSION['user']);
    header('Location: ' . BASE_URL . '/');
    exit;
}


// 404
http_response_code(404);
render('home', ['title' => '404 - Page introuvable']);
