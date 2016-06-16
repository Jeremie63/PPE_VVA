<?php 
	session_start();
	if(isset($_SESSION['uti']) && $_SESSION['uti']==2)
	{
		include('header.php');
?>
		<div class="container">
			<div class="row">
				<div class="box">
					
					<div class="col-lg-12">
						<hr>
						<h2 class="intro-text text-center">
							<strong>Bienvenue, <?php echo $_SESSION['prenomUti']." ".$_SESSION['nomUti'];?></strong>
						</h2>
						<div class="col-sm-offset-4">
							<a class="btn btn-default col-sm-6" href="traitement_deconnexion.php">SE DECONNECTER</a>
						</div>
						<br>
						<hr>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="box">
					<hr>
					<h2 class="intro-text text-center">
						<strong>Que souhaitez-vous faire ?</strong>
					</h2>
					<hr>
					<div class="col-lg-12">
						<div class="col-sm-offset-1">
							<br>
							<a id="btEnregistrer" class="btn btn-default col-sm-5" href="enregistrement_heb.php">Enregistrer un hébergement</a>
							<a id="btEtat" class="btn btn-default col-sm-5" href="etat_reservations.php">Gérer l'état des réservations</a>
							<br>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
		if(isset($_SESSION['enregistOk']) && $_SESSION['enregistOk'] == true)
		{
			unset($_SESSION['enregistOk']);
			echo "<script>alert(`L'hébergement a bien été enregistré`);location.reload();</script>";
		}

		include('footer.php');
	}

	else
	{
		echo "Acc&egraves interdit";
	}
?>