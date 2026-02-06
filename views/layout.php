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
      <a href="/">Accueil</a>
      <a href="/login" style="margin-left:12px;">Login</a>
      <a href="/register" style="margin-left:12px;">Register</a>
      <a href="/cart" style="margin-left:12px;">Panier</a>
    </nav>
  </header>

  <main style="padding:16px;">
    <?= $content ?>
  </main>
</body>
</html>
