<h1>Modifier l’article</h1>

<form method="post" action="<?= BASE_URL ?>/edit/<?= (int)$article['id'] ?>">
  <label>Nom</label><br>
  <input name="name" value="<?= htmlspecialchars($article['name']) ?>"><br><br>

  <label>Description</label><br>
  <textarea name="description" rows="5" cols="50"><?= htmlspecialchars($article['description']) ?></textarea><br><br>

  <label>Prix</label><br>
  <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($article['price']) ?>"><br><br>

  <label>Image URL</label><br>
  <input name="image_url" value="<?= htmlspecialchars($article['image_url'] ?? '') ?>"><br><br>

  <label>
    <input type="checkbox" name="is_active" value="1" <?= !empty($article['is_active']) ? 'checked' : '' ?>>
    Actif
  </label><br><br>

  <button type="submit">Enregistrer</button>
</form>

<form method="post" action="<?= BASE_URL ?>/edit/<?= (int)$article['id'] ?>/delete" style="margin-top:12px;">
  <button type="submit" onclick="return confirm('Supprimer cet article ?')">Supprimer</button>
</form>

<p><a href="<?= BASE_URL ?>/detail/<?= (int)$article['id'] ?>">Retour</a></p>