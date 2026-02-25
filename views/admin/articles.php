<h1>Admin Articles</h1>

<nav style="margin:12px 0;">
  <a href="<?= BASE_URL ?>/admin" style="margin-right:10px;">Dashboard</a>
  <a href="<?= BASE_URL ?>/admin/articles" style="margin-right:10px;">Articles</a>
  <a href="<?= BASE_URL ?>/admin/users">Utilisateurs</a>
</nav>

<?php if (!empty($_SESSION['admin_error'])): ?>
  <p style="color:red;"><?= htmlspecialchars($_SESSION['admin_error']) ?></p>
  <?php unset($_SESSION['admin_error']); ?>
<?php endif; ?>

<h2>Ajouter un article</h2>
<form method="POST" action="<?= BASE_URL ?>/admin/articles/create" style="margin-bottom:20px;">
  <div style="margin-bottom:8px;">
    <input type="text" name="name" placeholder="Nom" required style="width:420px;">
  </div>
  <div style="margin-bottom:8px;">
    <textarea name="description" placeholder="Description" required style="width:420px;height:90px;"></textarea>
  </div>
  <div style="margin-bottom:8px;">
    <input type="number" step="0.01" name="price" placeholder="Prix (€)" required>
    <input type="number" name="stock_qty" placeholder="Stock" required min="0" style="margin-left:8px;">
  </div>
  <div style="margin-bottom:8px;">
    <input type="text" name="image_url" placeholder="Image URL (optionnel)" style="width:420px;">
  </div>
  <label>
    <input type="checkbox" name="is_active" value="1" checked> Actif
  </label>
  <div style="margin-top:8px;">
    <button type="submit">Créer</button>
  </div>
</form>

<?php if (empty($articles)): ?>
  <p>Aucun article.</p>
<?php else: ?>
  <table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse; width:100%;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Auteur</th>
        <th>Actif</th>
        <th>Créé</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($articles as $a): ?>
        <?php $active = (int)($a['is_active'] ?? 1); ?>
        <tr>
          <td><?= (int)$a['id'] ?></td>
          <td><?= htmlspecialchars($a['name'] ?? '') ?></td>
          <td><?= number_format((float)($a['price'] ?? 0), 2) ?> €</td>
          <td><?= htmlspecialchars($a['username'] ?? '—') ?></td>
          <td><?= $active === 1 ? 'Oui' : 'Non' ?></td>
          <td><?= htmlspecialchars($a['created_at'] ?? '') ?></td>

          <td style="white-space:nowrap;">
            <a href="<?= BASE_URL ?>/detail/<?= (int)$a['id'] ?>">Voir</a>

            <form method="POST" action="<?= BASE_URL ?>/admin/articles/toggle-active/<?= (int)$a['id'] ?>" style="display:inline;">
              <button type="submit"><?= $active === 1 ? 'Désactiver' : 'Activer' ?></button>
            </form>

            <form method="POST" action="<?= BASE_URL ?>/edit/open/<?= (int)$a['id'] ?>" style="display:inline;">
              <button type="submit">Modifier</button>
            </form>
              <form method="POST"
                    action="<?= BASE_URL ?>/admin/articles/delete/<?= (int)$a['id'] ?>"
                    style="display:inline;"
                    onsubmit="return confirm('Supprimer cet article ?');">
             <button type="submit">Supprimer</button>
             </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>