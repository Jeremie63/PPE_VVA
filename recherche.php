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
						<strong>Rechercher un hébergement</strong>
					</h2>
					<hr>
				</div>
				<div class="col-lg-12" id="divFormulaire">
					<form class='form-horizontal' action="traitement_recherche.php" method="post" id="formRecherche">
						<span id="messageFerme" class="col-sm-offset-1"><strong>Le village ferme en période creuse du 2 Janvier au 4 Mars. Les réservations s'effectuent du Samedi au Samedi.</strong></span>
						<br><br><br>
						<div class="form-group">
							<label class="control-label col-sm-3" for="type" id="lbType">Type d'hébergement :</label>
							<div class="col-sm-5">
								<select class="form-control" name="type">
									<option selected value='TOUT'>Tout type</option>
									<option value="APP">Appartement</option>
									<option value="BUN">Bungalow</option>
									<option value="MOB">Mobil home</option>
									<option value="CHA">Chalet</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="places" id="lbPlaces">Nombre de places :</label>
							<div class="col-sm-5">
								<input class="form-control" type="number" name="places">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="surface" id="lbSurface">Surface :</label>
							<div class="col-sm-5">
								<input class="form-control" type="number" name="surface">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="orientation" id="lbOrientation">Orientation :</label>
							<div class="col-sm-5">
								<input type="radio" name="orientation" value="nord">&nbsp;Nord
								&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="orientation" value="sud">&nbsp;Sud
								&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="orientation" value="est">&nbsp;Est
								&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="orientation" value="ouest">&nbsp;Ouest
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-sm-3" for="internet" id="lbInternet">Internet :</label>
							<div class="col-sm-5">
								<input type="radio" name="internet" value="1">&nbsp;Oui
								&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="internet" value="0">&nbsp;Non
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-3">
								<input class="btn btn-default form-control" type="submit" value="Rechercher">
							</div>
						</div>
					</form>
					<?php
						// si le résultat de la recherche est false, c'est qu'il est vide.
						if(isset($_SESSION['resultat']) && $_SESSION['resultat']==false)
						{
							echo "<br><div class='col-sm-offset-3 col-sm-3'>Aucun résultat trouvé</div>";
							unset($_SESSION['resultat']);
						}
					?>
				</div>
			</div>
		</div>
		<?php
			// si le réultat est true, alors afficher les résultats de la rehcerche avec la pagination
			if(isset($_SESSION['resultat']) && $_SESSION['resultat']!=false)
			{
				include 'pagination.class.php';
		        $pagination = new pagination($_SESSION['resultat'], (isset($_GET['page']) ? $_GET['page'] : 1), 5);
		        $pagination->setShowFirstAndLast(true);
		        $pagination->setMainSeperator(' | ');
		        $pagesResultats = $pagination->getResults();

		        if (count($pagesResultats) != 0)
		        {
			        echo $pageNumbers = '<div class="numbers">'.$pagination->getLinks($_GET).'</div>';
			        $i=0;
					foreach($pagesResultats as $r)
					{
						$i=$i+1;
						?>
						<div class="row">
							<div class="box">
								<div class="col-lg-12">
									<hr>
									<h2 class="intro-text text-center"><?php echo $r['NOMTYPEHEB']; ?>
										<strong><?php echo $r['NOMHEB']; ?></strong>
									</h2>
									<hr>
									<br>
									<p id="pHeb" class="col-sm-offset-1">
										<img align="right" height="250" width="400" id="photo" src='img/<?php echo $r['PHOTOHEB']; ?>'/>
										Nombre de places : <?php echo $r['NBPLACEHEB']; ?>
										<br>
										Surface : <?php echo $r['SURFACEHEB']; ?>&nbsp;m<sup>2</sup>
										<br>
										Orientation : <?php echo $r['ORIENTATIONHEB']; ?>
										<br>
										Internet : <?php if($r['INTERNET']==1){echo "Oui";}else{echo "Non";} ?>
										<br>
										Année : <?php echo $r['ANNEEHEB']; ?>
										<br>
										Secteur : <?php echo $r['SECTEURHEB']; ?>
										<br>
										Etat : <?php echo $r['ETATHEB']; ?>
										<br>
										Tarif haute-saison (du 4 Juin au 2 Septembre) : <?php foreach($_SESSION['resTarifHs'.$i] as $hs){echo $hs['PRIXHEB'];} ?> €
										<br>
										Tarif moyenne-saison (du 5 Mars au 3 Juin) : <?php foreach($_SESSION['resTarifMs'.$i] as $ms){echo $ms['PRIXHEB'];} ?> €
										<br>
										Tarif basse-saison (du 3 Septembre au 30 Décembre) : <?php foreach($_SESSION['resTarifBs'.$i] as $bs){echo $bs['PRIXHEB'];} ?> €
										<br>
										<p id="descriHeb" class="col-sm-offset-1">Description : <?php echo $r['DESCRIHEB']; ?></p>
									</p>
									<br>
									<?php
										if(!isset($_SESSION['uti']) || $_SESSION['uti']==1)
										{
											?>
											<form class='form-horizontal'>
												<div class="form-group">
													<div class="col-sm-offset-4 col-sm-4">
														<button onclick="return pasVillageois()" class="btn btn-default form-control">Réserver</button>
													</div>
												</div>
											</form>
											<?php
										}

										else
										{
											switch($_SESSION['uti'])
											{
												case 2:
													?>
													<form class='form-horizontal' action='traitement_modification_heb.php' method='post'>
														<div class="form-group">
															<div class="col-sm-offset-4 col-sm-4">
																<input type='hidden' name='noHeb' value='<?php echo $r['NOHEB']; ?>'/>
																<input class="btn btn-default form-control" type='submit' value='Modifier'>
															</div>
														</div>
													</form>
													<?php
													break;
												case 3:
													?>
													<form class='form-horizontal' action='traitement_reservation.php' method='post'>
														<div class="form-group">
															<div class="col-sm-offset-4 col-sm-4">
																<input type='hidden' name='noHeb' value='<?php echo $r['NOHEB']; ?>'/>
																<select class="form-control" name="selectSemaine" required>
																	<option disabled selected>Sélectionnez une semaine à réserver</option>
																	<?php
																		$gestion = false;
																		include('traitement_affichageSemaines.php');
																	?>
																</select>
																<br>
																<select class="form-control" name="selectOccupants" required>
																	<option disabled selected>Sélectionnez le nombre d'occupants</option>
																	<?php
																		for($j=1;$j<=$r['NBPLACEHEB'];$j++)
																		{
																			if($j==1)
																			{
																				echo "<option value='1'>1 personne</option>";
																			}
																			else
																			{
																				echo "<option value='".$j."'>".$j." personnes</option>";
																			}
																		}
																	?>
																</select>
																<br>
																<input class="btn btn-default form-control" type='submit' value='Réserver'>
															</div>
														</div>
													</form>
													<?php
													break;
											}
										}
									?>
								</div>
							</div>
						</div>
						<?php
					}
					?>
					<div class="row">
						<div class="box">
							<div class="col-lg-12">
								<hr>
								<h2 class="intro-text text-center">
									<strong>
										<?php echo $pageNumbers; ?>
									</strong>
								</h2>
								<hr>
							</div>
						</div>
					</div>
					<?php
				}
			}
		?>
	</div>
