<div class="col-12">
    <div class="row">
        <div class="col-10 offset-1">
            <form action="/E-Commerce-BTS-SIO/E-Commerce/signUp" method="POST">
                <div class="form-group">
                    <label  for="last_name">Nom</label>
                    <input class="form-control form-control-border" type="text" id="last_name" name="last_name">
                </div>
                <div class="form-group">
                    <label  for="first_name">Prénom</label>
                    <input class="form-control form-control-border" type="text" id="first_name" name="first_name">
                </div>
                <div class="form-group">
                    <label  for="password">Mots de passe</label>
                    <input class="form-control form-control-border" type="text" id="password" name="password">
                </div>
                <div class="form-group">
                    <label  for="email">E-mail</label>
                    <input class="form-control form-control-border" type="text" id="email" name="email">
                </div>
                <div class="form-group">
                    <label  for="date_of_birth">Date de naissance</label>
                    <input class="form-control form-control-border" type="date" id="date_of_birth" name="date_of_birth">
                </div>
                <div class="form-group">
                    <label  for="gender">Civilité</label>
                    <select class="form-control form-control-border" id="gender" name="gender">
                        <option value="0">Homme</option>
                        <option value="1">Femme</option>
                        <option value="2">Non spécifié</option>
                    </select>
                </div>
                <div style="text-align: center; padding: 7%; padding-top: 10%;">
                    <input type="submit" class="btn btn-primary" value="Creer un compte">
                    <button type="button" class="btn btn-primary" onclick="display_user()">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>


