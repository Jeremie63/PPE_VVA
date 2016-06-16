<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Villages Vacances Alpes</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/vva.css" rel="stylesheet">
		<link href="css/zebra_pagination.css" rel="stylesheet">

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

	</head>

	<body>

		<!-- Titre -->
		<div class="brand">Villages Vacances Alpes</div>
		<div class="address-bar">Village du Guipello | Pelvoux</div>

		<!-- Navigation -->
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="accueil.php">Villages Vacances Alpes</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="accueil.php">Accueil</a>
						</li>
						<li>
							<a href="recherche.php">Rechercher un hébergement</a>
						</li>
						<?php
							if(isset ($_SESSION['uti']))
							{
								switch($_SESSION['uti'])
								{
									case(1):
										echo"<li>
											<a href='admin.php'>Compte Administrateur</a>
										</li>";
									break;
									case(2):
										echo"<li>
											<a href='avv.php'>Compte Gestionnaire</a>
										</li>";
									break;
									case(3):
										echo"<li>
											<a href='villageois.php'>Compte Villageois</a>
										</li>";
									break;
								}
							}
							else
							{
								echo"<li>
									<a href='connexion.php'>Se connecter</a>
									</li>";
							}
						?>
						<li>
							<a href="contact.php">Contact</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>