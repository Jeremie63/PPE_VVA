<?php
	session_start();
	include('header.php');
	if(!isset($_SESSION['uti']))
	{
?>
		<div class="container">
			<div class="row">
				<div class="box">
					<div class="col-lg-12">
						<hr>
						<h2 class="intro-text text-center">
							<strong>Se connecter à VVA</strong>
						</h2>
						<hr>
					</div>
						
					<div class='col-lg-12' id="divFormulaire">
						<?php
							if(isset($_SESSION['echec']))
							{
								echo"<span id='echec'>".$_SESSION['echec']."</span>";
								unset($_SESSION['echec']);
							}
						?>
						<form class='form-horizontal' action='traitement_connexion.php' method='post' id='formConnexion'>
							<div class="form-group">
								<label class="control-label col-sm-3" for="login" id="lbLogin">Login : </label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="login" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="mdp" id="lbMdp">Mot de passe : </label>
								<div class="col-sm-5">
									<input class="form-control" type="password" name="mdp" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<input class="btn btn-default" type="submit" value="Se connecter">
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
<?php
		include('footer.php');
	}

	else
	{
		switch($_SESSION['uti'])
		{
			case 1:
				header('location:admin.php');
				break;
			case 2:
				header('location:avv.php');
				break;
			case 3:
				header('location:villageois.php');
				break;
		}
	}
?>