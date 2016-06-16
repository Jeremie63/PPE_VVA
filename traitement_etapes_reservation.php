<?php
/*
Ce fichier est responsable du passage à l'étape suivante des réservations. Il y a 4 étapes, et 3 passages dont 2 nécessitant des données de l'utilisateur.
Pour le passage de E1 à E2 on prend automatiquement la date d'accusé en utilisant la fonction date().
Pour le passsage de E2 à E3 on prend le montant des arrhes et la date de versement fournis pour le gestionnaire.
Pour le passage de E3 à E4, une simple validation du gestionnaire suffit pour update le code de l'état de la réservation.
*/
	session_start();
	if(isset($_POST['codeEtape']))
	{
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');

		switch($_POST['codeEtape'])
		{
			case 'E1':
				$dateAccuse=date("Y-m-d");
				$codeEtape='E2';
				$req = $bdd->prepare('UPDATE resa SET DATEACCUSERECEPT=:dateAccuse,CODEETATRESA=:codeEtape WHERE NOHEB=:noHeb AND DATEDEBSEM=:dateDebSem');
				$req->bindParam(":noHeb",$_POST['noHeb']);
				$req->bindParam(":dateDebSem",$_POST['dateDebSem']);
				$req->bindParam(":dateAccuse",$dateAccuse);
				$req->bindParam(":codeEtape",$codeEtape);
				break;
			case 'E2':
				$codeEtape='E3';
				$req = $bdd->prepare('UPDATE resa SET MONTANTARRHES=:montantArrhes,CODEETATRESA=:codeEtape,DATEARRHES=:dateVersAnnee"-":dateVersMois"-":dateVersJour WHERE NOHEB=:noHeb AND DATEDEBSEM=:dateDebSem');
				$req->bindParam(":noHeb",$_POST['noHeb']);
				$req->bindParam(":dateDebSem",$_POST['dateDebSem']);
				$req->bindParam(":montantArrhes",$_POST['montantArrhes']);
				$req->bindParam(":dateVersAnnee",$_POST['dateVersAnnee']);
				$req->bindParam(":dateVersMois",$_POST['dateVersMois']);
				$req->bindParam(":dateVersJour",$_POST['dateVersJour']);
				$req->bindParam(":codeEtape",$codeEtape);
				break;
			case 'E3':
				$codeEtape='E4';
				$req = $bdd->prepare('UPDATE resa SET CODEETATRESA=:codeEtape WHERE NOHEB=:noHeb AND DATEDEBSEM=:dateDebSem');
				$req->bindParam(":noHeb",$_POST['noHeb']);
				$req->bindParam(":dateDebSem",$_POST['dateDebSem']);
				$req->bindParam(":codeEtape",$codeEtape);
				break;
		}
		$req->execute();

		$_SESSION['modifResa']=true;
		header('location:etat_reservations.php');
	}

	else
	{
		echo "Acc&egraves direct interdit";
	}
?>