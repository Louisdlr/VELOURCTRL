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

function require_login(): void {
  if (empty($_SESSION['user']['id'])) {
    header('Location: ' . BASE_URL . '/login');
    exit;
  }
}

function is_admin(): bool {
  return !empty($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'ADMIN';
}

function require_admin(): void {
  require_login();
  if (!is_admin()) {
    http_response_code(403);
    render('home', ['title' => 'Accès interdit']);
  }
}

// =========================
// ROUTES
// =========================

// HOME : n'affiche que les articles actifs
if ($uri === '/') {
    $pdo = db();
    $stmt = $pdo->query("SELECT * FROM articles WHERE IFNULL(is_active,1)=1 ORDER BY id DESC");
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

// DETAIL : bloque un article désactivé si pas admin/proprio
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

    $isActive = (int)($article['is_active'] ?? 1);
    $ownerId = (int)($article['user_id'] ?? 0);
    $meId = (int)($_SESSION['user']['id'] ?? 0);

    if ($isActive !== 1 && !is_admin() && $ownerId !== $meId) {
        http_response_code(404);
        render('home', ['title' => 'Article introuvable']);
    }

    render('detail', [
        'title' => 'Détail article',
        'article' => $article
    ]);
}

// =========================
// CART (session)
// =========================
if (preg_match('#^/cart/add/([0-9]+)$#', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = (int) $matches[1];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; // [id => qty]
    }

    $_SESSION['cart'][$articleId] = ($_SESSION['cart'][$articleId] ?? 0) + 1;

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
        if ($_SESSION['cart'][$articleId] <= 0) unset($_SESSION['cart'][$articleId]);
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

        $stmt = $pdo->prepare("SELECT id, name, price, image_url, is_active FROM articles WHERE id IN ($placeholders)");
        $stmt->execute($ids);
        $articles = $stmt->fetchAll();

        $byId = [];
        foreach ($articles as $a) $byId[(int)$a['id']] = $a;

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
                'line_total' => $lineTotal,
                'is_active' => (int)($byId[$id]['is_active'] ?? 1),
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

// VALIDATION PANIER
if ($uri === '/cart/validate' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_SESSION['user']['id'])) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    $userId = (int)$_SESSION['user']['id'];
    $cart = $_SESSION['cart'] ?? [];

    if (empty($cart)) {
        header('Location: ' . BASE_URL . '/cart');
        exit;
    }

    $pdo = db();
    $pdo->beginTransaction();

    try {
        $ids = array_keys($cart);
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $stmt = $pdo->prepare("
            SELECT a.id, a.name, a.price, IFNULL(a.is_active,1) AS is_active, COALESCE(s.quantity, 0) AS quantity
            FROM articles a
            LEFT JOIN stock s ON s.article_id = a.id
            WHERE a.id IN ($placeholders)
            FOR UPDATE
        ");
        $stmt->execute($ids);
        $rows = $stmt->fetchAll();

        $byId = [];
        foreach ($rows as $r) $byId[(int)$r['id']] = $r;

        $total = 0;
        foreach ($cart as $id => $qty) {
            $id = (int)$id;
            $qty = (int)$qty;

            if (!isset($byId[$id])) throw new Exception("Article introuvable (id=$id)");

            if ((int)$byId[$id]['is_active'] !== 1) {
                throw new Exception("Article désactivé: " . $byId[$id]['name']);
            }

            $available = (int)$byId[$id]['quantity'];
            if ($qty > $available) throw new Exception("Stock insuffisant pour: " . $byId[$id]['name']);

            $total += ((float)$byId[$id]['price']) * $qty;
        }

        $billingAddress = trim($_POST['billing_address'] ?? 'Adresse inconnue');
        $billingCity = trim($_POST['billing_city'] ?? 'Ville');
        $billingPostal = trim($_POST['billing_postal_code'] ?? '00000');

        $stmtInv = $pdo->prepare("
            INSERT INTO invoices (user_id, total_amount, billing_address, billing_city, billing_postal_code)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmtInv->execute([$userId, $total, $billingAddress, $billingCity, $billingPostal]);
        $invoiceId = (int)$pdo->lastInsertId();

        $stmtItem = $pdo->prepare("
            INSERT INTO invoice_items (invoice_id, article_id, quantity, price_at_purchase)
            VALUES (?, ?, ?, ?)
        ");
        $stmtStock = $pdo->prepare("UPDATE stock SET quantity = quantity - ? WHERE article_id = ?");

        foreach ($cart as $id => $qty) {
            $id = (int)$id;
            $qty = (int)$qty;
            $price = (float)$byId[$id]['price'];

            $stmtItem->execute([$invoiceId, $id, $qty, $price]);
            $stmtStock->execute([$qty, $id]);
        }

        $pdo->commit();

        unset($_SESSION['cart']);
        header('Location: ' . BASE_URL . '/invoice/' . $invoiceId);
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['cart_error'] = $e->getMessage();
        header('Location: ' . BASE_URL . '/cart');
        exit;
    }
}

// =========================
// AUTH
// =========================
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

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ((int)$stmt->fetchColumn() > 0) $errors[] = "Nom d'utilisateur déjà utilisé.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ((int)$stmt->fetchColumn() > 0) $errors[] = "Email déjà utilisé.";
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
        'email' => $email,
        'role' => 'USER'
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
        'email' => $user['email'] ?? '',
        'role' => $user['role'] ?? 'USER'
    ];

    header('Location: ' . BASE_URL . '/');
    exit;
}

if ($uri === '/logout') {
    unset($_SESSION['user']);
    header('Location: ' . BASE_URL . '/');
    exit;
}

// =========================
// INVOICE
// =========================
if (preg_match('#^/invoice/([0-9]+)$#', $uri, $m)) {
  require_login();
  $invoiceId = (int)$m[1];
  $pdo = db();

  $stmt = $pdo->prepare("SELECT * FROM invoices WHERE id = ?");
  $stmt->execute([$invoiceId]);
  $invoice = $stmt->fetch();

  if (!$invoice) {
    http_response_code(404);
    render('home', ['title' => 'Facture introuvable']);
  }

  if (!is_admin() && (int)$invoice['user_id'] !== (int)$_SESSION['user']['id']) {
    http_response_code(403);
    render('home', ['title' => 'Accès interdit']);
  }

  $stmt = $pdo->prepare("
    SELECT ii.quantity, ii.price_at_purchase, a.name
    FROM invoice_items ii
    JOIN articles a ON a.id = ii.article_id
    WHERE ii.invoice_id = ?
  ");
  $stmt->execute([$invoiceId]);
  $items = $stmt->fetchAll();

  render('invoice', [
    'title' => 'Facture #' . $invoiceId,
    'invoice' => $invoice,
    'items' => $items
  ]);
}

// =========================
// ACCOUNT / EDIT (inchangé chez toi)
// =========================
if ($uri === '/account') {
  require_login();
  $pdo = db();

  $targetId = isset($_GET['id']) ? (int)$_GET['id'] : (int)$_SESSION['user']['id'];

  $stmt = $pdo->prepare("SELECT id, username, email, balance, role, created_at FROM users WHERE id = ?");
  $stmt->execute([$targetId]);
  $target = $stmt->fetch();
  if (!$target) {
    http_response_code(404);
    render('home', ['title' => 'Utilisateur introuvable']);
  }

  $stmt = $pdo->prepare("SELECT * FROM articles WHERE user_id = ? ORDER BY id DESC");
  $stmt->execute([$targetId]);
  $posted = $stmt->fetchAll();

  $isMe = ($targetId === (int)$_SESSION['user']['id']);

  $invoices = [];
  if ($isMe) {
    $stmt = $pdo->prepare("SELECT * FROM invoices WHERE user_id = ? ORDER BY id DESC");
    $stmt->execute([$targetId]);
    $invoices = $stmt->fetchAll();
  }

  render('account', [
    'title' => 'Compte',
    'target' => $target,
    'posted' => $posted,
    'isMe' => $isMe,
    'invoices' => $invoices
  ]);
}

if ($uri === '/account/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_login();
  $pdo = db();
  $userId = (int)$_SESSION['user']['id'];

  $email = trim($_POST['email'] ?? '');
  $password = (string)($_POST['password'] ?? '');

  if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
    $stmt->execute([$email, $userId]);
    $_SESSION['user']['email'] = $email;
  }

  if ($password !== '' && strlen($password) >= 6) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute([$hash, $userId]);
  }

  header('Location: ' . BASE_URL . '/account');
  exit;
}

