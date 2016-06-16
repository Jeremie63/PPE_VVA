<?php 
	session_start();
	if(isset($_SESSION['uti']) && $_SESSION['uti']==3)
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
					
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
<?php 
		include('footer.php');
	}

	else
	{
		echo "Acc&egraves interdit";
	}
?>