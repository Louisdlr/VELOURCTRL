<div class="admin-view">

  <!-- SIDEBAR -->
  <div class="admin-sidebar">
    <h3>Navigation</h3>

    <a href="<?= BASE_URL ?>/admin" class="nav-item">Dashboard</a><br><br>
    <a href="<?= BASE_URL ?>/admin/articles" class="nav-item">Articles</a><br><br>
    <a href="<?= BASE_URL ?>/admin/users" class="nav-item active">Utilisateurs</a>
  </div>


  <!-- MAIN CONTENT -->
  <div>

    <?php if (empty($users)): ?>
      <p class="p-meta">Aucun utilisateur.</p>
    <?php else: ?>

      <div style="display:flex;flex-direction:column;gap:1.5rem;">

        <?php foreach ($users as $u): ?>

          <div class="cart-item" style="grid-template-columns: 1fr auto;">

            <!-- INFOS -->
            <div>

              <div class="p-title">
                <?= htmlspecialchars($u['username'] ?? '') ?>
                <span class="p-meta" style="margin-left:8px;">
                  #<?= (int)$u['id'] ?>
                </span>
              </div>

              <div class="p-meta">
                <?= htmlspecialchars($u['email'] ?? '') ?>
              </div>

              <div style="margin-top:8px;display:flex;gap:2rem;flex-wrap:wrap;">

                <span class="p-meta">
                  Rôle :
                  <strong style="color:<?= ($u['role'] ?? 'USER') === 'ADMIN' ? 'var(--toxic-purple)' : 'var(--chrome)' ?>;">
                    <?= htmlspecialchars($u['role'] ?? 'USER') ?>
                  </strong>
                </span>

                <span class="p-meta">
                  Actif :
                  <strong style="color:<?= !empty($u['is_active']) ? 'var(--neon-green)' : '#ff6b6b' ?>;">
                    <?= !empty($u['is_active']) ? 'Oui' : 'Non' ?>
                  </strong>
                </span>

                <span class="p-meta">
                  Solde :
                  <strong style="color:var(--neon-green);">
                    <?= number_format((float)($u['balance'] ?? 0), 2) ?> €
                  </strong>
                </span>

                <span class="p-meta">
                  Créé :
                  <?= htmlspecialchars($u['created_at'] ?? '') ?>
                </span>

              </div>

            </div>


            <!-- ACTIONS -->
            <div style="display:flex;flex-direction:column;gap:8px;min-width:170px;">

              <form method="POST"
                    action="<?= BASE_URL ?>/admin/users/toggle-active/<?= (int)$u['id'] ?>">
                <button type="submit" class="btn">
                  <?= !empty($u['is_active']) ? 'Désactiver' : 'Activer' ?>
                </button>
              </form>

              <form method="POST"
                    action="<?= BASE_URL ?>/admin/users/toggle-role/<?= (int)$u['id'] ?>">
                <button type="submit" class="btn">
                  <?= ($u['role'] ?? 'USER') === 'ADMIN' ? 'Mettre USER' : 'Mettre ADMIN' ?>
                </button>
              </form>

              <form method="POST"
                    action="<?= BASE_URL ?>/admin/users/delete/<?= (int)$u['id'] ?>"
                    onsubmit="return confirm('Supprimer cet utilisateur ?');">
                <button type="submit" class="btn">
                  Supprimer
                </button>
              </form>

            </div>

          </div>

        <?php endforeach; ?>

      </div>

    <?php endif; ?>

  </div>

</div>