if ($uri === '/account/add-balance' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_login();
  $pdo = db();
  $userId = (int)$_SESSION['user']['id'];

  $amount = (float)($_POST['amount'] ?? 0);
  if ($amount > 0) {
    $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
    $stmt->execute([$amount, $userId]);
  }
  header('Location: ' . BASE_URL . '/account');
  exit;
}

// EDIT (tes routes inchangées)
if (preg_match('#^/edit/open/([0-9]+)$#', $uri, $m) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_login();
  $id = (int)$m[1];
  $pdo = db();

  $stmt = $pdo->prepare("SELECT * FROM articles WHERE id=?");
  $stmt->execute([$id]);
  $article = $stmt->fetch();
  if (!$article) { http_response_code(404); render('home',['title'=>'Article introuvable']); }

  $ownerId = (int)($article['user_id'] ?? 0);
  if (!is_admin() && $ownerId !== (int)$_SESSION['user']['id']) {
    http_response_code(403);
    render('home', ['title' => 'Accès interdit']);
  }

  render('edit', ['title'=>'Modifier', 'article'=>$article]);
}

if (preg_match('#^/edit/([0-9]+)$#', $uri, $m) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_login();
  $id = (int)$m[1];
  $pdo = db();

  $stmt = $pdo->prepare("SELECT * FROM articles WHERE id=?");
  $stmt->execute([$id]);
  $article = $stmt->fetch();
  if (!$article) { http_response_code(404); render('home',['title'=>'Article introuvable']); }

  $ownerId = (int)($article['user_id'] ?? 0);
  if (!is_admin() && $ownerId !== (int)$_SESSION['user']['id']) {
    http_response_code(403);
    render('home', ['title' => 'Accès interdit']);
  }

  $name = trim($_POST['name'] ?? '');
  $desc = trim($_POST['description'] ?? '');
  $price = (float)($_POST['price'] ?? 0);
  $img = trim($_POST['image_url'] ?? '');
  $active = !empty($_POST['is_active']) ? 1 : 0;

  $stmt = $pdo->prepare("UPDATE articles SET name=?, description=?, price=?, image_url=?, is_active=? WHERE id=?");
  $stmt->execute([$name, $desc, $price, ($img===''?null:$img), $active, $id]);

  header('Location: ' . BASE_URL . '/detail/' . $id);
  exit;
}

