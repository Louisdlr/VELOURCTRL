<h2>Email: <?= $params['user']->email ?></h2>
<h3>First name: <?= $params['user']->first_name ?></h3>
<h3>Last name: <?= $params['user']->last_name ?></h3>
<h3>Date of birth: <?= $params['user']->date_of_birth ?></h3>
<h3>Gender: <?= $params['user']->gender ?></h3>

<?php
if ($params['user']->role == 0) {
    ?><h3>Role: Admin</h3> <?php
} elseif ($params['user']->role == 1) {
    ?><h3>Role: Seller</h3> <?php
} elseif ($params['user']->role == 2) {
    ?><h3>Role: Customer</h3> <?php
}
