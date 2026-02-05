<div class="col-12">
    <div class="row">
        <div class="col-10 offset-1">
            <form action="/E-Commerce-BTS-SIO/E-Commerce/productManagement/create/" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom du produit</label>
                    <input type="text" class="form-control form-control-border" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="short_content">Description</label>
                    <textarea class="form-control form-control-border" id="short_content" name="short_content"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Prix</label>
                    <input type="number" class="form-control form-control-border" id="price" name="price">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control form-control-border" id="stock" name="stock">
                </div>
                <div class="form-group">
                    <label for="id_category">Catégorie</label>
                    <select class="form-control form-control-border" name="id_category" id="id_category">
                        <option value=""></option>
                        <?php foreach($params['category'] as $category): ?>
                            <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category_id">Image</label>
                    <input type="file" class="form-control" name="url_img">
                </div>
                <div style="text-align: center; padding: 5%;">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>