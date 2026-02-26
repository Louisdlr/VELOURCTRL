<?php
// On garde tout le fonctionnement
?>

<div class="modal-inner" style="margin:4rem auto;opacity:1;transform:none;">

    <!-- COLONNE GAUCHE -->
    <div class="modal-visual">

        <div class="limited-badge">
            INVOICE
        </div>

        <span class="serial-no">
            #<?= (int)$invoice['id'] ?>
        </span>

        <div class="modal-halo"></div>

    </div>


    <!-- COLONNE DROITE -->
    <div class="modal-info">

        <div class="modal-category">
            BILLING SUMMARY
        </div>

        <h2 class="modal-title">
            <?= htmlspecialchars($title ?? 'Facture') ?>
        </h2>

        <p class="modal-desc">
            Total :
            <strong><?= number_format((float)$invoice['total_amount'], 2) ?> €</strong>
        </p>

        <div class="modal-meta-grid">

            <div class="meta-item">
                <label>Adresse</label>
                <span><?= htmlspecialchars($invoice['billing_address']) ?></span>
            </div>

            <div class="meta-item">
                <label>Ville</label>
                <span>
                    <?= htmlspecialchars($invoice['billing_postal_code']) ?>
                    <?= htmlspecialchars($invoice['billing_city']) ?>
                </span>
            </div>

        </div>


        <!-- LIGNES PRODUITS -->
        <div style="margin-top:2rem;">

            <?php $sum = 0; foreach ($items as $it): 
                $line = (float)$it['price_at_purchase'] * (int)$it['quantity'];
                $sum += $line;
            ?>

                <div class="modal-meta-grid" style="margin-bottom:1rem;">

                    <div class="meta-item">
                        <label>Article</label>
                        <span><?= htmlspecialchars($it['name']) ?></span>
                    </div>

                    <div class="meta-item">
                        <label>Prix</label>
                        <span><?= number_format((float)$it['price_at_purchase'], 2) ?> €</span>
                    </div>

                    <div class="meta-item">
                        <label>Qté</label>
                        <span><?= (int)$it['quantity'] ?></span>
                    </div>

                    <div class="meta-item">
                        <label>Total ligne</label>
                        <span><?= number_format($line, 2) ?> €</span>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>


        <!-- TOTAL RECALCULÉ -->
        <div class="modal-price" style="margin-top:1.5rem;">
            Total recalculé : <?= number_format($sum, 2) ?> €
        </div>


        <!-- ACTIONS -->
        <div class="modal-actions" style="margin-top:2rem;">

            <a href="<?= BASE_URL ?>/account" class="btn btn-primary">
                ALLER À MON COMPTE
            </a>

        </div>

    </div>

</div>