<?php
	// si les modifications d'hébergement ont bien été faites alors afficher message de confirmation
	if(isset($_SESSION['modifOk']) && $_SESSION['modifOk'] == true)
	{
		unset($_SESSION['modifOk']);
		unset($_SESSION['resultat']);
		echo "<script>alert('Vos modifications ont bien été effectuées');location.reload();</script>";
	}

	// si la réservation a bien été faite, alors afficher le message de confirmation contenant le numéro de réservation et le nom du logement
	if(isset($_SESSION['resaOk']) && $_SESSION['resaOk'] == true)
	{
		echo "<input type='hidden' value='".$_SESSION['numResa']."' id='numResa'>";
		echo "<input type='hidden' value='".$_SESSION['nomHebResa']."' id='nomHebResa'>";
		unset($_SESSION['resaOk']);
		unset($_SESSION['numResa']);
		unset($_SESSION['nomHebResa']);
		unset($_SESSION['resultat']);
		echo "<script>alert('Votre réservation a bien été effectuée. Veuillez noter votre numéro de réservation : '+document.getElementById(`numResa`).value+' ainsi que le nom de votre hébergement : '+document.getElementById(`nomHebResa`).value);location.reload();</script>";
	}

	include('footer.php');
?>
<script>
	// message si on clique sur réserver sans être connecté en tant que villageois
	function pasVillageois()
    {
    	alert("Vous devez être connecté en tant que villageois pour réserver un hébergement");
    	return false;
    }
</script>