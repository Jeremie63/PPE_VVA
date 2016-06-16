<?php
	session_start();
	if(isset($_SESSION['uti']) && $_SESSION['uti']==2 && isset($_SESSION['resHeb']))
	{
		include('header.php');
		foreach($_SESSION['resHeb'] as $r)
		{
			?>
			<div class="container">
				<div class="row">
					<div class="box">
						<div class="col-lg-12">
							<hr>
							<h2 class="intro-text text-center"><?php echo $r['NOMTYPEHEB']; ?>
								<strong><?php echo $r['NOMHEB']; ?></strong>
							</h2>
							<hr>
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
								<p id="descriHeb" class="col-sm-offset-1">Description : <?php echo $r['DESCRIHEB']; ?></p>
							</p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>

				<div class="row">
					<div class="box">
						<hr>
						<h2 class="intro-text text-center">
							<strong>Modification de l'hébergement</strong>
						</h2>
						<hr>
						<div class="col-lg-12" id="divFormulaire">
							<form class='form-horizontal' action="traitement_modification_heb.php" method="post" enctype="multipart/form-data" name="formEnregistrement" id="formEnregistrement">
								<span class="requis">Tous les champs sont requis</span>
								<br>
								<br>
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifType" id="lbTypeHeb">Type d'hébergement :</label>
									<div class="col-sm-5">
										<select class="form-control" name="modifType" required>
										   <option value="APP" <?php if($r['CODETYPEHEB']=='APP'){echo 'selected ';}?> >Appartement</option> 
										   <option value="BUN" <?php if($r['CODETYPEHEB']=='BUN'){echo 'selected ';}?> >Bungalow</option>
										   <option value="MOB" <?php if($r['CODETYPEHEB']=='MOB'){echo 'selected ';}?> >Mobil home</option>
										   <option value="CHA" <?php if($r['CODETYPEHEB']=='CHA'){echo 'selected ';}?> >Chalet</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-3" for="modifNom">Nom de l'hébergement :</label>
									<div class="col-sm-5">
										<input class="form-control" type="text" name="modifNom" value="<?php echo $r['NOMHEB']; ?>" required></br>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifPlaces">Nombre de places :</label>
									<div class="col-sm-5">
										<input class="form-control" type="number" min=1 name="modifPlaces" value="<?php echo $r['NBPLACEHEB']; ?>" required></br>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifSurface">Surface : </label>
									<div class="col-sm-5">
										<input class="form-control" type="number" min=8 name="modifSurface" value="<?php echo $r['SURFACEHEB']; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifInternet">Internet :</label>
									<div class="col-sm-5">
										<input type="radio" name="modifInternet" value="1" <?php if($r['INTERNET']==1){echo 'checked ';}?> required>&nbsp;Oui
										&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="modifInternet" value="0" <?php if($r['INTERNET']==0){echo 'checked ';}?> required>&nbsp;Non
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifAnnee">Année :</label>
									<div class="col-sm-5">
										<input class="form-control" type="number" min=1950 max=<?php echo date('Y'); ?> name="modifAnnee" value="<?php echo $r['ANNEEHEB']; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifSecteur">Secteur :</label>
									<div class="col-sm-5">
										<input class="form-control" type="text" name="modifSecteur" value="<?php echo $r['SECTEURHEB']; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifOrientation" id="lbOrientation">Orientation :</label>
									<div class="col-sm-5">
										<input type="radio" name="modifOrientation" value="Nord" <?php if($r['ORIENTATIONHEB']=='Nord'){echo 'checked ';}?> required>&nbsp;Nord
										&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="modifOrientation" value="Sud" <?php if($r['ORIENTATIONHEB']=='Sud'){echo 'checked ';}?> required>&nbsp;Sud
										&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="modifOrientation" value="Est" <?php if($r['ORIENTATIONHEB']=='Est'){echo 'checked ';}?> required>&nbsp;Est
										&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="modifOrientation" value="Ouest" <?php if($r['ORIENTATIONHEB']=='Ouest'){echo 'checked ';}?> required>&nbsp;Ouest
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifEtat">Etat :</label>
									<div class="col-sm-5">
										<input class="form-control" type="text" name="modifEtat" value="<?php echo $r['ETATHEB']; ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-3" for="modifDescri">Description :</label>
									<div class="col-sm-5">
										<input class="form-control" type="text" name="modifDescri" value="<?php echo $r['DESCRIHEB']; ?>" required>
									</div>
								</div>
								<?php foreach($_SESSION['resTarifHs'] as $hs) { ?>
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifHs">Tarif haute saison :</label>
									<div class="col-sm-5">
										<input class="form-control" type="number" min=50 name="modifHs" value="<?php echo $hs['PRIXHEB']; ?>" required>
									</div>
								</div>
								<?php } ?>
								<?php foreach($_SESSION['resTarifMs'] as $ms) { ?>
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifMs">Tarif moyenne saison :</label>
									<div class="col-sm-5">
										<input class="form-control" type="number" min=50 name="modifMs" value="<?php echo $ms['PRIXHEB']; ?>" required>
									</div>
								</div>
								<?php } ?>
								<?php foreach($_SESSION['resTarifBs'] as $bs) { ?>
								<div class="form-group">
									<label class="control-label col-sm-3" for="modifBs">Tarif basse saison :</label>
									<div class="col-sm-5">
										<input class="form-control" type="number" min=50 name="modifBs" value="<?php echo $bs['PRIXHEB']; ?>" required>
									</div>
								</div>
								<?php } ?>
								<div id="divModifPhoto"class="form-group">
									<div class="col-sm-offset-3 col-sm-5">
										<button onclick="afficherModifPhoto()">Changer la photo</button>
									</div>
								</div>

								<input type='hidden' name='modifNoHeb' value='<?php echo $r['NOHEB']; ?>'/>

								<!--<div class="form-group">
									<div class="col-sm-offset-3 col-sm-5">
										<input class="btn btn-default" type="submit" value="Modifier l'hébergement">
									</div>
								</div>-->

								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<input class="btn btn-default col-sm-4" type="submit" value="Modifier l'hébergement">
										<a id="aRetour" class="btn btn-default col-sm-2" href="recherche.php">Retour</a>
									</div>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
<?php
		} 
		include('footer.php');
		unset($_SESSION['resHeb']);
	}

	else
	{
		echo "Acc&egraves interdit";
	}
