<h1><?= htmlspecialchars($article['name']) ?></h1>


<?php
  $desc  = $article['description'] ?? '';
  $price = $article['price'] ?? null;
  $img   = $article['image_url'] ?? $article['image'] ?? $article['url_img'] ?? null;
?>

<?php if ($img): ?>
  <img src="<?= htmlspecialchars($img) ?>" alt=""
       style="max-width:300px;display:block;margin-bottom:16px;">
<?php endif; ?>

<?php if ($desc !== ''): ?>
  <p><?= htmlspecialchars((string)$desc) ?></p>
<?php endif; ?>


<?php if ($price !== null): ?>
  <strong>Prix : <?= number_format((float)$price, 2) ?> €</strong>
<?php endif; ?>

<div style="margin-top:20px;">
  <a href="<?= BASE_URL ?>/">⬅ Retour à l’accueil</a>
</div>

<form method="POST" action="<?= BASE_URL ?>/cart/add/<?= (int)$article['id'] ?>" style="margin-top:16px;">
  <button type="submit">Ajouter au panier</button>
</form>

<p style="margin-top:10px;">
  <a href="<?= BASE_URL ?>/cart">Voir mon panier</a>
</p>
