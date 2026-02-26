<div class="admin-view">

  <!-- SIDEBAR NAV -->
  <div class="admin-sidebar">
    <h3>Navigation</h3>

    <a href="<?= BASE_URL ?>/admin" class="nav-item">Dashboard</a><br><br>
    <a href="<?= BASE_URL ?>/admin/articles" class="nav-item active">Articles</a><br><br>
    <a href="<?= BASE_URL ?>/admin/users" class="nav-item">Utilisateurs</a>
  </div>


  <div>

    <?php if (!empty($_SESSION['admin_error'])): ?>
      <div style="border:1px solid #400;background:rgba(100,0,0,0.2);padding:1.2rem;margin-bottom:2rem;">
        <?= htmlspecialchars($_SESSION['admin_error']) ?>
      </div>
      <?php unset($_SESSION['admin_error']); ?>
    <?php endif; ?>


    <!-- FORMULAIRE -->
    <div style="border:1px solid rgba(220,208,255,0.1);padding:2.5rem;background:rgba(5,0,15,0.6);margin-bottom:4rem;">

      <h2 class="glow-text-green uppercase" style="margin-bottom:2rem;">
        Ajouter un article
      </h2>

      <form method="POST" action="<?= BASE_URL ?>/admin/articles/create">

        <div class="form-group">
          <label class="form-label">Nom</label>
          <input type="text" name="name" required class="form-input">
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" required class="form-input" rows="4"></textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;">
          <div class="form-group">
            <label class="form-label">Prix (€)</label>
            <input type="number" step="0.01" name="price" required class="form-input">
          </div>

          <div class="form-group">
            <label class="form-label">Stock</label>
            <input type="number" name="stock_qty" required min="0" class="form-input">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Image URL</label>
          <input type="text" name="image_url" class="form-input">
        </div>

        <div style="margin-bottom:2rem;">
          <label style="display:flex;align-items:center;gap:10px;">
            <input type="checkbox" name="is_active" value="1" checked>
            <span class="p-meta uppercase">Actif</span>
          </label>
        </div>

        <button type="submit" class="btn btn-primary">
          Créer
        </button>

      </form>

    </div>


    <!-- LISTE ARTICLES -->
    <?php if (empty($articles)): ?>
      <p class="p-meta">Aucun article.</p>
    <?php else: ?>

      <div style="display:flex;flex-direction:column;gap:1.5rem;">

        <?php foreach ($articles as $a): ?>
          <?php $active = (int)($a['is_active'] ?? 1); ?>

          <div class="cart-item" style="grid-template-columns: 80px 1fr auto;">

            <div class="cart-thumb"></div>

            <div>
              <div class="p-title">
                <?= htmlspecialchars($a['name'] ?? '') ?>
              </div>

              <div class="p-meta">
                ID #<?= (int)$a['id'] ?> —
                <?= number_format((float)($a['price'] ?? 0), 2) ?> € —
                Auteur : <?= htmlspecialchars($a['username'] ?? '—') ?>
              </div>

              <div class="p-meta">
                <?= htmlspecialchars($a['created_at'] ?? '') ?>
              </div>

              <div style="margin-top:6px;">
                <?php if ($active === 1): ?>
                  <span style="color:var(--neon-green);font-weight:bold;">Actif</span>
                <?php else: ?>
                  <span style="color:#ff6b6b;">Désactivé</span>
                <?php endif; ?>
              </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:8px;">

              <a href="<?= BASE_URL ?>/detail/<?= (int)$a['id'] ?>" class="btn">
                Voir
              </a>

              <form method="POST" action="<?= BASE_URL ?>/admin/articles/toggle-active/<?= (int)$a['id'] ?>">
                <button type="submit" class="btn">
                  <?= $active === 1 ? 'Désactiver' : 'Activer' ?>
                </button>
              </form>

              <form method="POST" action="<?= BASE_URL ?>/edit/open/<?= (int)$a['id'] ?>">
                <button type="submit" class="btn">
                  Modifier
                </button>
              </form>

              <form method="POST"
                    action="<?= BASE_URL ?>/admin/articles/delete/<?= (int)$a['id'] ?>"
                    onsubmit="return confirm('Supprimer cet article ?');">
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