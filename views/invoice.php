<h1><?= htmlspecialchars($title ?? 'Facture') ?></h1>

<p>
  Facture #<?= (int)$invoice['id'] ?> —
  Total: <strong><?= number_format((float)$invoice['total_amount'], 2) ?> €</strong>
</p>

<p>
  <?= htmlspecialchars($invoice['billing_address']) ?>,
  <?= htmlspecialchars($invoice['billing_postal_code']) ?> <?= htmlspecialchars($invoice['billing_city']) ?>
</p>

<table border="1" cellpadding="8" cellspacing="0" style="margin-top:12px;">
  <tr>
    <th>Article</th><th>Prix</th><th>Qté</th><th>Total ligne</th>
  </tr>
  <?php $sum = 0; foreach ($items as $it): 
    $line = (float)$it['price_at_purchase'] * (int)$it['quantity'];
    $sum += $line;
  ?>
    <tr>
      <td><?= htmlspecialchars($it['name']) ?></td>
      <td><?= number_format((float)$it['price_at_purchase'], 2) ?> €</td>
      <td><?= (int)$it['quantity'] ?></td>
      <td><?= number_format($line, 2) ?> €</td>
    </tr>
  <?php endforeach; ?>
</table>

<p style="margin-top:10px;">
  <strong>Total recalculé :</strong> <?= number_format($sum, 2) ?> €
</p>

<p><a href="<?= BASE_URL ?>/account">Aller à mon compte</a></p>