<h1><?= htmlspecialchars($title ?? 'Connexion') ?></h1>

<?php if (!empty($errors)): ?>
  <div style="color:red;">
    <ul>
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>/login">
  <label>Email</label><br>
  <input type="email" name="email"><br><br>

  <label>Mot de passe</label><br>
  <input type="password" name="password"><br><br>

  <button type="submit">Se connecter</button>
</form>

<p><a href="<?= BASE_URL ?>/register">Créer un compte</a></p>
