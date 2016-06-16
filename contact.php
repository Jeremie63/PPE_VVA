<?php
	session_start();
	include('header.php');
?>
	<div class="container">
		<div class="row">
			<div class="box">
				<div class="col-lg-12">
					<hr>
					<h2 class="intro-text text-center">
						<strong>Contacter VVA</strong>
					</h2>
					<hr>
				</div>
				<div class="col-md-8">
					<!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
					<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d21006.02014796748!2d2.353507!3d48.8438591!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1sfr!2sfr!4v1461414342315"></iframe>
				</div>
				<div class="col-md-4">
					<p>Téléphone:
						<strong>01.xx.xx.xx.xx</strong>
					</p>
					<p>Email:
						<strong><a href="mailto:vva@exemple.com">vva@exemple.com</a></strong>
					</p>
					<p>Adresse:
						<strong>36 rue des buissons
							<br>75005 Paris</strong>
					</p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="row">
			<div class="box">
				<div class="col-lg-12">
					<hr>
					<h2 class="intro-text text-center">
						<strong>Formulaire de contact</strong>
					</h2>
					<hr>
					<form role="form">
						<div class="row">
							<div class="form-group col-lg-4">
								<label>Votre nom :</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group col-lg-4">
								<label>Votre adresse mail :</label>
								<input type="email" class="form-control">
							</div>
							<div class="form-group col-lg-4">
								<label>Votre numéro de téléphone :</label>
								<input type="tel" class="form-control">
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-lg-12">
								<label>Votre message :</label>
								<textarea class="form-control" rows="6"></textarea>
							</div>
							<div class="form-group col-lg-12">
								<input type="hidden" name="save" value="contact">
								<button type="submit" class="btn btn-default">Envoyer</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php include('footer.php'); ?>