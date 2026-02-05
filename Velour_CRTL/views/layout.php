<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALMEO</title>
    <link rel="stylesheet" href="<?= SCRIPTS. 'css'. DIRECTORY_SEPARATOR .'style.css'?>">
    <link rel="stylesheet" href="<?= SCRIPTS. 'css'. DIRECTORY_SEPARATOR .'bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?= SCRIPTS. 'css'. DIRECTORY_SEPARATOR .'tiny-slider.css'?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://www.paypal.com/sdk/js?client-id=AT0DomiGr43YltVodg_ylTMHdnxi5aYG1wkEr-aErQwdqLtoxxBKEzkxEl75P9hTymeesSU3X78OYjcy"></script>
</head>
<body>


<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="/e-commerce-BTS-SIO/E-Commerce/homepage">ALMEO<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item "><a class="nav-link" href="/e-commerce-BTS-SIO/E-Commerce/homepage">Accueil</a></li>
						<li><a class="nav-link" href="#">Contactez nous</a></li>
						
						<?php 
						if(isset($_SESSION['is_admin'])): ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdownAdmins" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Admin
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownAdmins">
								<li><a class="dropdown-item" href="/e-commerce-BTS-SIO/E-Commerce/orderManagement/orders" style="color:black !important">gestion des commandes</a></li>
								<li><a class="dropdown-item" href="/e-commerce-BTS-SIO/E-Commerce/productManagement" style="color:black !important">ajouter un produit</a></li>
								<li><a class="dropdown-item" href="/e-commerce-BTS-SIO/E-Commerce/categoryManagement" style="color:black !important">ajouter une catégorie</a></li>
							</ul>
						</li>
						<?php endif; ?>

            <?php
       if(!isset($_SESSION['auth'])): ?>
      
      <?php else: ?>
		<?php if(!isset($_SESSION['is_admin'])): ?>
		<li class="nav-item "><a class="nav-link" href="/e-commerce-BTS-SIO/E-Commerce/userOrder">Vos commandes </a> </li>
		<?php endif; ?>
      <li class="nav-item ">
        <a class="nav-link" href="/e-commerce-BTS-SIO/E-Commerce/deconnection">Déconnexion </a> 
      </li>
      <?php endif; ?>

					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						
						<li><a class="nav-link"  href="E-Commerce-BTS-SIO/E-Commerce/login" onclick="display_user()" data-bs-toggle="modal" data-bs-target="#modalDisplay"><img src="<?= IMG ?>icons/user.svg"></a></li>
						<form id="cartForm" action="/e-commerce-BTS-SIO/E-Commerce/cart" method="GET">
							<input type="hidden" id="cartData" name="cart">
							<li><a class="nav-link" onclick="sendCart()"><img src="<?= IMG ?>icons/cart.svg"></a></li>
						</form>
					</ul>
				</div>
			</div>
				
		</nav>
		<div class="modal fade" id="modalDisplay" tabindex="-1" aria-labelledby="modal_label" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-4" id="modal_label">Modal title</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" id="display_modal">
					</div>
				</div>
			</div>
		</div>
    

        <?= $content ?>

		<footer class="footer-section">
			<div class="container relative">

				

				

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">ALMEO<span>.</span></a></div>
						<p class="mb-4"></p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">About us</a></li>
									<li><a href="#">Services</a></li>
									<li><a href="#">Blog</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>

							
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; ALMEO</a>  <!-- License information: https://untree.co/license/ -->
            </p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>
		</footer>
    
    
</body>
</html>

<script>

