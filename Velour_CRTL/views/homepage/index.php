
<div class="hero">
	<div class="container">
		<div class="row justify-content-between align-items-center">
			<div class="col-lg-5">
                <h1>Retrouver les Produits qui vous font rêver</h1>
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
					<img src="https://static.vecteezy.com/system/resources/previews/023/743/919/non_2x/courier-delivery-man-holding-parcel-box-with-mobile-phone-fast-online-delivery-service-online-ordering-internet-e-commerce-ideas-for-websites-or-banners-3d-perspective-illustration-free-png.png" alt="image de recherche produit" style="width: 60%; margin-left: 20%; margin-top: -100px;" >
				</div>
			</div>
		</div>
	</div>
</div>
<div class="product-section" >
	<div class="container">
		<div class="row">

			<!-- Start Column 1 -->
			<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
				<h2 class="mb-4 section-title">Récemment mis en ligne</h2>
				<p class="mb-4">Vous retrouverez ici les produits qui ont été mis en ligne récemment,   </p>
			</div> <!-- End Column 1 -->


			<?php foreach ($params['homepage'] as $homepage) { ?>
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="/e-commerce-BTS-SIO/E-Commerce/product/<?= $homepage->id; ?>">
						<img src="<?= IMG ?>/product/<?= $homepage->url_img ?>" class="img-fluid product-thumbnail">
						<h3 class="product-title"><?php echo $homepage->name; ?></h3>
						<strong class="product-price"><?php echo $homepage->price; ?> $</strong>

					</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>



<div class="product-section">
	<div class="container">
		<div class="row">



			<?php foreach ($params['randomBooks'] as $randombooks) { ?>
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
        <a class="product-item" href="/e-commerce-BTS-SIO/E-Commerce/product/<?= $randombooks->id; ?>">
            <img src="<?= IMG ?>/product/<?= $randombooks->url_img ?>" class="img-fluid product-thumbnail">
            <h3 class="product-title"><?php echo $randombooks->name; ?></h3>
            <strong class="product-price"><?php echo $randombooks->price; ?> $</strong>

            
        </a>
    </div>
        <?php } ?>
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
				    <h2 class="mb-4 section-title">Produit que vous pouriez aimer dans la catégorie <strong><?= $params['randomBooks'][0]->category_name ?></strong></h2>
				    <p class="mb-4">Vous retrouverez ici des produits de la catégorie <strong><?= $params['randomBooks'][0]->category_name ?></strong> une catégorie tendance</p>
                </div>
			</div> 
		</div>
	</div>
</div>

    
  
<div class="product-section">
	<div class="container">
		<div class="row">

                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
				    <h2 class="mb-4 section-title">produit que vous pouriez aimer dans la catégorie <strong><?= $params['randomElectronic'][0]->category_name ?></strong></h2>
				    <p class="mb-4">Vous retrouverez ici des produits de la catégorie <strong><?= $params['randomElectronic'][0]->category_name ?></strong> une catégorie très recherché</p>
                </div>


			<?php foreach ($params['randomElectronic'] as $randomElectronic) { ?>
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
        <a class="product-item" href="/e-commerce-BTS-SIO/E-Commerce/product/<?= $randomElectronic->id; ?>">
            <img src="<?= IMG ?>/product/<?= $randomElectronic->url_img ?>" class="img-fluid product-thumbnail">
            <h3 class="product-title"><?php echo $randomElectronic->name; ?></h3>
            <strong class="product-price"><?php echo $randomElectronic->price; ?> $</strong>

            
        </a>
    </div>
<?php } ?>
                
			</div> 
		</div>
	</div>
</div>


<div class="product-section">
	<div class="container">
		<div class="row">

			<?php foreach ($params['randomClothing'] as $randomClothing) { ?>
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
        <a class="product-item" href="/e-commerce-BTS-SIO/E-Commerce/product/<?= $randomClothing->id; ?>">
            <img src="<?= IMG ?>/product/<?= $randomElectronic->url_img ?>" class="img-fluid product-thumbnail">
            <h3 class="product-title"><?php echo $randomClothing->name; ?></h3>
            <strong class="product-price"><?php echo $randomClothing->price; ?> $</strong>

            
        </a>
    </div>
<?php } ?>
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
				    <h2 class="mb-4 section-title">produit que vous pouriez aimer dans la catégorie <strong><?= $params['randomClothing'][0]->category_name ?></strong></h2>
				    <p class="mb-4">Vous retrouverez ici des produits de la catégorie <strong><?= $params['randomClothing'][0]->category_name ?></strong> une catégorie très recherché</p>
                </div>
                
			</div> 
		</div>
	</div>
</div>

<!-- <div class="row" id="random_clothing">
    <h2>produit que vous pouriez aimer dans la catégory <?= $params['randomClothing'][0]->category_name ?></h1>
<?php foreach ($params['randomClothing'] as $randomClothing) { ?>
    <div class="col-6" id="random_Clothing">
    <p> produit : <?php echo $randomClothing->name; ?></p>
    <p> prix : <?php echo $randomClothing->price; ?></p>
    <p> description : <?php echo $randomClothing->short_content; ?></p>
    </div>
    <hr>

<?php } ?>

</div>

 -->
