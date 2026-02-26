<div class="cart-view">

    <h2 class="modal-title" style="font-size:3rem;margin-bottom:2rem;">
        <?= htmlspecialchars($title ?? 'Secure_Checkout') ?>
    </h2>

    <?php if (!empty($error)): ?>
        <p class="p-meta" style="color:#ff4d4d;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

    <?php if (empty($items)): ?>

        <p class="p-meta">Votre panier est vide.</p>
        <p style="margin-top:1rem;">
            <a href="<?= BASE_URL ?>/" class="btn">Retour à l’accueil</a>
        </p>

    <?php else: ?>

        <?php foreach ($items as $it): ?>

            <div class="cart-item">

                <div class="cart-thumb">
                    <?php if (!empty($it['image_url'])): ?>
                        <img 
                            src="<?= BASE_URL ?>/uploads/articles/<?= htmlspecialchars($it['image_url']) ?>"
                            alt=""
                            style="width:100%;height:100%;object-fit:cover;">
                    <?php endif; ?>
                </div>

                <div>
                    <h3 class="p-title">
                        <a href="<?= BASE_URL ?>/detail/<?= (int)$it['id'] ?>" style="text-decoration:none;color:inherit;">
                            <?= htmlspecialchars($it['name'] ?? 'Article') ?>
                        </a>
                    </h3>

                    <p class="p-meta">
                        <?= number_format($it['price'], 2) ?> € — Qté: <?= (int)$it['qty'] ?>
                    </p>

                    <div style="margin-top:10px;">

                        <form method="POST" action="<?= BASE_URL ?>/cart/dec/<?= (int)$it['id'] ?>" style="display:inline;">
                            <button type="submit" class="btn">-</button>
                        </form>

                        <form method="POST" action="<?= BASE_URL ?>/cart/inc/<?= (int)$it['id'] ?>" style="display:inline;">
                            <button type="submit" class="btn">+</button>
                        </form>

                        <form method="POST" action="<?= BASE_URL ?>/cart/remove/<?= (int)$it['id'] ?>" style="display:inline;">
                            <button type="submit" class="btn">Supprimer</button>
                        </form>

                    </div>
                </div>

                <div class="p-price">
                    <?= number_format($it['line_total'], 2) ?> €
                </div>

            </div>

        <?php endforeach; ?>

        <form method="POST" action="<?= BASE_URL ?>/cart/clear" style="margin-top:1rem;">
            <button type="submit" class="btn">
                Vider le panier
            </button>
        </form>

        <div class="cart-total">
            <span class="p-meta">TOTAL :</span>
            <?= number_format($total, 2) ?> €
        </div>

        <p style="margin-top:2rem;">
            <a href="<?= BASE_URL ?>/" class="btn">
                Continuer mes achats
            </a>
        </p>

        <form method="POST" action="<?= BASE_URL ?>/cart/validate" style="margin-top:3rem;max-width:500px;">

            <h3 class="p-title" style="margin-bottom:1rem;">
                Adresse de facturation
            </h3>

            <div class="form-group">
                <input type="text" name="billing_address" placeholder="Adresse" required class="form-input">
            </div>

            <div class="form-group">
                <input type="text" name="billing_city" placeholder="Ville" required class="form-input">
            </div>

            <div class="form-group">
                <input type="text" name="billing_postal_code" placeholder="Code postal" required class="form-input">
            </div>

            <button type="submit" class="btn btn-primary">
                Valider mon panier
            </button>

        </form>

    <?php endif; ?>

</div>