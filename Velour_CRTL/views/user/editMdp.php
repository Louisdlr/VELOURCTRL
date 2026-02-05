
<div class="col-12">
    <div class="row">
        <div class="col-10 offset-1">
            <form action="/E-Commerce-BTS-SIO/E-Commerce/user/editMdp/<?= $params['user']->id ?>" method="POST">
                    
                <div class="form-group">
                    <label  for="password1">Mot de passe</label>
                    <input class="form-control form-control-border" type="password" id="password1" name="password1" required>
                </div>

                <div class="form-group">
                    <label  for="password2">Mot de passe</label>
                    <input class="form-control form-control-border" type="password" id="password2" name="password2" required>
                </div>

                <div style="text-align: center; padding: 5%;">
                    <button type="submit" class="btn btn-primary">Modifier mon mot de passe</button>
                    <button type="button" class="btn btn-primary" onclick="display_user()">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

