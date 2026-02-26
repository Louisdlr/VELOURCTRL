<div class="auth-container">

    <div class="auth-box">

        <h2 class="auth-header">
            <?= htmlspecialchars($title ?? 'Connexion') ?>
        </h2>

        <?php if (!empty($errors)): ?>
            <div class="p-meta" style="color:#ff4d4d;margin-bottom:1.5rem;">
                <ul style="list-style:none;padding:0;">
                    <?php foreach ($errors as $e): ?>
                        <li>• <?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/login">

            <div class="form-group">
                <label class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-input"
                    required>
            </div>

            <div class="form-group">
                <label class="form-label">Mot de passe</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-input"
                    required>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;margin-top:1rem;">
                Se connecter
            </button>

        </form>

        <div style="text-align:center;margin-top:1.5rem;">
            <a href="<?= BASE_URL ?>/register" class="p-meta" style="text-decoration:none;">
                Créer un compte
            </a>
        </div>

    </div>

</div>