<div class="col-12">
    <div class="row">
        <div class="col-10 offset-1">
            <form action="/E-Commerce-BTS-SIO/E-Commerce/address/edit/<?= $params['user']->id ?>" method="POST">
                    
                <div class="form-group">
                    <label  for="address">Votre adresse est la suivante : <?php foreach($params['address'] as $address){ echo $address->address;}; ?></label>
                    <input class="form-control form-control-border" type="text" id="address" name="address" placeholder="veuillez entrer votre nouvelle adresse" required>
                </div>

                <div style="text-align: center; padding: 5%;">
                    <button type="submit" class="btn btn-primary">Modifier mon adresse</button>
                    <button type="button" class="btn btn-primary" onclick="display_user()">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>