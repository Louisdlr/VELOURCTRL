<h1>Admin Users</h1>

<nav style="margin:12px 0;">
  <a href="<?= BASE_URL ?>/admin" style="margin-right:10px;">Dashboard</a>
  <a href="<?= BASE_URL ?>/admin/articles" style="margin-right:10px;">Articles</a>
  <a href="<?= BASE_URL ?>/admin/users">Utilisateurs</a>
</nav>

<?php if (empty($users)): ?>
  <p>Aucun utilisateur.</p>
<?php else: ?>
  <table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse; width:100%;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actif</th>
        <th>Solde</th>
        <th>Créé</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($users as $u): ?>
        <tr>
          <td><?= (int)$u['id'] ?></td>
          <td><?= htmlspecialchars($u['username'] ?? '') ?></td>
          <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
          <td><?= htmlspecialchars($u['role'] ?? 'USER') ?></td>
          <td><?= !empty($u['is_active']) ? 'Oui' : 'Non' ?></td>
          <td><?= number_format((float)($u['balance'] ?? 0), 2) ?> €</td>
          <td><?= htmlspecialchars($u['created_at'] ?? '') ?></td>

          <td style="white-space:nowrap;">
            <!-- Toggle active -->
            <form method="POST" action="<?= BASE_URL ?>/admin/users/toggle-active/<?= (int)$u['id'] ?>" style="display:inline;">
              <button type="submit">
                <?= !empty($u['is_active']) ? 'Désactiver' : 'Activer' ?>
              </button>
            </form>

            <!-- Toggle role -->
            <form method="POST" action="<?= BASE_URL ?>/admin/users/toggle-role/<?= (int)$u['id'] ?>" style="display:inline;">
              <button type="submit">
                <?= ($u['role'] ?? 'USER') === 'ADMIN' ? 'Mettre USER' : 'Mettre ADMIN' ?>
              </button>
            </form>

            <!-- Delete user (optionnel) -->
            <form method="POST" action="<?= BASE_URL ?>/admin/users/delete/<?= (int)$u['id'] ?>"
                  style="display:inline;"
                  onsubmit="return confirm('Supprimer cet utilisateur ?');">
              <button type="submit">Supprimer</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>