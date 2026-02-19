<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? htmlspecialchars($title) : 'Velour CTRL' ?></title>
</head>
<body>
  <header style="padding:16px; border-bottom:1px solid #ddd;">
    <strong>Velour CTRL</strong>
    <nav style="margin-top:8px;">
      <a href="<?= BASE_URL ?>/">Accueil</a>
      <a href="<?= BASE_URL ?>/login" style="margin-left:12px;">Login</a>
      <a href="<?= BASE_URL ?>/register" style="margin-left:12px;">Register</a>
      <a href="<?= BASE_URL ?>/cart" style="margin-left:12px;">Panier</a>
      <?php if (!empty($_SESSION['user'])): ?>
      <span>Connecté : <?= htmlspecialchars($_SESSION['user']['username'] ?? 'Utilisateur') ?></span>
  |   <a href="<?= BASE_URL ?>/logout">Déconnexion</a>
      <?php else: ?>
      <a href="<?= BASE_URL ?>/login">Login</a>
      <a href="<?= BASE_URL ?>/register">Register</a>
    <?php endif; ?>

    </nav>
  </header>

  <main style="padding:16px;">
    <?= $content ?>
  </main>
</body>
</html>