function addToCart(id) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let itemExists = false;

    for (let i = 0; i < cart.length; i++) {
        if (cart[i].id === id) {
            cart[i].quantity++;
            itemExists = true;
            break;
        }
    }

    if (!itemExists) {
        let item = {id: id, quantity: document.getElementById('quantity-product').value};
        cart.push(item);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
}


  // Function to delete an item from the cart in localStorage
  function removeFromCart(id) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    for (let i = 0; i < cart.length; i++) {
        if (cart[i].id === id) {
            cart.splice(i, 1);
            break;
        }
    }

    localStorage.setItem('cart', JSON.stringify(cart));
	sendCart();

}


  function updateQuantity(id, q) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    id = parseInt(id);
    q = parseInt(q);
    for (var i = 0; i < cart.length; i++) {
        if (cart[i].id === id) {
            cart[i].quantity = q;
            break;
        }
    }
    localStorage.setItem('cart', JSON.stringify(cart));
	sendCart();
}


	function updateQuantityButton(id, type) {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    for (var i = 0; i < cart.length; i++) {
        if (cart[i].id === id) {
			if (type === 'decrease') {
				if (cart[i].quantity > 1) {
					cart[i].quantity--;
				}
			} else if (type === 'increase') {
				cart[i].quantity++;
			}
            break;
        }
    }

    // Mettre à jour le localStorage avec les nouvelles données du panier
    localStorage.setItem('cart', JSON.stringify(cart));
	sendCart();

}

function sendCart() {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  document.getElementById('cartData').value = JSON.stringify(cart);
  document.getElementById('cartForm').submit();
}

function showText(){
    var text = document.getElementById("hiddenText");
    text.style.display = "block";
}

</script>

<script src="<?= SCRIPTS. 'js'. DIRECTORY_SEPARATOR .'bootstrap.bundle.min.js'?>"></script>
<script src="<?= SCRIPTS. 'js'. DIRECTORY_SEPARATOR .'tiny-slider.js'?>"></script>
<script src="<?= SCRIPTS. 'js'. DIRECTORY_SEPARATOR .'custom.js'?>"></script>
<script>
    function display_user() {
		let droit = <?= isset($_SESSION['auth']) ? (int)$_SESSION['auth'] : '3' ?>;
        switch(droit) {
            case 0:
            case 1:
                window.location.href = '/E-Commerce-BTS-SIO/E-Commerce/user_management/' + <?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '1' ?>;
                break;
            case 2:
                fetch('/E-Commerce-BTS-SIO/E-Commerce/user/edit/' + <?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '1' ?>)
                    .then(response => response.text())
                    .then((data) => {
                        document.getElementById('display_modal').innerHTML = data;
                        document.getElementById('modal_label').innerHTML = "Modifier mon compte";
                    });
                break;
            case 3:
                fetch('/E-Commerce-BTS-SIO/E-Commerce/login')
                    .then(response => response.text())
                    .then((data) => {
                        document.getElementById('display_modal').innerHTML = data;
                        document.getElementById('modal_label').innerHTML = "Se connecter";
                    });
                break;
        
		}
    }
	function display_register() {
		fetch('/E-Commerce-BTS-SIO/E-Commerce/signUp')
			.then(response => response.text())
			.then((data) => {
				document.getElementById('display_modal').innerHTML = data;
				document.getElementById('modal_label').innerHTML = "S'inscrire";
		});
	}
	function display_update_mdp() {
		fetch('/E-Commerce-BTS-SIO/E-Commerce/user/editMdp/<?= isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : '' ?>')
			.then(response => response.text())
			.then((data) => {
				document.getElementById('display_modal').innerHTML = data;
				document.getElementById('modal_label').innerHTML = "Modifier mon mot de passe";
		});
	}
	function display_createAddress() {
		fetch('/E-Commerce-BTS-SIO/E-Commerce/address/create/<?= isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : '' ?>')
			.then(response => response.text())
			.then((data) => {
				document.getElementById('display_modal').innerHTML = data;
				document.getElementById('modal_label').innerHTML = "Ajouter une adresse";
		});
	}
	function display_updateAddress() {
		fetch('/E-Commerce-BTS-SIO/E-Commerce/address/edit/<?= isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : '' ?>')
			.then(response => response.text())
			.then((data) => {
				document.getElementById('display_modal').innerHTML = data;
				document.getElementById('modal_label').innerHTML = "Modifier une adresse";
		});
	}
</script>
