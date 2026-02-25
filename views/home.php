<?php if (empty($articles)): ?>
  <p>Aucun article pour le moment.</p>
<?php else: ?>

    <section class="hero">

        <div class="hero-text">

            <h1>
                <span class="kinetic-type">CYBER</span><br>
                <span class="kinetic-type">OPULENCE</span><br>
                <span class="kinetic-type">V.2025</span>
            </h1>

            <p style="max-width: 520px; color:#777; margin-bottom: 2rem;">
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

            <div style="position:absolute; bottom:15px; left:20px; font-size:0.7rem; color:#777;">
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
                    <img src="<?= htmlspecialchars($a['image_url']) ?>" 
                        style="max-width:70%; max-height:300px;">
                <?php else: ?>
                    <div class="p-art"></div>
                <?php endif; ?>

                <span class="tag">LIMITED</span>

            </div>

            <div class="p-info">
                <div>
                    <div class="p-title">
                        <?= htmlspecialchars($a['name']) ?>
                    </div>
                    <div class="p-meta">
                        <?= htmlspecialchars($a['description']) ?>
                    </div>
                </div>

                <div class="p-price">
                    €<?= number_format($a['price'], 2) ?>
                </div>
            </div>

            <div style="padding: 1.5rem;">
                <a href="<?= BASE_URL ?>/detail/<?= $a['id'] ?>" class="btn" style="width:100%;">
                    VIEW DETAILS
                </a>
            </div>
        </div>

    <?php endforeach; ?>
    </section>
<?php endif; ?>
