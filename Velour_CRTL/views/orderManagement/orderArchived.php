<h1>liste des commandes archivées</h1>

<hr>



<?php foreach($params['_archived'] as $archived) : ?>

        <div>
            <h2> Commande <?= $archived->order_number ; ?></h2>
            <p>price : <?= $archived->price ?></p>
            <p>order id : <?= $archived->order_id ?></p>

            <p>Statut : 
            <?php if($archived->status == 3): ?>
                refusé
            <?php elseif($archived->status == 4): ?>
                archivé 
            <?php endif; ?></p>

            <a href="/e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/<?= $archived->order_id ?>"class="btn btn-outline-primary">Lire l'article</a>

            

            <hr>
        </div>

<?php endforeach; ?>


