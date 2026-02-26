<?php
// On ne touche pas au layout
?>

<section class="error-page">

    <div class="error-wrapper">

        <div class="error-code">
            404
        </div>

        <h1 class="error-title">
            SIGNAL LOST
        </h1>

        <p class="error-description">
            The requested resource does not exist or has been removed from the VELOUR network.
        </p>

        <div class="error-meta">
            ROUTE: <?= htmlspecialchars($_SERVER['REQUEST_URI']) ?><br>
            STATUS: NOT_FOUND<br>
            SYSTEM: VELOUR_CTRL
        </div>

        <div class="error-actions">

            <a href="<?= BASE_URL ?>/" class="btn btn-primary">
                RETURN_HOME
            </a>

            <a href="<?= BASE_URL ?>/cart" class="btn">
                VIEW_CART
            </a>

        </div>

    </div>

</section>