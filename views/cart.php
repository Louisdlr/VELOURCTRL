<h1><?= htmlspecialchars($title ?? 'Panier') ?></h1>

<?php if (!empty($error)): ?>
  <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (empty($items)): ?>
  <p>Votre panier est vide.</p>
  <p><a href="<?= BASE_URL ?>/">Retour à l’accueil</a></p>
<?php else: ?>

  <table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse;width:100%;max-width:900px;">
    <thead>
      <tr>
        <th>Article</th>
        <th>Prix</th>
        <th>Qté</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $it): ?>
        <tr>
          <td>
            <?php if (!empty($it['image_url'])): ?>
              <img src="<?= htmlspecialchars($it['image_url']) ?>" alt="" style="width:50px;height:50px;object-fit:cover;vertical-align:middle;margin-right:8px;">
            <?php endif; ?>
            <a href="<?= BASE_URL ?>/detail/<?= (int)$it['id'] ?>">
              <?= htmlspecialchars($it['name'] ?? 'Article') ?>
            </a>
          </td>
          <td><?= number_format($it['price'], 2) ?> €</td>
          <td>
  <form method="POST" action="<?= BASE_URL ?>/cart/dec/<?= (int)$it['id'] ?>" style="display:inline;">
    <button type="submit">-</button>
  </form>

  <strong style="margin:0 8px;"><?= (int)$it['qty'] ?></strong>

  <form method="POST" action="<?= BASE_URL ?>/cart/inc/<?= (int)$it['id'] ?>" style="display:inline;">
    <button type="submit">+</button>
  </form>

  <form method="POST" action="<?= BASE_URL ?>/cart/remove/<?= (int)$it['id'] ?>" style="display:inline;margin-left:8px;">
    <button type="submit">Supprimer</button>
  </form>
</td>

          <td><?= number_format($it['line_total'], 2) ?> €</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<form method="POST" action="<?= BASE_URL ?>/cart/clear" style="margin-top:12px;">
  <button type="submit">Vider le panier</button>
</form>

  <h3 style="margin-top:16px;">Total : <?= number_format($total, 2) ?> €</h3>

  <p style="margin-top:16px;">
    <a href="<?= BASE_URL ?>/">Continuer mes achats</a>
  </p>
<form method="POST" action="<?= BASE_URL ?>/cart/validate" style="margin-top:12px;">
  <h3>Adresse de facturation</h3>
  <input type="text" name="billing_address" placeholder="Adresse" required><br><br>
  <input type="text" name="billing_city" placeholder="Ville" required><br><br>
  <input type="text" name="billing_postal_code" placeholder="Code postal" required><br><br>

  <button type="submit">Valider mon panier</button>
</form>
<?php endif; ?>
