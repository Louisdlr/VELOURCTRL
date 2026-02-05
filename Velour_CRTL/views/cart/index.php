<script>
function getQuantity(id) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
	id = parseInt(id);
    for (let i = 0; i < cart.length; i++) {
        if (cart[i].id === id) {
            document.getElementById('quantity-amount-' + id).value = cart[i].quantity;
			return cart[i].quantity;
        }
    }
}

function calculateTotal() {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let total = 0;
    for (let i = 0; i < cart.length; i++) {
        let price = parseInt(document.getElementById('price-' + cart[i].id).innerHTML);
        let q = parseInt(cart[i].quantity);
        total += price * q;
    }
    document.getElementById('total-amount').innerHTML = "€ " +total;
    return total;
}

</script>

<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Panier</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Produit</th>
                                <th class="product-price">Prix</th>
                                <th class="product-quantity">Quantité</th>
                                <th class="product-remove">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $isEmpty = empty($params['products']);
                                if($isEmpty): ?>
                                    <p>Votre panier est vide.</p>
                                <?php else: ?>
                                    <?php foreach($params['products'] as $products):
                                            foreach($products as $product):?>    
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <img src="<?= IMG ?>/product/<?= $product->url_img ?>" alt="Image" class="img-fluid" height="100px" width="100px">
                                                    </td>
                                                    <td class="product-name">
                                                        <a class="h5 text-black" href="E-Commerce-BTS-SIO/E-Commerce/product/<?= $product->id ?>"><?= $product->name ?></a>
                                                    </td>
                                                    <td id="price-<?= $product->id ?>"><?= $product->price ?></td>
                                                    <td>
                                                        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 250px; padding-left: 155px;">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-outline-black decrease"  id="quantity-button" type="button" onclick="updateQuantityButton(<?= $product->id ?>, 'decrease')">&minus;</button>
                                                            </div>
                                                            <input type="text" class="form-control text-center quantity-amount" id="quantity-amount-<?= $product->id ?>" value="1" onkeyup="updateQuantity(<?= $product->id ?>, this.value)" placeholder="">
                                                            <script>
                                                                getQuantity(<?= $product->id ?>);
                                                            </script>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-black increase" type="button" onclick="updateQuantityButton(<?= $product->id ?>, 'increase')">&plus;</button>
                                                            </div>  
                                                        </div>          
                                                    </td>
                                                    <td><a onclick="removeFromCart(<?= $product->id ?>)" class="btn btn-black btn-sm">X</a></td>
                                                </tr>
                                    <?php endforeach ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>                         
                    <strong>Total: </strong><span id="total-amount"></span>                       
                </div>
            </form>
        </div>
        <form action="/E-Commerce-BTS-SIO/E-Commerce/order" method="POST">
            <?php foreach($params['products'] as $products):
                foreach($products as $product):?>    
                    <input name="id[]" type="hidden" value="<?= $product->id ?>">
                    <input id="productQuantity_<?= $product->id ?>" name="productQuantity_<?= $product->id ?>" type="hidden" value="">
                    <script>
                        document.getElementById('productQuantity_<?= $product->id ?>').value = getQuantity(<?= $product->id ?>);
                    </script>                
                <?php endforeach ?>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success">Commander</button>
        </form>
    </div>
</div>
<script>calculateTotal();</script>