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
    <nav style="margin-bottom:20px;">
  <a href="<?= BASE_URL ?>/">Accueil</a>
  <a href="<?= BASE_URL ?>/cart">Panier</a>

   <a href="<?= BASE_URL ?>/article/new">Créer un article</a>

  <?php if (!empty($_SESSION['user'])): ?>
    <a href="<?= BASE_URL ?>/account">Compte</a>

    <?php if (!empty($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'ADMIN'): ?>
      <a href="<?= BASE_URL ?>/admin">Admin</a>
    <?php endif; ?>

    <span>Connecté : <?= htmlspecialchars($_SESSION['user']['username'] ?? 'Utilisateur') ?></span>
    | <a href="<?= BASE_URL ?>/logout">Déconnexion</a>

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
