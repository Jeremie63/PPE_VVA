<?php
/*
Si l'utilisateur est connecté en tant qu'admin et qu'il a rempli le formulaire précédent, alors on insert les données de compte utilisateur dans la BDD,
puis on redirige vers la page admin.
*/
	session_start();
	if(isset($_SESSION['uti']) && $_SESSION['uti']==1 && isset($_POST['mdp']))
	{
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');
		$req = $bdd->prepare('INSERT INTO compte VALUES (:user,:mdp,:nomcompte,:prenomcompte,:dateinscrip,:dateSupprAnnee"-":dateSupprMois"-":dateSupprJour,:typecompte)');

		$req->bindParam(":user",$_POST['user']);
		$req->bindParam(":mdp",$_POST['mdp']);
		$req->bindParam(":nomcompte",$_POST['nomCompte']);
		$req->bindParam(":prenomcompte",$_POST['preCompte']);
		$req->bindParam(":dateinscrip",date("Y-m-d"));
		$req->bindParam(":typecompte",$_POST['typeCompte']);
		$req->bindParam(":dateSupprJour",$_POST['dateSupprJour']);
		$req->bindParam(":dateSupprMois",$_POST['dateSupprMois']);
		$req->bindParam(":dateSupprAnnee",$_POST['dateSupprAnnee']);


		$req->execute();

		if($_POST['typeCompte']=='VIL')
		{
			$req = $bdd->prepare('INSERT INTO villageois VALUES (NULL,:user,:nomVil,:preVil,:mail,:telVil,:portVil)');
			
			$req->bindParam(":user",$_POST['user']);
			$req->bindParam(":nomVil",$_POST['nomVil']);
			$req->bindParam(":preVil",$_POST['preVil']);
			$req->bindParam(":mail",$_POST['mail']);
			$req->bindParam(":telVil",$_POST['telVil']);
			$req->bindParam(":portVil",$_POST['portVil']);

			$req->execute();
		}
		header('location:admin.php');
	}

	else
	{
		echo "Acc&egraves interdit";
	}
?>