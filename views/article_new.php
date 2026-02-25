<h1>Créer un article</h1>

<?php if (!empty($errors)): ?>
  <div style="color:red;">
    <ul>
      <?php foreach ($errors as $err): ?>
        <li><?= htmlspecialchars($err) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="post" action="<?= BASE_URL ?>/article/create">
  <div>
    <label>Nom</label><br>
    <input name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
  </div>

  <div>
    <label>Description</label><br>
    <textarea name="description" rows="5" required><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
  </div>

  <div>
    <label>Prix (€)</label><br>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($old['price'] ?? '') ?>" required>
  </div>

  <div>
    <label>Image URL</label><br>
    <input name="image_url" value="<?= htmlspecialchars($old['image_url'] ?? '') ?>">
  </div>

  <div>
    <label>Stock</label><br>
    <input type="number" name="stock_qty" min="0" value="<?= htmlspecialchars($old['stock_qty'] ?? 0) ?>">
  </div>

  <div>
    <label>
      <input type="checkbox" name="is_active" value="1" <?= !empty($old['is_active']) ? 'checked' : '' ?>>
      Actif
    </label>
  </div>

  <button type="submit">Créer</button>
</form>