<h1><?= htmlspecialchars($title ?? 'Commande validée') ?></h1>
<p>✅ Commande enregistrée (ID : <?= (int)$invoice_id ?>)</p>
<p>Total : <?= number_format((float)$total, 2) ?> €</p>
<p><a href="<?= BASE_URL ?>/">Retour à l’accueil</a></p>
