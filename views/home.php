<?php if (empty($articles)): ?>

    <p style="padding:3rem; text-align:center;">
        Aucun article pour le moment.
    </p>

<?php else: ?>

<section class="hero">

    <div class="hero-text">

        <h1>
            <span class="kinetic-type">CYBER</span><br>
            <span class="kinetic-type">OPULENCE</span><br>
            <span class="kinetic-type">V.2025</span>
        </h1>

        <p class="hero-description">
            High-fidelity streetwear for the post-digital age.
            Limited edition fabrics engineered for the underground.
        </p>

        <div class="hero-meta">
            <span>EST. 2024</span>
            <span>ZURICH / TOKYO</span>
            <span>AVAILABLE: GLOBAL</span>
        </div>

        <a href="#catalog" class="btn btn-primary">
            INIT_SEQUENCE
        </a>

    </div>

    <div class="hero-visual">

        <div class="chrome-shape"></div>
        <div class="chrome-shape-inner"></div>

        <div class="hero-overlay-info">
            RENDER_TARGET: 01<br>
            NOISE_LEVEL: 0%
        </div>

    </div>

</section>


<section class="catalog" id="catalog">

<?php foreach ($articles as $a): ?>

    <div class="product-card">

        <div class="p-image">

            <?php if (!empty($a['image_url'])): ?>
                <img 
                    src="<?= BASE_URL ?>/assets/uploads/articles/<?= htmlspecialchars($a['image_url']) ?>" 
                    alt="<?= htmlspecialchars($a['name']) ?>"
                    class="product-img">
            <?php else: ?>
                <div class="p-art"></div>
            <?php endif; ?>

            <span class="tag">LIMITED</span>

        </div>

        <div class="p-info">

            <div>
                <h3 class="p-title">
                    <?= htmlspecialchars($a['name']) ?>
                </h3>

                <div class="p-meta">
                    <?= htmlspecialchars($a['description']) ?>
                </div>
            </div>

            <div class="p-price">
                €<?= number_format((float)$a['price'], 2) ?>
            </div>

        </div>

        <div class="product-actions">
            <a href="<?= BASE_URL ?>/detail/<?= (int)$a['id'] ?>" class="btn product-btn">
                VIEW DETAILS
            </a>
        </div>

    </div>

<?php endforeach; ?>

</section>

<?php endif; ?>