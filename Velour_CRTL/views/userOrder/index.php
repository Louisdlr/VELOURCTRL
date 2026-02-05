<?php if(!empty($params['orders'])): ?>
    
<div class="hero">
	<div class="container">
		<div class="row justify-content-between align-items-center">
			<div class="col-lg-5">
                <h1>Mes commandes</h1>

			</div>
		</div>
        
	</div>
</div>


<div class="row" style="margin: 20px">
    <div class="col-12">
        <div class="untree_co-section before-footer-section">
            <h2>Vos commandes les plus récentes :</h2>
            <hr>
            <div class="row">
                <?php foreach ($params['orders'] as $order) : ?>
                    <div class="col-4" id="card_orderManagement" style="padding: 10px">
                        <div class="card commande" style="padding: 20px; border-radius: 20px">
                            <div id="userOrderDiv" style="margin-top: 0px !important">
                                <li>
                                    <a id="userOrderDiv-a" href="/e-commerce-BTS-SIO/E-Commerce/userOrder/<?= $order->id;?>">
                                        Commande n° <?= $order->order_number; ?>
                                    </a>
                                    <p>date de la commande : <?= $order->date_order; ?></p>
                                    <button type="button" class="btn btn-outline-primary" onclick="document.location.href='/e-commerce-BTS-SIO/E-Commerce/userOrder/<?= $order->id;?>'">
                                        voir votre commande
                                    </button>
                                </li>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(empty($params['orders'])): ?>
        <p>Aucune commande à afficher</p>
    <?php endif; ?>
