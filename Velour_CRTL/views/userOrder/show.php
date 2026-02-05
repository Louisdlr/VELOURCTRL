<div class="row justify-content-center" style="margin-top: 10%;">
    <div class="col-8">
    <div class="card" id="order_card" style="padding: 50px 50px; margin-bottom: 10%; border-radius: 20px">

        <h1> La commande n° <?= $params['order']->order_number; ?></h1>
        <hr>
        <p> email : <?php echo $params['order']->email;?></p>
        <p>date de la commande : <?php echo $params['order']->date_order; ?></p>

        <?php foreach ($params['product'] as $product) { ?>
            <p> produit : <?php echo $product->name; ?></p>
        <?php } ?>
        <ul>

        </ul>
        </p>
        <a class="btn btn-outline-primary" href="/e-commerce-BTS-SIO/E-Commerce/userOrder/">Retour en arriere </a>
    </div>
    </div>
</div>
