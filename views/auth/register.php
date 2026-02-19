<h1><?= htmlspecialchars($title ?? 'Inscription') ?></h1>

<?php if (!empty($errors)): ?>
  <div style="color:red;">
    <ul>
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>/register">
  <label>Nom</label><br>
  <input type="text" name="username" value="<?= htmlspecialchars($old['username'] ?? '') ?>"><br><br>

  <label>Email</label><br>
  <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"><br><br>

  <label>Mot de passe</label><br>
  <input type="password" name="password"><br><br>

  <button type="submit">Créer mon compte</button>
</form>

<p><a href="<?= BASE_URL ?>/login">Déjà un compte ? Se connecter</a></p>
