<div class="hero">
	<div class="container">
		<div class="row justify-content-between align-items-center">
			<div class="col-lg-5">
                <h1>Voici les produits correspondant à votre recherche</h1>
				<form action="/e-commerce-BTS-SIO/E-Commerce/homepage/search" method="POST">
					<div class="input-group">
						<input type="text" name="name" placeholder="chercher un produit" class="form-control" style="margin-right: 10px;border-radius: 5px;width: 30%;">
						<select name="categories" class="form-select" aria-label="Selectionner une catégorie" style="margin-right: 10px;border-radius: 5px;width: 20%;">
							<option value="" selected disabled>Catégorie</option>
							<option value="">aucune</option>
							<option value="toutes">toutes</option>
							<?php foreach ($params['categories'] as $category) { ?>
								<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
							<?php } ?>
						</select>
						<button type="submit" class="btn btn-secondary" style="border-radius: 20px; font-weight: 600;">Rechercher</button>
					</div>
				</form>
			</div>
			<div class="col-lg-7">
				<div class="hero-img-wrap">
					<img src="https://cdn-icons-png.flaticon.com/512/5212/5212398.png" alt="image de recherche produit" style="width: 50%; margin-left: 20%; margin-top: -100px;" >
				</div>
			</div>
		</div>
	</div>
</div>
<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">
				<?php if(empty($params['homepage'])): ?>
    				<p> aucun produit correspondant  :'( </p>
				<?php endif; ?>
				

		      		<!-- Start Column 1 -->
					<?php foreach ($params['homepage'] as $homepage) { ?>
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<a class="product-item" href="/e-commerce-BTS-SIO/E-Commerce/product/<?= $homepage->id; ?>">
						
							<img src="<?= IMG ?>/product/<?= $homepage->url_img ?>" class="img-fluid product-thumbnail">
							<h3 class="product-title" style = "font-size: 1.7rem;"><?php echo $homepage->name; ?></h3>
							<h3><?php foreach ($params['categories'] as $category) { ?> 
								<?php if($homepage->id_category == $category->id): ?>
								<?php echo "catégorie : ".$category->name; ?>
								<?php endif; ?>
								<?php } ?>
							</h3>
							<strong class="product-price"><?php echo $homepage->price." €"; ?></strong>

							<span class="icon-cross">
								<img src="../public/template_AMLEO/furni/images/cross.svg" class="img-fluid">
							</span>
						
						</a>
					</div> 
					<?php } ?>
				</div>
			</div>
</div>    
    
    
<!-- <?php if(empty($params['homepage'])): ?>
    <p> aucun produit correspondant  :'( </p>
<?php endif; ?>
<?php foreach ($params['homepage'] as $homepage) { ?>
    <div class="col-6" id="homepage_product">
    <p> produit : <?php echo $homepage->name; ?></p>
    <p> prix : <?php echo $homepage->price; ?></p>
    <p> description : <?php echo $homepage->short_content; ?></p>
    </div>
    <hr>

<?php } ?> -->

