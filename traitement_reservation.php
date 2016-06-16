<?php
	session_start();
	if(isset($_POST['noHeb']) && isset($_POST['selectSemaine']) && isset($_SESSION['uti']) && $_SESSION['uti'] == 3)
	{
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');
		$reqNoVil = $bdd->prepare('SELECT V.NOVILLAGEOIS FROM villageois V,compte C WHERE V.USER=C.USER=:user');
		$reqNoVil->bindParam(":user",$_SESSION['user']);
		$reqNoVil->execute();
		$resNoVil = $reqNoVil->fetchall();
		foreach($resNoVil as $r)
		{
			$noVil = $r['NOVILLAGEOIS'];
		}

		$reqSaison = $bdd->prepare('SELECT CODESAISON FROM semaine WHERE DATEDEBSEM=:selectSemaine');
		$reqSaison->bindParam(":selectSemaine",$_POST['selectSemaine']);
		$reqSaison->execute();
		$resSaison = $reqSaison->fetchall();
		foreach($resSaison as $r)
		{
			$saison = $r['CODESAISON'];
		}

		$reqPrix = $bdd->prepare('SELECT PRIXHEB FROM tarif WHERE NOHEB=:noHeb AND CODESAISON=:codeSaison');
		$reqPrix->bindParam(":noHeb",$_POST['noHeb']);
		$reqPrix->bindParam(":codeSaison",$saison);
		$reqPrix->execute();
		$resPrix = $reqPrix->fetchall();
		foreach($resPrix as $r)
		{
			$prixResa = $r['PRIXHEB'];
		}

		$etatResa="E1";
		$dateResa=date("Y-m-d");

		$req = $bdd->prepare('INSERT INTO resa VALUES (:noHeb,:selectSemaine,:noVil,:etatResa,:dateResa,NULL,NULL,NULL,:selectOccupants,:prixResa)');
		$req->bindParam(":noHeb",$_POST['noHeb']);
		$req->bindParam(":selectSemaine",$_POST['selectSemaine']);
		$req->bindParam(":noVil",$noVil);
		$req->bindParam(":etatResa",$etatResa);
		$req->bindParam(":dateResa",$dateResa);
		$req->bindParam(":selectOccupants",$_POST['selectOccupants']);
		$req->bindParam(":prixResa",$prixResa);
		$req->execute();

		$reqNumero = $bdd->prepare('SELECT R.NOHEB,H.NOMHEB,YEAR(DATEDEBSEM) as anneeDebut,MONTH(DATEDEBSEM) as moisDebut,DAY(DATEDEBSEM) as jourDebut FROM resa R, hebergement H WHERE R.NOHEB=H.NOHEB AND R.NOHEB=:noHeb AND DATEDEBSEM=:selectSemaine');
		$reqNumero->bindParam(":noHeb",$_POST['noHeb']);
		$reqNumero->bindParam(":selectSemaine",$_POST['selectSemaine']);
		$reqNumero->execute();
		$resNumero = $reqNumero->fetchall();

		if ($reqNumero->rowCount()>0)
		{
			foreach($resNumero as $r)
			{
				$numResa = $r['NOHEB'].$r['jourDebut'].$r['moisDebut'].$r['anneeDebut'];
				$nomHebResa = $r['NOMHEB'];
			}

			$_SESSION['numResa']=$numResa;
			$_SESSION['nomHebResa']=$nomHebResa;
			$_SESSION['resaOk']=true;
			header('location:recherche.php');
		}

		else
		{
			echo "Erreur";
		}
	}

	else
	{
		echo "Acc&egraves direct interdit";
	}
?>