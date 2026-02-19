<h1><?= htmlspecialchars($title ?? 'Accueil') ?></h1>

<?php if (empty($articles)): ?>
  <p>Aucun article pour le moment.</p>
<?php else: ?>

  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;">
    <?php foreach ($articles as $a): ?>

      <?php
        $id = (int)($a['id'] ?? 0);

        // Fallback titres possibles
        $name = $a['title'] ?? $a['name'] ?? $a['nom'] ?? $a['label'] ?? 'Sans titre';

        // Fallback descriptions possibles
        $desc = $a['description'] ?? $a['desc'] ?? $a['content'] ?? '';

        // Fallback prix possibles
        $price = $a['price'] ?? $a['prix'] ?? null;

        // Fallback image possibles
        $img = $a['image'] ?? $a['image_url'] ?? $a['img'] ?? $a['url_img'] ?? null;
      ?>

      <div style="border:1px solid #ddd;border-radius:8px;padding:12px;">
        <h3 style="margin:0 0 8px;"><?= htmlspecialchars($name) ?></h3>

        <?php if (!empty($img)): ?>
          <img src="<?= htmlspecialchars($img) ?>" alt="" style="width:100%;max-height:160px;object-fit:cover;border-radius:6px;">
        <?php endif; ?>

        <?php if ($desc !== ''): ?>
          <p style="margin:8px 0;"><?= htmlspecialchars($desc) ?></p>
        <?php endif; ?>

        <?php if ($price !== null): ?>
          <strong><?= number_format((float)$price, 2) ?> €</strong>
        <?php endif; ?>

        <div style="margin-top:10px;">
          <a href="<?= BASE_URL ?>/detail/<?= $id ?>">Voir le détail</a>
        </div>
      </div>

    <?php endforeach; ?>
  </div>

<?php endif; ?>