if (preg_match('#^/edit/([0-9]+)/delete$#', $uri, $m) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_login();
  $id = (int)$m[1];
  $pdo = db();

  $stmt = $pdo->prepare("SELECT user_id FROM articles WHERE id=?");
  $stmt->execute([$id]);
  $row = $stmt->fetch();
  if (!$row) { http_response_code(404); render('home',['title'=>'Article introuvable']); }

  if (!is_admin() && (int)$row['user_id'] !== (int)$_SESSION['user']['id']) {
    http_response_code(403);
    render('home', ['title' => 'Accès interdit']);
  }

  $stmt = $pdo->prepare("DELETE FROM articles WHERE id=?");
  $stmt->execute([$id]);

  header('Location: ' . BASE_URL . '/');
  exit;
}

// =========================
// ADMIN
// =========================
if ($uri === '/admin') {
  require_admin();
  render('admin/dashboard', ['title' => 'Admin']);
}

if ($uri === '/admin/articles') {
  require_admin();
  $pdo = db();
  $rows = $pdo->query("
    SELECT a.*, u.username
    FROM articles a
    LEFT JOIN users u ON u.id = a.user_id
    ORDER BY a.id DESC
  ")->fetchAll();

  render('admin/articles', ['title'=>'Admin Articles', 'articles'=>$rows]);
}

// ✅ CREATE ARTICLE (admin)
if ($uri === '/admin/articles/create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_admin();
  $pdo = db();

  $name = trim($_POST['name'] ?? '');
  $desc = trim($_POST['description'] ?? '');
  $price = (float)($_POST['price'] ?? 0);
  $img = trim($_POST['image_url'] ?? '');
  $active = !empty($_POST['is_active']) ? 1 : 0;
  $stockQty = (int)($_POST['stock_qty'] ?? 0);

  if ($name === '' || $desc === '' || $price <= 0 || $stockQty < 0) {
    $_SESSION['admin_error'] = "Champs invalides (nom/description/prix/stock).";
    header('Location: ' . BASE_URL . '/admin/articles');
    exit;
  }

  $pdo->beginTransaction();
  try {
    $stmt = $pdo->prepare("INSERT INTO articles (user_id, name, description, price, image_url, is_active) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([(int)$_SESSION['user']['id'], $name, $desc, $price, ($img===''?null:$img), $active]);
    $articleId = (int)$pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO stock (article_id, quantity) VALUES (?, ?)");
    $stmt->execute([$articleId, $stockQty]);

    $pdo->commit();
    header('Location: ' . BASE_URL . '/admin/articles');
    exit;
  } catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['admin_error'] = "Erreur création article: " . $e->getMessage();
    header('Location: ' . BASE_URL . '/admin/articles');
    exit;
  }
}

// ✅ TOGGLE ACTIVE (robuste)
if (preg_match('#^/admin/articles/toggle-active/([0-9]+)$#', $uri, $m) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_admin();
  $id = (int)$m[1];
  $pdo = db();

  $pdo->prepare("UPDATE articles SET is_active = IF(IFNULL(is_active,1)=1,0,1) WHERE id = ?")->execute([$id]);

  header('Location: ' . BASE_URL . '/admin/articles');
  exit;
}

if (preg_match('#^/admin/articles/delete/([0-9]+)$#', $uri, $m) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_admin();
  $id = (int)$m[1];
  $pdo = db();

  $pdo->prepare("DELETE FROM articles WHERE id = ?")->execute([$id]);

  header('Location: ' . BASE_URL . '/admin/articles');
  exit;
}

if ($uri === '/admin/users') {
  require_admin();
  $pdo = db();
  $users = $pdo->query("SELECT id, username, email, balance, role, is_active, created_at FROM users ORDER BY id DESC")->fetchAll();
  render('admin/users', ['title'=>'Admin Users', 'users'=>$users]);
}

// 404
http_response_code(404);
render('home', ['title' => '404 - Page introuvable']);