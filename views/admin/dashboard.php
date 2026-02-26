

<div class="admin-view">

  <!-- SIDEBAR -->
  <div class="admin-sidebar">
    <h3>Navigation</h3>

    <a href="<?= BASE_URL ?>/admin" class="nav-item active">Dashboard</a><br><br>
    <a href="<?= BASE_URL ?>/admin/articles" class="nav-item">Articles</a><br><br>
    <a href="<?= BASE_URL ?>/admin/users" class="nav-item">Utilisateurs</a>
  </div>


  <!-- MAIN PANEL -->
  <div>

    <div style="border:1px solid rgba(220,208,255,0.1);padding:3rem;background:rgba(5,0,15,0.6);margin-bottom:3rem;position:relative;">

      <div style="position:absolute;inset:-2px;background:linear-gradient(135deg,#DCD0FF,transparent,#B57BFF);opacity:0.1;z-index:-1;"></div>

      <h2 class="glow-text-purple uppercase" style="margin-bottom:1.5rem;">
        Bienvenue Administrateur
      </h2>

      <p class="p-meta" style="max-width:600px;">
        Bienvenue sur le dashboard admin.  
        Utilisez les modules ci-dessous pour gérer les articles,
        surveiller les utilisateurs et contrôler l’activité de la plateforme.
      </p>

    </div>


    <!-- QUICK ACTIONS -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;">

      <div style="border:1px solid #222;padding:2rem;background:rgba(10,10,10,0.5);transition:0.3s;">
        <h3 class="glow-text-green uppercase" style="margin-bottom:1rem;">
          Gestion Articles
        </h3>
        <p class="p-meta" style="margin-bottom:1.5rem;">
          Créer, modifier et contrôler les produits.
        </p>
        <a href="<?= BASE_URL ?>/admin/articles" class="btn btn-primary">
          Accéder
        </a>
      </div>

      <div style="border:1px solid #222;padding:2rem;background:rgba(10,10,10,0.5);transition:0.3s;">
        <h3 class="glow-text-purple uppercase" style="margin-bottom:1rem;">
          Gestion Utilisateurs
        </h3>
        <p class="p-meta" style="margin-bottom:1.5rem;">
          Visualiser et administrer les comptes.
        </p>
        <a href="<?= BASE_URL ?>/admin/users" class="btn">
          Accéder
        </a>
      </div>

      <div style="border:1px solid #222;padding:2rem;background:rgba(10,10,10,0.5);transition:0.3s;">
        <h3 class="uppercase" style="margin-bottom:1rem;">
          Monitoring
        </h3>
        <p class="p-meta" style="margin-bottom:1.5rem;">
          Suivi global de l’activité plateforme.
        </p>
        <a href="<?= BASE_URL ?>/admin/articles" class="btn">
          Voir données
        </a>
      </div>

    </div>

  </div>

</div>