<div class="container" style="margin-top: 50px;">
  <div class="row justify-content-between align-items-center">
    <div class="col-lg-6">
      <div class="img-wrap">
        <img id="img-product"src="<?= IMG ?>/product/<?= $params['product']->url_img ?>" width="500" height="500" alt="Image" class="img-fluid">
      </div>
    </div>
    <div class="col-lg-6">
      <h1 class="display-4"><?= $params['product']->name ?></h1>
      <p class="lead"><?= $params['product']->short_content ?></p>
      <p class="lead" style="display:none;" id="hiddenText"><?= $params['product']->content ?></p>
      <a href="#" onclick="showText(); return false;">Voir plus...</a>
      <h3 style="font-weight: bold;">Prix: <?= $params['product']->price ?> €</h3>
      <div class="col-lg-3">
        Quantité: 
        <select class="form-select form-select-lg mb-3" name="quantity">
          <?php for ($i = 1; $i <= 10; $i++): ?>
            <option id="quantity-product" value="<?= $i ?>"><?= $i ?></option>
          <?php endfor; ?>
        </select>
        <button class="btn btn-outline-success" onclick="addToCart(<?= $params['product']->id ?>)">Ajouter au panier</button>
      </div>
    </div>
  </div>
</div>
