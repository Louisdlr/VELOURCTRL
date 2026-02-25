<?php
  $desc  = $article['description'] ?? '';
  $price = $article['price'] ?? null;
  $img   = $article['image_url'] ?? $article['image'] ?? $article['url_img'] ?? null;
?>

<div class="modal-inner" style="margin:4rem auto;opacity:1;transform:none;">

    <!-- LEFT VISUAL -->
    <div class="modal-visual">

        <div class="limited-badge">
            LIMITED DROP
        </div>

        <span class="serial-no">
            #<?= str_pad((int)$article['id'], 4, '0', STR_PAD_LEFT) ?>
        </span>

        <div class="modal-halo"></div>

        <?php if ($img): ?>
            <img 
                src="<?= htmlspecialchars($img) ?>" 
                alt=""
                style="max-width:280px;z-index:2;">
        <?php else: ?>
            <div class="cart-thumb"></div>
        <?php endif; ?>

    </div>

<<<<<<< Updated upstream
<?php if ($canEdit): ?>
  <form method="post" action="<?= BASE_URL ?>/edit/open/<?= (int)$article['id'] ?>">
    <button type="submit">Modifier l’article</button>
  </form>
<?php endif; ?>
=======
    <!-- RIGHT INFO -->
    <div class="modal-info">

        <div class="modal-category">
            STREETWEAR / SS25
        </div>

        <h2 class="modal-title">
            <?= htmlspecialchars($article['name']) ?>
        </h2>

        <?php if ($desc !== ''): ?>
            <p class="modal-desc">
                <?= htmlspecialchars((string)$desc) ?>
            </p>
        <?php endif; ?>

        <div class="modal-price">
            <?php if ($price !== null): ?>
                <?= number_format((float)$price, 2) ?> €
            <?php endif; ?>
        </div>

        <!-- ACTIONS -->
        <div class="modal-actions">

            <form method="POST" action="<?= BASE_URL ?>/cart/add/<?= (int)$article['id'] ?>">
                <button type="submit" class="btn-cart-modal">
                    Ajouter au panier
                </button>
            </form>

            <a href="<?= BASE_URL ?>/cart" class="btn-like-modal" style="text-decoration:none;display:flex;align-items:center;justify-content:center;">
                🛒
            </a>

        </div>

        <div style="margin-top:1.5rem;">
            <a href="<?= BASE_URL ?>/" class="btn">
                ⬅ Retour à l’accueil
            </a>
        </div>

        <?php
        $canEdit = !empty($_SESSION['user']['id']) &&
          ( (int)($article['user_id'] ?? 0) === (int)$_SESSION['user']['id']
            || (!empty($_SESSION['user']['role']) && $_SESSION['user']['role']==='ADMIN') );
        ?>

        <?php if ($canEdit): ?>
            <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap;">

                <form method="post" action="<?= BASE_URL ?>/edit/open/<?= (int)$article['id'] ?>">
                    <button type="submit" class="btn">
                        Modifier
                    </button>
                </form>

                <form method="post"
                      action="<?= BASE_URL ?>/edit/<?= (int)$article['id'] ?>/delete"
                      onsubmit="return confirm('Supprimer cet article ?');">
                    <button type="submit" class="btn">
                        Supprimer
                    </button>
                </form>

            </div>
        <?php endif; ?>

    </div>

</div>
>>>>>>> Stashed changes
