	<body>
	<style>
		.img-oders {
			width: 450px; 
			position: absolute;
			top: 89px;
			left: 850px;
			border-radius: 10px;
			box-shadow: 0 8px 16px -2px rgba(0,0,0,0.2), 0 10px 24px -2px rgba(0,0,0,0.22);
		}
	</style>
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Commande</h1>
							</div>
						</div>
						<div class="col-lg-7">
							<img src="../public/img/view/order_img.jpg" class="img-oders" alt="">
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<div class="untree_co-section">
		    <div class="container">
		      	<div class="row">
		        	<div class="col-md-6 mb-5 mb-md-0">
		         		<h2 class="h3 mb-3 text-black">Détails de Facturation</h2>
		          		<div class="p-3 p-lg-5 border bg-white">
		            		<div class="form-group">
		              			<label for="address" class="text-black">Adresse <span class="text-danger">*</span></label>
								<select id="address" class="form-control">
									<option value=""></option>
									<?php foreach($params['address'] as $add): ?>
										<option value="<?= $add->id ?>"><?= $add->address ?></option>
									<?php endforeach; ?> 
								</select>
		            		</div>
							
							<div class="form-group row">
		             			 <div class="col-md-6">
									<label for="first_name" class="text-black">Prenom <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="first_name" name="first_name" value="<?= $params['user']->first_name ?>">
								</div>
								<div class="col-md-6">
									<label for="last_name" class="text-black">Nom de famille <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="last_name" name="last_name" value="<?= $params['user']->last_name ?>">
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-12">
									<label for="name_companyname" class="text-black">Nom de l'entreprise </label>
									<input type="text" class="form-control" id="name_companyname" name="name_companyname">
								</div>
							</div>

							<div class="form-group mt-3">
								<input type="text" class="form-control" placeholder="Appartement, suite, unité, etc.">
							</div>

							<div class="form-group row">
								<div class="col-md-6">
									<label for="name_city" class="text-black">Ville <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="name_city" name="name_city">
								</div>
								<div class="col-md-6">
									<label for="c_postal" class="text-black">Code Postal <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="c_postal" name="c_postal">
								</div>
							</div>

							<div class="form-group row mb-5">
								<div class="col-md-6">
									<label for="email" class="text-black">E-mail<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="email" name="email" value="<?= $params['user']->email ?>">
								</div>
								<div class="col-md-6">
									<label for="phone" class="text-black">Téléphone <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="phone" name="phone" placeholder="Numéro de telephone">
								</div>
							</div>

							<div class="form-group">
								<label for="order_notes" class="text-black">Remarques sur la commande</label>
								<textarea name="order_notes" id="order_notes" cols="30" rows="5" class="form-control" placeholder="Écrivez vos remarques ici..."></textarea>
							</div>

		          		</div>
		        	</div>
		        <div class="col-md-6">

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Votre Commande</h2>
		              <div class="p-3 p-lg-5 border bg-white">
		                <table class="table site-block-order-table mb-5">
		                  <thead>
		                    <th>Produits</th>
		                    <th>Total</th>
		                  </thead>
		                  <tbody>
							<?php foreach ($params['products'] as $product) : ?>
								<?php if(isset($product['name'])) : ?>
									<tr>
										<td><?= $product['name'] ?> <strong class="mx-2">x</strong> <?= $product['quantity'] ?></td>
										<td><?= $product['price']*$product['quantity'] ?></td>
									</tr>
								<?php endif; ?>
							<?php endforeach; ?>
							<tr>
								<td class="text-black font-weight-bold"><strong>Total</strong></td>
								<td class="text-black font-weight-bold"><strong><?= $params['products']['total_price'] ?></strong></td>
							</tr>
		                  </tbody>
		                </table>
		                 
		                <div class="border p-3 mb-5">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

		                  <div class="collapse" id="collapsepaypal">
		                    <div class="py-2">
		                      <p class="mb-0">
								<div id="paypal-button-container"></div>
							  </p>
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		          </div>

		        </div>
		      </div>
		      <!-- </form> -->
		    </div>
		  </div>
	</body>
<script>
	paypal.Buttons({
		createOrder: function(data, actions) {
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: '<?= $params['products']['total_price'] ?>'
					}
				}]
			});
		},
		onApprove: function(data, actions) {
			return actions.order.capture().then(function(details) {
				create_order();
			});
		},
		onError : function(err) {
			console.log(err);
			alert('Une erreur est survenue');
		}
		
	}).render('#paypal-button-container');
	
	function create_order(){
		let products = []; 

		<?php foreach ($params['products'] as $product) : ?>
			<?php if(isset($product['name'])) : ?>
				products.push({
					id: '<?= $product['id'] ?>',
					name: '<?= $product['name'] ?>',
					quantity: '<?= $product['quantity'] ?>',
					price: '<?= $product['price'] ?>'
				});
			<?php endif; ?>
		<?php endforeach; ?>
		
		let orderData = {
			products: products,
			id_user: '<?= $params['user']->id ?>',
			id_address: document.getElementById('address').value,
			price: '<?= $params['products']['total_price'] ?>' 
		};

		fetch('/E-Commerce-BTS-SIO/E-Commerce/order/create', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(orderData) // Utilisez orderData ici
		}).then(function(response) {
			return response.json();
		}).then(function(data) {
			console.log(data);
			window.location.href = '';
		})
		.catch(function(err) {
			console.log(err);
		});
				
	}
</script>
</html>
