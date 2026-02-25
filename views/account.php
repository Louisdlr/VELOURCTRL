<h1>Compte</h1>

<p>
  <strong>Utilisateur :</strong> <?= htmlspecialchars($target['username']) ?><br>
  <strong>Email :</strong> <?= htmlspecialchars($target['email']) ?><br>
  <strong>Solde :</strong> <?= number_format((float)$target['balance'], 2) ?> €<br>
  <strong>Rôle :</strong> <?= htmlspecialchars($target['role']) ?>
</p>

<h2>Articles postés par ce compte</h2>
<?php if (empty($posted)): ?>
  <p>Aucun article publié.</p>
<?php else: ?>
  <ul>
    <?php foreach ($posted as $a): ?>
      <li>
        <a href="<?= BASE_URL ?>/detail/<?= (int)$a['id'] ?>">
          <?= htmlspecialchars($a['name']) ?>
        </a>
        — <?= number_format((float)$a['price'], 2) ?> €
      </li>
    <?php endforeach; ?>
  </ul>
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
          — <?= number_format((float)$inv['total_amount'], 2) ?> €
          — <?= htmlspecialchars($inv['created_at']) ?>
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