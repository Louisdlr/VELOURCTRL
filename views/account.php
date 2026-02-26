<h1 class="glow-text-purple uppercase" style="margin-bottom:3rem;"></h1>

<?php
  $isLogged = !empty($_SESSION['user']['id']);
  $isAdmin  = $isLogged && !empty($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'ADMIN';
  $canManagePosted = ($isMe || $isAdmin);
?>

<div style="max-width:1100px;margin:0 auto;display:grid;grid-template-columns:380px 1fr;gap:4rem;">

  <!-- PANEL GAUCHE INFOS -->
  <div style="border:1px solid rgba(220,208,255,0.15);padding:3rem;background:rgba(10,0,20,0.6);position:relative;">

    <div style="position:absolute;inset:-2px;z-index:-1;background:linear-gradient(135deg,#DCD0FF,transparent,#B57BFF);opacity:0.2;"></div>

    <div style="display:flex;flex-direction:column;gap:2rem;">

      <div>
        <div class="form-label">Utilisateur</div>
        <div style="font-size:1.4rem;font-weight:700;">
          <?= htmlspecialchars($target['username'] ?? '') ?>
        </div>
      </div>

      <div>
        <div class="form-label">Email</div>
        <div><?= htmlspecialchars($target['email'] ?? '') ?></div>
      </div>

      <div>
        <div class="form-label">Solde</div>
        <div style="font-family:var(--font-display);font-size:1.8rem;color:var(--neon-green);">
          <?= number_format((float)($target['balance'] ?? 0), 2) ?> €
        </div>
      </div>

      <div>
        <div class="form-label">Rôle</div>
        <div style="color:var(--toxic-purple);font-weight:700;">
          <?= htmlspecialchars($target['role'] ?? 'USER') ?>
        </div>
      </div>

      <div>
        <div class="form-label">Créé le</div>
        <div style="color:#777;font-size:0.8rem;">
          <?= htmlspecialchars($target['created_at'] ?? '') ?>
        </div>
      </div>

    </div>

  </div>


    <!-- COLONNE DROITE : CONTENU -->
    <div class="modal-info">

        <h2 class="modal-title">Articles postés</h2>

        <?php if ($isMe): ?>
            <div style="margin-bottom:1.5rem;">
                <a href="<?= BASE_URL ?>/article/new" class="btn btn-primary">
                    ➕ Ajouter un article
                </a>
            </div>
        <?php endif; ?>

        <?php if (empty($posted)): ?>
            <p class="p-meta">Aucun article publié.</p>
        <?php else: ?>
            <div style="display:flex;flex-direction:column;gap:1rem;">
                <?php foreach ($posted as $a): ?>
                    <?php
                        $id    = (int)($a['id'] ?? 0);
                        $name  = $a['name'] ?? 'Article';
                        $price = (float)($a['price'] ?? 0);
                        $active = (int)($a['is_active'] ?? 1);
                    ?>
                    <div class="cart-item">

                        <div>
                            <h3 class="p-title">
                                <a href="<?= BASE_URL ?>/detail/<?= $id ?>">
                                    <?= htmlspecialchars($name) ?>
                                </a>
                            </h3>

                            <p class="p-meta">
                                <?= number_format($price, 2) ?> € —
                                <?= $active === 1 ? 'Actif' : 'Désactivé' ?>
                            </p>
                        </div>

                        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">

                            <a href="<?= BASE_URL ?>/detail/<?= $id ?>" class="btn">
                                Voir
                            </a>

                            <?php if ($canManagePosted): ?>
                                <form method="post" action="<?= BASE_URL ?>/edit/open/<?= $id ?>">
                                    <button type="submit" class="btn">
                                        Modifier
                                    </button>
                                </form>

                                <form method="post"
                                      action="<?= BASE_URL ?>/edit/<?= $id ?>/delete"
                                      onsubmit="return confirm('Supprimer cet article ?');">
                                    <button type="submit" class="btn">
                                        Supprimer
                                    </button>
                                </form>
                            <?php endif; ?>

                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


        <?php if ($isMe): ?>

            <h2 class="modal-title" style="margin-top:3rem;">Mes factures</h2>

            <?php if (empty($invoices)): ?>
                <p class="p-meta">Aucune facture.</p>
            <?php else: ?>
                <div style="display:flex;flex-direction:column;gap:0.8rem;">
                    <?php foreach ($invoices as $inv): ?>
                        <div class="cart-item">
                            <div>
                                <a href="<?= BASE_URL ?>/invoice/<?= (int)$inv['id'] ?>">
                                    Facture #<?= (int)$inv['id'] ?>
                                </a>
                                <p class="p-meta">
                                    <?= number_format((float)($inv['total_amount'] ?? 0), 2) ?> € —
                                    <?= htmlspecialchars($inv['created_at'] ?? '') ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


            <h2 class="modal-title" style="margin-top:3rem;">Modifier mes informations</h2>

            <form method="post" action="<?= BASE_URL ?>/account/update">

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-input"
                           value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-input">
                </div>

                <button type="submit" class="btn btn-primary">
                    Enregistrer
                </button>

            </form>


            <h2 class="modal-title" style="margin-top:3rem;">Ajouter de l’argent</h2>

            <form method="post" action="<?= BASE_URL ?>/account/add-balance" class="modal-actions">

                <input type="number"
                       step="0.01"
                       min="0"
                       name="amount"
                       placeholder="Montant"
                       class="form-input">

                <button type="submit" class="btn btn-primary">
                    Ajouter
                </button>

            </form>

        <?php endif; ?>

    </div>

</div>