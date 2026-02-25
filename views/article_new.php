
<?php if (!empty($errors)): ?>
  <div style="border:1px solid #400;background:rgba(100,0,0,0.2);padding:1.5rem;margin-bottom:2rem;">
    <ul style="list-style:none;">
      <?php foreach ($errors as $err): ?>
        <li style="color:#ff6b6b;margin-bottom:6px;">
          <?= htmlspecialchars($err) ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<div style="max-width:900px;margin:0 auto;border:1px solid rgba(220,208,255,0.1);padding:3rem;background:rgba(5,0,15,0.6);position:relative;">

  <div style="position:absolute;inset:-2px;background:linear-gradient(135deg,#DCD0FF,transparent,#B57BFF);opacity:0.1;z-index:-1;"></div>

  <form method="post" action="<?= BASE_URL ?>/article/create">

    <div class="form-group">
      <label class="form-label">Nom</label>
      <input class="form-input"
             name="name"
             value="<?= htmlspecialchars($old['name'] ?? '') ?>"
             required>
    </div>

    <div class="form-group">
      <label class="form-label">Description</label>
      <textarea class="form-input"
                name="description"
                rows="5"
                required><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;">

      <div class="form-group">
        <label class="form-label">Prix (€)</label>
        <input type="number"
               step="0.01"
               class="form-input"
               name="price"
               value="<?= htmlspecialchars($old['price'] ?? '') ?>"
               required>
      </div>

      <div class="form-group">
        <label class="form-label">Stock</label>
        <input type="number"
               min="0"
               class="form-input"
               name="stock_qty"
               value="<?= htmlspecialchars($old['stock_qty'] ?? 0) ?>">
      </div>

    </div>

    <div class="form-group">
      <label class="form-label">Image URL</label>
      <input class="form-input"
             name="image_url"
             value="<?= htmlspecialchars($old['image_url'] ?? '') ?>">
    </div>

    <div style="margin:2rem 0;display:flex;align-items:center;gap:10px;">
      <input type="checkbox"
             name="is_active"
             value="1"
             <?= !empty($old['is_active']) ? 'checked' : '' ?>>
      <span style="font-size:0.8rem;color:#aaa;text-transform:uppercase;letter-spacing:1px;">
        Article actif
      </span>
    </div>

    <div style="margin-top:3rem;">
      <button type="submit" class="btn btn-primary">
        Créer l’article
      </button>
    </div>

  </form>

</div>