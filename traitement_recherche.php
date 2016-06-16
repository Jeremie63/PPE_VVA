<?php
/*
La recherche prend en compte cinq critères : le type d'hébergement, le nombre de places, la surface, l'orientation et la présence d'une connexion internet.
On utilise des conditions pour vérifier quels critères ont été remplis par l'utilisateur.
*/
	session_start();
	if(isset($_POST['type']))
	{
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');

		if($_POST['type']=='TOUT')
		{
			if((isset($_POST['places']) && $_POST['places'] != '') || (isset($_POST['surface']) && $_POST['surface'] != '') || (isset($_POST['orientation']) && $_POST['orientation'] != '') || (isset($_POST['internet']) && $_POST['internet'] != ''))
			{
				$req = $bdd->prepare('SELECT NOMTYPEHEB,NOHEB,NOMHEB,NBPLACEHEB,SURFACEHEB,ORIENTATIONHEB,INTERNET,ANNEEHEB,SECTEURHEB,ETATHEB,PHOTOHEB,DESCRIHEB FROM hebergement H, type_heb T WHERE H.CODETYPEHEB=T.CODETYPEHEB AND (NBPLACEHEB=:places OR SURFACEHEB=:surface OR ORIENTATIONHEB=:orientation OR INTERNET=:internet)');
				$req->bindParam(":places",$_POST['places']);
				$req->bindParam(":surface",$_POST['surface']);
				$req->bindParam(":orientation",$_POST['orientation']);
				$req->bindParam(":internet",$_POST['internet']);
			}
			else
			{
				$req = $bdd->prepare('SELECT NOMTYPEHEB,NOHEB,NOMHEB,NBPLACEHEB,SURFACEHEB,ORIENTATIONHEB,INTERNET,ANNEEHEB,SECTEURHEB,ETATHEB,PHOTOHEB,DESCRIHEB FROM hebergement H, type_heb T WHERE H.CODETYPEHEB=T.CODETYPEHEB');
			}
		}
		
		else
		{
			$req = $bdd->prepare('SELECT NOMTYPEHEB,NOHEB,NOMHEB,NBPLACEHEB,SURFACEHEB,ORIENTATIONHEB,INTERNET,ANNEEHEB,SECTEURHEB,ETATHEB,PHOTOHEB,DESCRIHEB FROM hebergement H, type_heb T WHERE H.CODETYPEHEB=T.CODETYPEHEB AND (H.CODETYPEHEB=:type OR NBPLACEHEB=:places OR SURFACEHEB=:surface OR ORIENTATIONHEB=:orientation OR INTERNET=:internet)');
			$req->bindParam(":type",$_POST['type']);
			$req->bindParam(":places",$_POST['places']);
			$req->bindParam(":surface",$_POST['surface']);
			$req->bindParam(":orientation",$_POST['orientation']);
			$req->bindParam(":internet",$_POST['internet']);
		}

		$req->execute();
		$result = $req->fetchall();

		if ($req->rowCount()>0)
		{
			$i=0;
			foreach($result as $r)
			{
				$i = $i+1;

				$reqTarifHs = $bdd->prepare('SELECT PRIXHEB FROM tarif WHERE NOHEB=:noHeb AND CODESAISON="HS"');
				$reqTarifHs->bindParam(":noHeb",$r['NOHEB']);
				$reqTarifHs->execute();
				$resTarifHs = $reqTarifHs->fetchall();
				$_SESSION['resTarifHs'.$i]=$resTarifHs;

				$reqTarifMs = $bdd->prepare('SELECT PRIXHEB FROM tarif WHERE NOHEB=:noHeb AND CODESAISON="MS"');
				$reqTarifMs->bindParam(":noHeb",$r['NOHEB']);
				$reqTarifMs->execute();
				$resTarifMs = $reqTarifMs->fetchall();
				$_SESSION['resTarifMs'.$i]=$resTarifMs;

				$reqTarifBs = $bdd->prepare('SELECT PRIXHEB FROM tarif WHERE NOHEB=:noHeb AND CODESAISON="BS"');
				$reqTarifBs->bindParam(":noHeb",$r['NOHEB']);
				$reqTarifBs->execute();
				$resTarifBs = $reqTarifBs->fetchall();
				$_SESSION['resTarifBs'.$i]=$resTarifBs;	
			}

			$_SESSION['resultat']=$result;
			header('location:recherche.php');
		}

		else
		{
			$_SESSION['resultat']=false;
			header('location:recherche.php');
		}
	}

	else
	{
		echo "Acc&egraves direct interdit";
	}
?>