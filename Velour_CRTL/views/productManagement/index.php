<div class="col-12">
    <div class="hero">  
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Produits</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="untree_co-section before-footer-section">
        <form action="/E-Commerce-BTS-SIO/E-Commerce/productManagement/search" method="POST">
            <div class="col-6 offset-3">
                <div class="row">
                    <div class="col-6">
                        <input type="text" name="name" placeholder="Nom" id="name_search" class="form-control form-control-border">
                    </div>
                    <div class="col-3">
                        <select class="form-control form-control-border" name="id_category" id="id_category">
                            <option value=""></option>
                            <?php foreach($params['category'] as $category): ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-dark"><i class="bi bi-search"></i></button>
                        <button type="button" class="btn btn-dark" onclick="display_add_product()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDisplay"><i class="bi bi-plus-lg"></i></button>
                    </div> 
                </div>
            </div>
        </form>
        <div class="container">
            <div class="row mb-5">
                <div class="site-blocks-table col-md-10 offset-1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Nom</th>
                                <th class="product-name">Prix</th>
                                <th class="product-name">Stock</th>
                                <th class="product-name">Modifier</th>
                                <th class="product-name">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($params['products'] as $product): ?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="public/img/product/<?= $product->url_img ?>" style="max-width: 60%;" alt="Image" class="img-fluid">
                                    </td>
                                    <td class="product-name"><h2 class="h5 text-black"><?= $product->name ?></h2></td>
                                    <td class="product-name"><?= $product->price ?>€</td>
                                    <td class="product-name" id="center-cpt-product">
                                        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-black decrease" type="button">−</button>
                                            </div>
                                            <input type="text" class="form-control text-center quantity-amount" value="<?= $product->stock ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-black increase" type="button">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-name">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDisplay" onclick="display_edit_product(<?= $product->id ?>)"><i class="bi bi-search"></i></button>
                                    </td>
                                    <td class="product-name">
                                     <form method="POST" action="/E-Commerce-BTS-SIO/E-Commerce/productManagement/delete/<?= $product->id ?>">
                                        <button type="submit" class="btn btn-black btn-sm">X</button>
                                     </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function display_add_product() {
        fetch('/E-Commerce-BTS-SIO/E-Commerce/productManagement/create')
            .then(response => response.text())
            .then((data) => {
                document.getElementById('display_modal').innerHTML = data;
                document.getElementById('modal_label').innerHTML = "Ajouter un produit";
        });
    }
    function display_edit_product(id) {
        fetch('/E-Commerce-BTS-SIO/E-Commerce/productManagement/edit/' + id)
            .then(response => response.text())
            .then((data) => {
                document.getElementById('display_modal').innerHTML = data;
                document.getElementById('modal_label').innerHTML = "Modifier le produit";
        });
    }
</script>