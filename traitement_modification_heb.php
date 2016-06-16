<?php
/*
Lors de la première arrivée dans ce fichier à partir de la page de recherche, le gestionnaire obtient les tarifs puis est redirigé vers la page de
modifications de l'hébergement concerné.
Lors de la deuxième étape, la page de modifications le renvoie ici pour traiter les requêtes de type UPDATE nécessaires à la modification de l'hébergement qui
avait été sélectionné au début dans la page de recherche.
*/
	session_start();
	if(isset($_SESSION['uti']) && $_SESSION['uti']==2 && isset($_POST['noHeb']))
	{
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');

		$req = $bdd->prepare('SELECT H.CODETYPEHEB,NOMTYPEHEB,NOHEB,NOMHEB,NBPLACEHEB,SURFACEHEB,ORIENTATIONHEB,INTERNET,ANNEEHEB,SECTEURHEB,ETATHEB,PHOTOHEB,DESCRIHEB FROM hebergement H, type_heb T WHERE H.CODETYPEHEB=T.CODETYPEHEB AND NOHEB=:noHeb');
		$req->bindParam(":noHeb",$_POST['noHeb']);
		$req->execute();
		$resHeb = $req->fetchall();
		$_SESSION['resHeb']=$resHeb;

		foreach($resHeb as $r)
		{
			$reqTarifHs = $bdd->prepare('SELECT PRIXHEB FROM tarif WHERE NOHEB=:modifNoHeb AND CODESAISON="HS"');
			$reqTarifHs->bindParam(":modifNoHeb",$r['NOHEB']);
			$reqTarifHs->execute();
			$resTarifHs = $reqTarifHs->fetchall();
			$_SESSION['resTarifHs']=$resTarifHs;

			$reqTarifMs = $bdd->prepare('SELECT PRIXHEB FROM tarif WHERE NOHEB=:modifNoHeb AND CODESAISON="MS"');
			$reqTarifMs->bindParam(":modifNoHeb",$r['NOHEB']);
			$reqTarifMs->execute();
			$resTarifMs = $reqTarifMs->fetchall();
			$_SESSION['resTarifMs']=$resTarifMs;

			$reqTarifBs = $bdd->prepare('SELECT PRIXHEB FROM tarif WHERE NOHEB=:modifNoHeb AND CODESAISON="BS"');
			$reqTarifBs->bindParam(":modifNoHeb",$r['NOHEB']);
			$reqTarifBs->execute();
			$resTarifBs = $reqTarifBs->fetchall();
			$_SESSION['resTarifBs']=$resTarifBs;
		}

		header('location:modification_heb.php');
	}
	else
	{
		if(isset($_POST['modifType']) && isset($_POST['modifNom']) && isset($_POST['modifPlaces']) && isset($_POST['modifSurface']) && isset($_POST['modifOrientation']) && isset($_POST['modifInternet']) && isset($_POST['modifAnnee']) && isset($_POST['modifSecteur']) && isset($_POST['modifEtat']) && isset($_POST['modifDescri']) && isset($_POST['modifNoHeb']))
		{
			$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');

			if(isset($_FILES['modifPhoto']['name']))
			{
				$reqPhoto = $bdd->prepare('SELECT PHOTOHEB FROM hebergement WHERE NOHEB=:modifNoHeb');
				$reqPhoto->bindParam(":modifNoHeb",$_POST['modifNoHeb']);
				$reqPhoto->execute();
				$resPhoto = $reqPhoto->fetchall();

				foreach($resPhoto as $p)
				{
					unlink('img/'.$p['PHOTOHEB']);
				}

				$reqPhoto = $bdd->prepare('UPDATE hebergement SET PHOTOHEB=:modifPhoto WHERE NOHEB=:modifNoHeb');
				$reqPhoto->bindParam(":modifPhoto",$_FILES['modifPhoto']['name']);
				$reqPhoto->bindParam(":modifNoHeb",$_POST['modifNoHeb']);
				$reqPhoto->execute();

				$uploaddir = "img/";
				$uploadfile = $uploaddir . basename($_FILES['modifPhoto']['name']);
				move_uploaded_file($_FILES['modifPhoto']['tmp_name'], $uploadfile);
			}

			$req = $bdd->prepare('UPDATE hebergement SET CODETYPEHEB=:modifType,NOMHEB=:modifNom,NBPLACEHEB=:modifPlaces,SURFACEHEB=:modifSurface,ORIENTATIONHEB=:modifOrientation,INTERNET=:modifInternet,ANNEEHEB=:modifAnnee,SECTEURHEB=:modifSecteur,ETATHEB=:modifEtat,DESCRIHEB=:modifDescri WHERE NOHEB=:modifNoHeb');
			$req->bindParam(":modifNoHeb",$_POST['modifNoHeb']);
			$req->bindParam(":modifType",$_POST['modifType']);
			$req->bindParam(":modifNom",$_POST['modifNom']);
			$req->bindParam(":modifPlaces",$_POST['modifPlaces']);
			$req->bindParam(":modifSurface",$_POST['modifSurface']);
			$req->bindParam(":modifInternet",$_POST['modifInternet']);
			$req->bindParam(":modifAnnee",$_POST['modifAnnee']);
			$req->bindParam(":modifSecteur",$_POST['modifSecteur']);
			$req->bindParam(":modifOrientation",$_POST['modifOrientation']);
			$req->bindParam(":modifEtat",$_POST['modifEtat']);
			$req->bindParam(":modifDescri",$_POST['modifDescri']);
			$req->execute();

			$reqNoHeb = $bdd->prepare('SELECT NOHEB FROM hebergement WHERE NOMHEB=:modifNom');
			$reqNoHeb->bindParam(":modifNom",$_POST['modifNom']);
			$reqNoHeb->execute();
			$result = $reqNoHeb->fetchall();
			
			foreach($result as $r)
			{
				$reqTarifHs = $bdd->prepare('UPDATE tarif SET PRIXHEB=:modifHs WHERE NOHEB=:modifNoHeb AND CODESAISON="HS"');
				$reqTarifHs->bindParam(":modifNoHeb",$r['NOHEB']);
				$reqTarifHs->bindParam(":modifHs",$_POST['modifHs']);
				$reqTarifHs->execute();

				$reqTarifMs = $bdd->prepare('UPDATE tarif SET PRIXHEB=:modifMs WHERE NOHEB=:modifNoHeb AND CODESAISON="MS"');
				$reqTarifMs->bindParam(":modifNoHeb",$r['NOHEB']);
				$reqTarifMs->bindParam(":modifMs",$_POST['modifMs']);
				$reqTarifMs->execute();

				$reqTarifBs = $bdd->prepare('UPDATE tarif SET PRIXHEB=:modifBs WHERE NOHEB=:modifNoHeb AND CODESAISON="BS"');
				$reqTarifBs->bindParam(":modifNoHeb",$r['NOHEB']);
				$reqTarifBs->bindParam(":modifBs",$_POST['modifBs']);
				$reqTarifBs->execute();
			}

			$_SESSION['modifOk']=true;
			header('location:recherche.php');
		}

		else
		{
			{
				echo "Acc&egraves interdit";
			}
		}
	}

?>