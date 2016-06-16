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
					<div class="col-lg-12">
						<hr>
						<h2 class="intro-text text-center">
							<strong>Rechercher une réservation</strong>
						</h2>
						<hr>
					</div>
					<div class="col-lg-12" id="divFormulaire">
						<form class='form-horizontal' action="traitement_recherche_reservations.php" method="post" id="formEtatResa">
							<br><br><br>

							<div class="form-group">
								<label class="control-label col-sm-3" for="nomHeb" id="lbNomHeb">Nom de l'hébergement :</label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="nomHeb">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="selectSemaine" id="lbSemaine">Semaine de la réservation :</label>
								<div class="col-sm-4">
									<select class="form-control" name="semaineResa" required>
										<option value="touteSemaine" selected>Toute semaine</option>
										<?php
											$gestion = true;
											include('traitement_affichageSemaines.php');
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="selectEtape" id="lbEtape">Etape de la réservation :</label>
								<div class="col-sm-4">
									<select class="form-control" name="etapeResa" required>
										<option value="touteEtape" selected>Toute étape</option>
										<option value="E1">Prise en compte de la réservation</option>
										<option value="E2">Accusé de réception de la réservation</option>
										<option value="E3">Arrhes versées</option>
										<option value="E4">Clés données</option>
									</select>
								</div>
							</div>
							<br>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<input class="btn btn-default col-sm-4" type="submit" value="Rechercher">
									<a id="aRetour" class="btn btn-default col-sm-2" href="avv.php">Retour</a>
								</div>
							</div>
						</form>
						<?php
							if(isset($_SESSION['resa']) && $_SESSION['resa']==false)
							{
								echo "<br><div class='col-sm-offset-3 col-sm-3'>Aucun résultat trouvé</div>";
								unset($_SESSION['resa']);
							}
						?>
					</div>
				</div>
			</div>

			<?php
				// si la réservation a bien été effectuée, alors on affiche les résultats et on affiche la pagination
				if(isset($_SESSION['resa']) && $_SESSION['resa']!=false)
				{
					include 'pagination.class.php';
			        $pagination = new pagination($_SESSION['resa'], (isset($_GET['page']) ? $_GET['page'] : 1), 5);
			        $pagination->setShowFirstAndLast(true);
			        $pagination->setMainSeperator(' | ');
			        $pagesResultats = $pagination->getResults();

			        if (count($pagesResultats) != 0)
			        {
				        echo $pageNumbers = '<div class="numbers">'.$pagination->getLinks($_GET).'</div>';
						foreach($pagesResultats as $r)
						{
							?>
							<div class="row">
								<div class="box">
									<div class="col-lg-12">
										<hr>
										<h2 class="intro-text text-center"><?php echo "Réservation n°" ?>
											<strong><?php echo $r['NOHEB'].$r['jourDebut'].$r['moisDebut'].$r['anneeDebut']; ?></strong>
										</h2>
										<hr>
										<br>
										<p id="pHeb" class="col-sm-offset-1">
											Nom de l'hébergement : <?php echo $r['NOMHEB']; ?>
											<br>
											Etat de la réservation : <?php echo $r['NOMETATRESA']; ?>
											<br>
											Date de début de la réservation : <?php echo $r['jourDebut']."/".$r['moisDebut']."/".$r['anneeDebut']; ?>
											<br>
											Date de fin de la réservation : <?php echo $r['jourFin']."/".$r['moisFin']."/".$r['anneeFin']; ?>
											<br>
											Nombre d'occupants : <?php echo $r['NBOCCUPANT']; ?>
											<br>
											Nom du villageois responsable : <?php echo $r['NOMVILLAGEOIS']; ?>
											<br>
											Prénom du villageois responsable : <?php echo $r['PRENOMVILLAGEOIS']; ?>
											<br>
											Adresse mail du villageois responsable : <?php echo $r['ADRMAIL']; ?>
											<br>
											Numéro de téléphone fixe du villageois responsable : <?php echo $r['NOTEL']; ?>
											<br>
											Numéro de téléphone portable du villageois responsable : <?php echo $r['NOPORT']; ?>
											<?php if($r['CODEETATRESA']=="E2" || $r['CODEETATRESA']=="E3" || $r['CODEETATRESA']=="E4"){echo "<br>Date d'accusé de réception de la réservation : ".$r['jourRecept']."/".$r['moisRecept']."/".$r['anneeRecept'];} ?>
											<?php if($r['CODEETATRESA']=="E3" || $r['CODEETATRESA']=="E4") {echo "<br>Date de versement des arrhes : ".$r['jourArrhes']."/".$r['moisArrhes']."/".$r['anneeArrhes']."<br>Montant des arrhes versées : ".$r['MONTANTARRHES'];} ?>
										</p>
										<br>
										<?php
											switch($r['CODEETATRESA'])
											{
												case 'E1':
													?>
													<form class='form-horizontal' action='traitement_etapes_reservation.php' method='post'>
														<div class="form-group">
															<div class="col-sm-offset-4 col-sm-4">
																<input type='hidden' name='noHeb' value='<?php echo $r['NOHEB']; ?>' />
																<input type='hidden' name='dateDebSem' value='<?php echo $r['DATEDEBSEM']; ?>' />
																<input type='hidden' name='codeEtape' value='<?php echo $r['CODEETATRESA']; ?>' />
																<input class="btn btn-default form-control" type='submit' value="Passer à l'étape suivante">
															</div>
														</div>
													</form>
													<?php
													break;
												case 'E2':
													?>
													<form class='form-horizontal' action='traitement_etapes_reservation.php' method='post'>
														<div class="form-group">
															<input type='hidden' name='noHeb' value='<?php echo $r['NOHEB']; ?>' />
															<input type='hidden' name='dateDebSem' value='<?php echo $r['DATEDEBSEM']; ?>' />
															<input type='hidden' name='codeEtape' value='<?php echo $r['CODEETATRESA']; ?>' />
															<label class="control-label col-sm-3 col-sm-offset-1" for="montantArrhes" id="lbMontant">Montant des arrhes :</label>
															<div class="col-sm-2">
																<input class="form-control col-sm-2" type='number' name='montantArrhes' min=0 required>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-sm-3 col-sm-offset-1" for="dateVersJour" id="lbdateVers">Date de versement des arrhes : </label>
															<div class="col-sm-2">
																<select class="form-control" name="dateVersJour" required>
																	<?php
																		for($i=1;$i<=31;$i++){echo "<option value='";if($i<=9){echo"0";}echo $i."'>";if($i<=9){echo"0";}echo $i."</option>";} ?>
																</select>
															</div>
															<div class="col-sm-2">
																<select class="form-control" name="dateVersMois" required>
																	<?php for($j=1;$j<=12;$j++){echo"<option value='";if($j<=9){echo"0";}echo $j."'>";if($j<=9){echo"0";}echo $j."</option>";} ?>
																</select>
															</div>
															<div class="col-sm-2">
																<select class="form-control" name="dateVersAnnee" required>
																	<?php for($k=date("Y");$k<=2050;$k++){echo"<option value='".$k."'/>".$k."</option>";} ?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-4 col-sm-offset-4">
																<input class="btn btn-default form-control" type='submit' value="Passer à l'étape suivante">
															</div>
														</div>
													</form>
													<?php
													break;
												case 'E3':
													?>
													<form class='form-horizontal' action='traitement_etapes_reservation.php' method='post'>
														<div class="form-group">
															<div class="col-sm-offset-4 col-sm-4">
																<input type='hidden' name='noHeb' value='<?php echo $r['NOHEB']; ?>'/>
																<input type='hidden' name='dateDebSem' value='<?php echo $r['DATEDEBSEM']; ?>' />
																<input type='hidden' name='codeEtape' value='<?php echo $r['CODEETATRESA']; ?>' />
																<input class="btn btn-default form-control" type='submit' value="Passer à l'étape suivante">
															</div>
														</div>
													</form>
													<?php
													break;
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
		if(isset($_SESSION['modifResa']) && $_SESSION['modifResa'] == true)
		{
			unset($_SESSION['resa']);
			unset($_SESSION['modifResa']);
			echo "<script>alert(`Cette réservation est bien passée à l'étape suivante`);location.reload();</script>";
		}	

		include('footer.php');
	}

	else
	{
		echo "Acc&egraves interdit";
	}
?>