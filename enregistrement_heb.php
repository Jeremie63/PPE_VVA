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
						<strong>Enregistrer un hébergement</strong>
					</h2>
					<hr>
					<div class="col-lg-12" id="divFormulaire">
						<form class='form-horizontal' action="traitement_enregistrement_heb.php" method="post" enctype="multipart/form-data" name="formEnregistrement" id="formEnregistrement">
							<span class="requis">Tous les champs sont requis</span>
							<br>
							<br>
							<div class="form-group">
								<label class="control-label col-sm-3" for="typeHeb" id="lbTypeHeb">Type d'hébergement :</label>
								<div class="col-sm-5">
									<select class="form-control" name="typeHeb" required>
									   <option disabled selected>Choisissez un type d'hébergement</option>
									   <option value="APP">Appartement</option> 
									   <option value="BUN">Bungalow</option>
									   <option value="MOB">Mobil home</option>
									   <option value="CHA">Chalet</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="nomHeb">Nom de l'hébergement :</label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="nomHeb" required></br>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-3" for="type" id="lbSite">Veuillez choisir un site :</label>
								<div class="col-sm-5">
									<select class="form-control" name="selectSite">
										<option selected value='TOUT'>Tout site</option>
										<?php include("traitement_affichageSite.php"); ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="places">Nombre de places :</label>
								<div class="col-sm-5">
									<input class="form-control" type="number" min=1 name="places" required></br>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-3" for="surface">Surface : </label>
								<div class="col-sm-5">
									<input class="form-control" type="number" min=8 name="surface" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-3" for="internet">Internet :</label>
								<div class="col-sm-5">
									<input type="radio" name="internet" value="1" required>&nbsp;Oui
									&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="internet" value="0" required>&nbsp;Non
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-3" for="annee">Année :</label>
								<div class="col-sm-5">
									<input class="form-control" type="number" min=1950 max=<?php echo date('Y'); ?> name="annee" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-3" for="secteur">Secteur :</label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="secteur" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-3" for="orientation" id="lbOrientation">Orientation :</label>
								<div class="col-sm-5">
									<input type="radio" name="orientation" value="Nord" required>&nbsp;Nord
									&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="orientation" value="Sud" required>&nbsp;Sud
									&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="orientation" value="Est" required>&nbsp;Est
									&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="orientation" value="Ouest" required>&nbsp;Ouest
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-3" for="etat">Etat :</label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="etat" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="desc">Description :</label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="desc" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="annee">Tarif haute saison :</label>
								<div class="col-sm-5">
									<input class="form-control" type="number" min=50 name="hs" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="annee">Tarif moyenne saison :</label>
								<div class="col-sm-5">
									<input class="form-control" type="number" min=50 name="ms" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="annee">Tarif basse saison :</label>
								<div class="col-sm-5">
									<input class="form-control" type="number" min=50 name="bs" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="photo">Photo :</label>
								<div class="col-sm-5">
									<input type="hidden" name="MAX_FILE_SIZE" value="10000000000" />
									<input type="file" name="photo" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<input class="btn btn-default col-sm-4" type="submit" value="Enregistrer un hébergement">
									<a id="aRetour" class="btn btn-default col-sm-2" href="avv.php">Retour</a>
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
		echo "Acc&egraves interdit";
	}
?>

<script>
	// fonction permettant de valider le formulaire d'enregistrement d'hébergement
	function validerForm()
    {
	    var a=document.forms["formEnregistrement"]["nomHeb"].value;
	    var b=document.forms["formEnregistrement"]["secteur"].value;
	    var c=document.forms["formEnregistrement"]["etat"].value;
	    var d=document.forms["formEnregistrement"]["desc"].value;
	    var e=document.forms["formEnregistrement"]["typeHeb"].value;

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
</script>