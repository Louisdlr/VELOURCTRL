<h1>Compte</h1>

<?php
  $isLogged = !empty($_SESSION['user']['id']);
  $isAdmin  = $isLogged && !empty($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'ADMIN';
  $canManagePosted = ($isMe || $isAdmin);
?>

<p>
  <strong>Utilisateur :</strong> <?= htmlspecialchars($target['username'] ?? '') ?><br>
  <strong>Email :</strong> <?= htmlspecialchars($target['email'] ?? '') ?><br>
  <strong>Solde :</strong> <?= number_format((float)($target['balance'] ?? 0), 2) ?> €<br>
  <strong>Rôle :</strong> <?= htmlspecialchars($target['role'] ?? 'USER') ?><br>
  <strong>Créé le :</strong> <?= htmlspecialchars($target['created_at'] ?? '') ?>
</p>

<h2>Articles postés par ce compte</h2>

<?php if ($isMe): ?>
  <p>
    <a href="<?= BASE_URL ?>/article/new">➕ Ajouter un article</a>
  </p>
<?php endif; ?>

<?php if (empty($posted)): ?>
  <p>Aucun article publié.</p>
<?php else: ?>
  <div style="display:flex;flex-direction:column;gap:10px;">
    <?php foreach ($posted as $a): ?>
      <?php
        $id    = (int)($a['id'] ?? 0);
        $name  = $a['name'] ?? 'Article';
        $price = (float)($a['price'] ?? 0);
        $active = (int)($a['is_active'] ?? 1);
      ?>
      <div style="border:1px solid #ddd;border-radius:8px;padding:10px;">
        <div style="display:flex;justify-content:space-between;gap:10px;align-items:center;">
          <div>
            <a href="<?= BASE_URL ?>/detail/<?= $id ?>">
              <strong><?= htmlspecialchars($name) ?></strong>
            </a>
            <div><?= number_format($price, 2) ?> €</div>
            <div>
              Statut : <?= $active === 1 ? 'Actif' : 'Désactivé' ?>
            </div>
          </div>

          <div style="white-space:nowrap;">
            <a href="<?= BASE_URL ?>/detail/<?= $id ?>">Voir</a>

            <?php if ($canManagePosted): ?>
              <!-- Modifier (ouvre le form) -->
              <form method="post" action="<?= BASE_URL ?>/edit/open/<?= $id ?>" style="display:inline;">
                <button type="submit">Modifier</button>
              </form>

              <!-- Supprimer -->
              <form method="post"
                    action="<?= BASE_URL ?>/edit/<?= $id ?>/delete"
                    style="display:inline;"
                    onsubmit="return confirm('Supprimer cet article ?');">
                <button type="submit">Supprimer</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php if ($isMe): ?>
  <h2>Mes factures</h2>
  <?php if (empty($invoices)): ?>
    <p>Aucune facture.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($invoices as $inv): ?>
        <li>
          <a href="<?= BASE_URL ?>/invoice/<?= (int)$inv['id'] ?>">
            Facture #<?= (int)$inv['id'] ?>
          </a>
          — <?= number_format((float)($inv['total_amount'] ?? 0), 2) ?> €
          — <?= htmlspecialchars($inv['created_at'] ?? '') ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <h2>Modifier mes informations</h2>
  <form method="post" action="<?= BASE_URL ?>/account/update">
    <label>Email</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>"><br><br>

    <label>Nouveau mot de passe (min 6)</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Enregistrer</button>
  </form>

  <h2>Ajouter de l’argent</h2>
  <form method="post" action="<?= BASE_URL ?>/account/add-balance">
    <input type="number" step="0.01" min="0" name="amount" placeholder="Montant">
    <button type="submit">Ajouter</button>
  </form>
<?php endif; ?>