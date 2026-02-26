<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Détection page actuelle via URL
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentPath = str_replace(BASE_URL, '', $currentPath);
$currentPath = trim($currentPath, '/');

if ($currentPath === '') {
    $currentPath = 'home';
}

// Gestion utilisateur
$user = $_SESSION['user'] ?? null;
$isAdmin = $user && ($user['role'] === 'ADMIN');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>VELOUR CTRL</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<div id="app">
    <!-- BACKGROUND EFFECTS -->
    <div class="bg-mesh"></div>
    <div class="grid-overlay"></div>
    
    <nav>

        <a href="<?= BASE_URL ?>" class="logo">
            Velour
        </a>

        <div class="nav-links">

            <a href="<?= BASE_URL ?>"
               class="nav-item <?= ($currentPath === 'home') ? 'active' : '' ?>">
                Collection
            </a>

            <?php if ($isAdmin): ?>
                <a href="<?= BASE_URL ?>/admin"
                   class="nav-item <?= ($currentPath === 'admin') ? 'active' : '' ?>">
                    System_Admin
                </a>
            <?php endif; ?>

            <?php if (!$user): ?>

                <a href="<?= BASE_URL ?>/login"
                   class="nav-item <?= ($currentPath === 'login') ? 'active' : '' ?>">
                    Login
                </a>

                <a href="<?= BASE_URL ?>/register"
                   class="nav-item <?= ($currentPath === 'register') ? 'active' : '' ?>">
                    Register
                </a>

            <?php else: ?>

                <a href="<?= BASE_URL ?>/account"
                   class="nav-item <?= ($currentPath === 'account') ? 'active' : '' ?>">
                    <?= htmlspecialchars($user['username']) ?>
                </a>

                <a href="<?= BASE_URL ?>/logout" class="nav-item">
                    Logout
                </a>

            <?php endif; ?>

            <a href="<?= BASE_URL ?>/cart"
               class="nav-item <?= ($currentPath === 'cart') ? 'active' : '' ?>">
                Cart
                <span class="cart-indicator">
                    [<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>]
                </span>
            </a>

        </div>

    </nav>

    <main>
        <?= $content ?>
    </main>

    <footer class="footer">

        <div class="footer-grid">

            <div class="footer-brand">
                <div class="footer-logo">VELOUR™</div>
                <p>
                    High-fidelity streetwear for the post-digital age.  
                    Limited drops engineered for the underground.
                </p>
            </div>

            <div class="footer-links">
                <h4>COLLECTION</h4>
                <a href="<?= BASE_URL ?>/">All Products</a>
                <a href="#">Limited Drops</a>
                <a href="#">Accessories</a>
                <a href="#">Albums</a>
            </div>

            <div class="footer-links">
                <h4>ACCOUNT</h4>
                <a href="<?= BASE_URL ?>/login">Login</a>
                <a href="<?= BASE_URL ?>/register">Register</a>
                <a href="<?= BASE_URL ?>/account">My Account</a>
                <a href="<?= BASE_URL ?>/cart">Cart</a>
            </div>

            <div class="footer-links">
                <h4>SYSTEM</h4>
                <a href="#">Terms</a>
                <a href="#">Privacy</a>
                <a href="#">Support</a>
                <a href="#">Contact</a>
            </div>

        </div>

        <div class="footer-bottom">
            <span>EST. 2024 — ZURICH / TOKYO</span>
            <span>CYBER OPULENCE DIVISION V.2025</span>
        </div>

    </footer>

</div>

</body>
</html>