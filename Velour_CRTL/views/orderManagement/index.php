<h1>liste des commandes </h1>

<hr>
<form action="/e-commerce-BTS-SIO/E-Commerce/orderManagement/search" method="POST" class="d-flex" style="width: 100%;">
    <div class="input-group ">
        <input type="text" name="name" placeholder="chercher par nom ou numero de commande" class="form-control" style="border-radius: 10px; margin: 10px ">
        <select name="status" class="form-control" style="border-radius: 10px; margin: 10px">
            
            <option value="5"></option>
            <option value="5">Tous</option>
            <option value= 4 >archive</option>
            <option value= 3 >refuser</option>
            <option value= 2 >validé</option>
            <option value= 1 >accpeter</option>
            <option value= 0 >en attente</option>
        </select>
        <div class="input-group-append">
            <input type="submit" value="appliquer" class="btn btn-primary" style="border-radius: 10px; margin: 15px ">
        </div>
    </div>
</form>

<div class="row" style="margin: 20px">
<div class="col-12">

<?php if(empty($params['orders'])): ?>
    
    <p>Aucune commande à afficher</p>
<?php else: ?>
    <div class="row">
    <?php foreach($params['orders'] as $order) : ?>
        
        <div class="col-4" id="card_orderManagement" style="padding: 10px">
            <div class="card commande" style="padding: 20px; border-radius: 20px">
            <h2> Commande <?= $order->order_number ; ?> </h2>
            <p>price : <?= $order->price ?></p>
            <p>order id : <?= $order->order_id ?></p>
            
            <p>Statut : <?php if($order->status == 0): ?>
                en attente 
            <?php elseif($order->status == 1): ?>
                accepter 
            <?php elseif($order->status == 2): ?>
                validé 
            <?php elseif($order->status == 3): ?>
                refusé
            <?php elseif($order->status == 4): ?>
                archivé 

            <?php endif; ?></p>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="/e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/<?= $order->order_id ?>"class="btn btn-outline-primary">Voir la commande</a>
                        <?php if($order->status != 4): ?>
                            <form style="display:inline"  action="/e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/delete/<?= $order->order_id; ?>" method="POST">
                                <input type="submit" class="btn btn-outline-danger" value="refuser"> 
                        
                            </form>
                        <?php endif; ?>
                        <?php if($order->status == 0): ?>
                            <form style="display:inline"  action="/e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/validate/<?= $order->order_id; ?>" method="POST">
                                <input type="submit" class="btn btn-outline-success" value="accepter"> 
                        
                            </form>
                        <?php endif; ?>
                        <?php if($order->status == 1): ?>
                            <form style="display:inline"  action="/e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/validateOrder/<?= $order->order_id; ?>" method="POST">
                                <input type="submit" class="btn btn-outline-success" value="valider commande"> 
                        
                            </form>
                        <?php endif; ?>
                        <?php if($order->status == 2): ?>
                            <form style="display:inline"  action="/e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/archive/<?= $order->order_id; ?>" method="POST">
                            <input type="submit" class="btn btn-outline-secondary" value="archiver"> 
                    
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
    <?php endforeach; ?>
    </div>
<?php endif; ?>


</div>
</div>