?>

<script>
	//fonction permettant de valider le formulaire de modification d'hébergement
	function validerForm()
    {
	    var a=document.forms["formEnregistrement"]["modifNom"].value;
	    var b=document.forms["formEnregistrement"]["modifSecteur"].value;
	    var c=document.forms["formEnregistrement"]["modifEtat"].value;
	    var d=document.forms["formEnregistrement"]["modifDescri"].value;
	    var e=document.forms["formEnregistrement"]["modifType"].value;

	    a = a.replace(/^\s+/, '').replace(/\s+$/, '');
	    b = b.replace(/^\s+/, '').replace(/\s+$/, '');
	    c = c.replace(/^\s+/, '').replace(/\s+$/, '');
	    d = d.replace(/^\s+/, '').replace(/\s+$/, '');
	    e = e.replace(/^\s+/, '').replace(/\s+$/, '');

		if (a === '' || b === '' || c === '' || d === '' || e === '')
		{
		    alert("Veuillez remplir tous les champs requis");
		    return false;
		}

		else
		{
			return true;
		}
    }

    //fonctions permettant d'afficher et de cacher le bouton parcourir de l'ajout de photo
    function afficherModifPhoto()
    {
    	document.getElementById("divModifPhoto").innerHTML = "<label class='control-label col-sm-3' for='modifPhoto'>Photo :</label><div class='col-sm-5'><input type='hidden' name='MAX_FILE_SIZE' value='10000000000' /><input type='file' name='modifPhoto' required><br><button onclick='cacherModifPhoto()'>Ne pas changer la photo</button></div>";
    }

    function cacherModifPhoto()
    {
    	document.getElementById("divModifPhoto").innerHTML = "<div class='col-sm-offset-3 col-sm-5'><button onclick='afficherModifPhoto()''>Changer la photo</button></div>";
    }
</script>