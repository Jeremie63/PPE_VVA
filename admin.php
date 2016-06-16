<?php 
	session_start();
	if(isset($_SESSION['uti']) && $_SESSION['uti']==1)
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
						<strong>Créer un compte</strong>
					</h2>
					<hr>
					<div class="col-lg-12" id="divFormulaire">
						<span class="requis">* Champs requis</span>
						<br>
						<br>
						<form class='form-horizontal' action="traitement_inscription.php" onsubmit="return validerForm()" method="post" name="formInscription" id="formInscription">
							<div class="form-group">
								<label class="control-label col-sm-3" for="typeCompte" id="lbTypeCompte">*Type d'utilisateur : </label>
								<div class="col-sm-5">
									<select class="form-control" id="typeCompte" name="typeCompte" onchange="ajoutVil(this)" required>
										<option disabled selected>Sélectionnez un type de compte</option>
										<option value="ADM">Administrateur</option> 
										<option value="AVV">AVV</option>  
										<option value="VIL">Villageois</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-3" for="user" id="lbUser">*Login : </label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="user" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="mdp" id="lbMdp">*Mot de passe : </label>
								<div class="col-sm-5">
									<input class="form-control" type="password" name="mdp" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="nomCompte" id="lbNomCompte">*Nom de l'utilisateur : </label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="nomCompte" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="preCompte" id="lbPreCompte">*Prénom de l'utilisateur : </label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="preCompte" required>
								</div>
							</div>

							<div id="compteVil"></div>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<input class="btn btn-default" type="submit" value="Créer un compte">
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
	//fonction permettant d'ajouter les éléments du formulaire exclusifs aux comptes villageois à l'aide du framework javascript jQuery
    function ajoutVil()
    {
    	if(document.getElementById("typeCompte").value == "VIL")
    	{
	    	$("#compteVil").append("<div class='form-group'><label class='control-label col-sm-3' for='nomVil' id='lbNomVil'>*Nom du villageois : </label><div class='col-sm-5'><input type='text' name='nomVil' class='form-control' required>");
	    	$("#compteVil").append("<div class='form-group'><label class='control-label col-sm-3' for='preVil' id='lbPreVil'>*Prénom du villageois : </label><div class='col-sm-5'><input type='text' name='preVil' class='form-control' required>");
	    	$("#compteVil").append("<div class='form-group'><label class='control-label col-sm-3' for='mail' id='lbMail'>*Adresse mail du villageois : </label><div class='col-sm-5'><input type='email' name='mail' class='form-control' required>");
	    	$("#compteVil").append("<div class='form-group'><label class='control-label col-sm-3' for='telVil' id='lbTelVil'>Numéro de téléphone fixe du villageois : </label><div class='col-sm-5'><input type='number' min=0 name='telVil' class='form-control'>");
	    	$("#compteVil").append("<div class='form-group'><label class='control-label col-sm-3' for='portVil' id='lbPortVil'>Numéro de téléphone portable du villageois : </label><div class='col-sm-5'><input type='number' min=0 name='portVil' class='form-control'>");
	    	$("#compteVil").append("</div></div></div></div>");
    	}

    	else
    	{
    		document.getElementById("compteVil").innerHTML = "";
    	}
    }

    //fontion permettant de valider le formulaire de création de compte
    function validerForm()
    {
	    var user = document.forms["formInscription"]["user"].value;
	    var mdp = document.forms["formInscription"]["mdp"].value;
	    var nomCompte = document.forms["formInscription"]["nomCompte"].value;
	    var preCompte = document.forms["formInscription"]["preCompte"].value;
	    var typeCompte = document.forms["formInscription"]["typeCompte"].value;

	    user = user.replace(/^\s+/, '').replace(/\s+$/, '');
	    mdp = mdp.replace(/^\s+/, '').replace(/\s+$/, '');
	    nomCompte = nomCompte.replace(/^\s+/, '').replace(/\s+$/, '');
	    preCompte = preCompte.replace(/^\s+/, '').replace(/\s+$/, '');
	    typeCompte = typeCompte.replace(/^\s+/, '').replace(/\s+$/, '');

		if (user === '' || mdp === '' || nomCompte === '' || preCompte === '' || typeCompte === '')
		{
		    alert("Veuillez remplir tous les champs requis");
		    return false;
		}

		else
		{
		    if(typeCompte=="VIL")
		    {
				var nomVil = document.forms["formInscription"]["nomVil"].value;
				var preVil = document.forms["formInscription"]["preVil"].value;
		    	var mail = document.forms["formInscription"]["mail"].value;

		    	nomVil = nomVil.replace(/^\s+/, '').replace(/\s+$/, '');
			    preVil = preVil.replace(/^\s+/, '').replace(/\s+$/, '');
			    mail = mail.replace(/^\s+/, '').replace(/\s+$/, '');

		    	if(nomVil === '' || preVil === '' || mail === '')
		    	{
		    		alert("Veuillez remplir tous les champs requis");
	    			return false;
		    	}
			}
			else
			{
				return true;
			}
		}
    }
</script>
