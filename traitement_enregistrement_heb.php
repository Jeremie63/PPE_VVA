<?php
/*
Ce fichier est responsable de l'enregistrement de nouveaux hébergements : seul un utilisateur de type gestionnaire ayant rempli le formulaire peut accéder à ce
fichier. On insert les données dans la table hebergement, puis les tarifs dans la table tarif, puis on upload le fichier d'image de l'hébergement.
*/
	session_start();
	if(isset($_SESSION['uti']) && $_SESSION['uti']==2 && isset($_POST['nomHeb']))
	{
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');

		$req = $bdd->prepare('INSERT INTO hebergement VALUES (NULL,:typeHeb,:nomHeb,:places,:surface,:internet,:annee,:secteur,:orientation,:etat,:descr,:photo,:site)');
		$req->bindParam(":typeHeb",$_POST['typeHeb']);
		$req->bindParam(":nomHeb",$_POST['nomHeb']);
		$req->bindParam(":places",$_POST['places']);
		$req->bindParam(":surface",$_POST['surface']);
		$req->bindParam(":internet",$_POST['internet']);
		$req->bindParam(":annee",$_POST['annee']);
		$req->bindParam(":secteur",$_POST['secteur']);
		$req->bindParam(":orientation",$_POST['orientation']);
		$req->bindParam(":etat",$_POST['etat']);
		$req->bindParam(":descr",$_POST['desc']);
		$req->bindParam(":photo",$_FILES['photo']['name']);
		$req->bindParam(":site",$_POST['selectSite']);
		$req->execute();

		$reqNo = $bdd->prepare('SELECT NOHEB FROM hebergement WHERE NOMHEB=:nomHeb');
		$reqNo->bindParam(":nomHeb",$_POST['nomHeb']);
		$reqNo->execute();

		$result = $reqNo->fetchall();

		foreach($result as $r)
		{
			$reqTarifHs = $bdd->prepare('INSERT INTO tarif VALUES (:noHeb,"HS",:hs)');
			$reqTarifHs->bindParam(":noHeb",$r['NOHEB']);
			$reqTarifHs->bindParam(":hs",$_POST['hs']);
			$reqTarifHs->execute();

			$reqTarifMs = $bdd->prepare('INSERT INTO tarif VALUES (:noHeb,"MS",:ms)');
			$reqTarifMs->bindParam(":noHeb",$r['NOHEB']);
			$reqTarifMs->bindParam(":ms",$_POST['ms']);
			$reqTarifMs->execute();

			$reqTarifBs = $bdd->prepare('INSERT INTO tarif VALUES (:noHeb,"BS",:bs)');
			$reqTarifBs->bindParam(":noHeb",$r['NOHEB']);
			$reqTarifBs->bindParam(":bs",$_POST['bs']);
			$reqTarifBs->execute();
		}
		
		$uploaddir = "img/";
		$uploadfile = $uploaddir . basename($_FILES['photo']['name']);
		move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);

		$_SESSION['enregistOk']=true;
		header('location:avv.php');
	}

	else
	{
		echo "Acc&egraves interdit";
	}
?>