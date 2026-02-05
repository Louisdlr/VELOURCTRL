<div class="col-12">
    <div class="row">
        <div class="col-10 offset-1">
            <form action="/E-Commerce-BTS-SIO/E-Commerce/user/edit/<?= $params['user']->id ?>" method="POST">
                <div class="form-group">
                    <label  for="last_name">Nom</label>
                    <input class="form-control form-control-border" type="text" id="last_name" name="last_name" value="<?= $params['user']->last_name ?>">
                </div>
                <div class="form-group">
                    <label  for="first_name">Prénom</label>
                    <input class="form-control form-control-border" type="text" id="first_name" name="first_name" value="<?= $params['user']->first_name ?>">
                </div>
                <div class="form-group">
                    <label  for="email">E-mail</label>
                    <input class="form-control form-control-border" type="text" id="email" name="email" value="<?= $params['user']->email ?>">
                </div>
                <div class="form-group">
                    <label  for="date_of_birth">Date de naissance</label>
                    <input class="form-control form-control-border" type="date" id="date_of_birth" name="date_of_birth" value="<?= $params['user']->date_of_birth ?>">
                </div>
                <div class="form-group">
                    <label  for="gender">Civilité</label>
                    <select class="form-control form-control-border" id="gender" name="gender">
                        <option value="0" <?= $params['user']->gender == 0 ? 'selected' : '' ?>>Homme</option>
                        <option value="1" <?= $params['user']->gender == 1 ? 'selected' : '' ?>>Femme</option>
                        <option value="2" <?= $params['user']->gender == 2 ? 'selected' : '' ?>>Non spécifié</option>
                    </select>
                </div>
                <div style="text-align: center; padding: 7%; padding-top: 10%;">
                    <input type="submit" class="btn btn-primary" value="Modifier">
                    <?php if (!empty($params['address'])): ?>
                        <button type="button" class="btn btn-primary" onclick="display_updateAddress()">modifier mon adresse email</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-primary" onclick="display_createAddress()">Ajouter une adresse</button>
                    <?php endif; ?>
                    
                    <button type="button" class="btn btn-primary" onclick="display_update_mdp()">Modifier mon mot de passe</button>
                </div>
            </form>
        </div>
    </div>
</div>


