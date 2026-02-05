<div class="row justify-content-center" style="margin-top: 10%;">
    <div class="col-8">
    <div class="card" id="order_card" style="padding: 50px 50px; margin-bottom: 10%; border-radius: 20px">
        <h1> la commande de : <?= $params['order']->id_user; ?></h1>
        <hr>
        <p> email : <?php echo $params['order']->email;?></p>
        <p>numéro de commande : <?php echo $params['order']->order_number; ?></p>

        <?php foreach ($params['product'] as $product) { ?>
            <p> produit : <?php echo $product->name; ?></p>
        <?php } ?>
        <ul>

        </ul>
        </p>
        <a class="btn btn-outline-primary" href="/e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/">Retour en arriere </a>

    </div>
    </div>
</div>
