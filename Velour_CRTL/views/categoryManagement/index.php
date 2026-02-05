<p>Liste des catégories</p>

<form style="display:inline" action="/E-Commerce-BTS-SIO/E-Commerce/categoryManagement/search" method="POST">
  <input type="text" name="search" placeholder="Search..">
  <input type="submit" value="Rechercher">
</form>
<form style="display:inline" action="/E-Commerce-BTS-SIO/E-Commerce/categoryManagement/create" method="GET">
  <input type="submit" class="btn btn-info" value="Créer">
</form>
<?php
foreach($params['categories'] as $category): ?>
    <div class="card mb-3">
      <div class="card-body">
        <form action="/E-Commerce-BTS-SIO/E-Commerce/categoryManagement/edit/<?= $category->id; ?>" method="post">
          <input type="text" name="name" value="<?= $category->name; ?>">
          <input type="submit" class="btn btn-outline-success" id="name" value="Modifier">
          <form style="display:inline"  action="/E-Commerce-BTS-SIO/E-Commerce/categoryManagement/delete/<?= $category->id; ?>" method="POST">
            <input type="submit" class="btn btn-danger" value="supprimer"> 
          </form>
        </form>
      </div>
    </div>
<?php endforeach ?>  