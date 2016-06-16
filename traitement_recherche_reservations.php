<?php
/*
Seul le gestionnaire a accès à la recherche de réservations.
Les 3 critères pris en compte dans la recherche sont : le nom de l'hébergement, la semaine de réservation, et l'étape de la réservation
*/
	session_start();
	if(isset($_POST['nomHeb']) || isset($_POST['semaineResa']) || isset($_POST['etapeResa']))
	{
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');

		if($_POST['etapeResa']=='touteEtape')
		{
			if((isset($_POST['nomHeb']) && $_POST['nomHeb'] != '') && (isset($_POST['semaineResa']) && $_POST['semaineResa'] != '' && $_POST['semaineResa'] != "touteSemaine"))
			{
				$req = $bdd->prepare('SELECT R.NOHEB, H.NOMHEB,R.DATEDEBSEM,YEAR(R.DATEDEBSEM) as anneeDebut,MONTH(R.DATEDEBSEM) as moisDebut,DAY(R.DATEDEBSEM) as jourDebut,YEAR(DATEFINSEM) as anneeFin,MONTH(DATEFINSEM) as moisFin,DAY(DATEFINSEM) as jourFin,NOMVILLAGEOIS,PRENOMVILLAGEOIS,ADRMAIL,NOTEL,NOPORT,R.CODEETATRESA,DATERESA,DATEACCUSERECEPT,YEAR(DATEACCUSERECEPT) as anneeRecept,MONTH(DATEACCUSERECEPT) as moisRecept,DAY(DATEACCUSERECEPT) as jourRecept,YEAR(DATEARRHES) as anneeArrhes,MONTH(DATEARRHES) as moisArrhes,DAY(DATEARRHES) as jourArrhes,MONTANTARRHES,NBOCCUPANT,PRIXRESA,NOMETATRESA FROM resa R, hebergement H, villageois V, semaine S, etat_resa E WHERE H.NOHEB=R.NOHEB AND R.NOVILLAGEOIS=V.NOVILLAGEOIS AND R.DATEDEBSEM=S.DATEDEBSEM AND R.CODEETATRESA=E.CODEETATRESA AND H.NOMHEB=:nomHeb AND R.DATEDEBSEM=:semaineResa');
				$req->bindParam(":nomHeb",$_POST['nomHeb']);
				$req->bindParam(":semaineResa",$_POST['semaineResa']);
			}
			else
			{
				if(isset($_POST['nomHeb']) && $_POST['nomHeb'] != '')
				{
					$req = $bdd->prepare('SELECT R.NOHEB, H.NOMHEB,R.DATEDEBSEM,YEAR(R.DATEDEBSEM) as anneeDebut,MONTH(R.DATEDEBSEM) as moisDebut,DAY(R.DATEDEBSEM) as jourDebut,YEAR(DATEFINSEM) as anneeFin,MONTH(DATEFINSEM) as moisFin,DAY(DATEFINSEM) as jourFin,NOMVILLAGEOIS,PRENOMVILLAGEOIS,ADRMAIL,NOTEL,NOPORT,R.CODEETATRESA,DATERESA,DATEACCUSERECEPT,YEAR(DATEACCUSERECEPT) as anneeRecept,MONTH(DATEACCUSERECEPT) as moisRecept,DAY(DATEACCUSERECEPT) as jourRecept,YEAR(DATEARRHES) as anneeArrhes,MONTH(DATEARRHES) as moisArrhes,DAY(DATEARRHES) as jourArrhes,MONTANTARRHES,NBOCCUPANT,PRIXRESA,NOMETATRESA FROM resa R, hebergement H, villageois V, semaine S, etat_resa E WHERE H.NOHEB=R.NOHEB AND R.NOVILLAGEOIS=V.NOVILLAGEOIS AND R.DATEDEBSEM=S.DATEDEBSEM AND R.CODEETATRESA=E.CODEETATRESA AND H.NOMHEB=:nomHeb');
					$req->bindParam(":nomHeb",$_POST['nomHeb']);
				}

				else
				{
					if(isset($_POST['semaineResa']) && $_POST['semaineResa'] != '' && $_POST['semaineResa'] != "touteSemaine")
					{
						$req = $bdd->prepare('SELECT R.NOHEB, H.NOMHEB,R.DATEDEBSEM,YEAR(R.DATEDEBSEM) as anneeDebut,MONTH(R.DATEDEBSEM) as moisDebut,DAY(R.DATEDEBSEM) as jourDebut,YEAR(DATEFINSEM) as anneeFin,MONTH(DATEFINSEM) as moisFin,DAY(DATEFINSEM) as jourFin,NOMVILLAGEOIS,PRENOMVILLAGEOIS,ADRMAIL,NOTEL,NOPORT,R.CODEETATRESA,DATERESA,DATEACCUSERECEPT,YEAR(DATEACCUSERECEPT) as anneeRecept,MONTH(DATEACCUSERECEPT) as moisRecept,DAY(DATEACCUSERECEPT) as jourRecept,YEAR(DATEARRHES) as anneeArrhes,MONTH(DATEARRHES) as moisArrhes,DAY(DATEARRHES) as jourArrhes,MONTANTARRHES,NBOCCUPANT,PRIXRESA,NOMETATRESA FROM resa R, hebergement H, villageois V, semaine S, etat_resa E WHERE H.NOHEB=R.NOHEB AND R.NOVILLAGEOIS=V.NOVILLAGEOIS AND R.DATEDEBSEM=S.DATEDEBSEM AND R.CODEETATRESA=E.CODEETATRESA AND R.DATEDEBSEM=:semaineResa');
						$req->bindParam(":semaineResa",$_POST['semaineResa']);
					}

					else
					{
						$req = $bdd->prepare('SELECT R.NOHEB, H.NOMHEB,R.DATEDEBSEM,YEAR(R.DATEDEBSEM) as anneeDebut,MONTH(R.DATEDEBSEM) as moisDebut,DAY(R.DATEDEBSEM) as jourDebut,YEAR(DATEFINSEM) as anneeFin,MONTH(DATEFINSEM) as moisFin,DAY(DATEFINSEM) as jourFin,NOMVILLAGEOIS,PRENOMVILLAGEOIS,ADRMAIL,NOTEL,NOPORT,R.CODEETATRESA,DATERESA,DATEACCUSERECEPT,YEAR(DATEACCUSERECEPT) as anneeRecept,MONTH(DATEACCUSERECEPT) as moisRecept,DAY(DATEACCUSERECEPT) as jourRecept,YEAR(DATEARRHES) as anneeArrhes,MONTH(DATEARRHES) as moisArrhes,DAY(DATEARRHES) as jourArrhes,MONTANTARRHES,NBOCCUPANT,PRIXRESA,NOMETATRESA FROM resa R, hebergement H, villageois V, semaine S, etat_resa E WHERE H.NOHEB=R.NOHEB AND R.NOVILLAGEOIS=V.NOVILLAGEOIS AND R.DATEDEBSEM=S.DATEDEBSEM AND R.CODEETATRESA=E.CODEETATRESA');
					}
				}
			}
		}
		
		else
		{
			if((isset($_POST['nomHeb']) && $_POST['nomHeb'] != '') && (isset($_POST['semaineResa']) && $_POST['semaineResa'] != '' && $_POST['semaineResa'] != "touteSemaine"))
			{
				$req = $bdd->prepare('SELECT R.NOHEB, H.NOMHEB,R.DATEDEBSEM,YEAR(R.DATEDEBSEM) as anneeDebut,MONTH(R.DATEDEBSEM) as moisDebut,DAY(R.DATEDEBSEM) as jourDebut,YEAR(DATEFINSEM) as anneeFin,MONTH(DATEFINSEM) as moisFin,DAY(DATEFINSEM) as jourFin,NOMVILLAGEOIS,PRENOMVILLAGEOIS,ADRMAIL,NOTEL,NOPORT,R.CODEETATRESA,DATERESA,DATEACCUSERECEPT,YEAR(DATEACCUSERECEPT) as anneeRecept,MONTH(DATEACCUSERECEPT) as moisRecept,DAY(DATEACCUSERECEPT) as jourRecept,YEAR(DATEARRHES) as anneeArrhes,MONTH(DATEARRHES) as moisArrhes,DAY(DATEARRHES) as jourArrhes,MONTANTARRHES,NBOCCUPANT,PRIXRESA,NOMETATRESA FROM resa R, hebergement H, villageois V, semaine S, etat_resa E WHERE H.NOHEB=R.NOHEB AND R.NOVILLAGEOIS=V.NOVILLAGEOIS AND R.DATEDEBSEM=S.DATEDEBSEM AND R.CODEETATRESA=E.CODEETATRESA AND H.NOMHEB=:nomHeb AND R.DATEDEBSEM=:semaineResa AND R.CODEETATRESA=:etapeResa');
				$req->bindParam(":nomHeb",$_POST['nomHeb']);
				$req->bindParam(":semaineResa",$_POST['semaineResa']);
				$req->bindParam(":etapeResa",$_POST['etapeResa']);
			}

			else
			{
				if(isset($_POST['nomHeb']) && $_POST['nomHeb'] != '')
				{
					$req = $bdd->prepare('SELECT R.NOHEB, H.NOMHEB,R.DATEDEBSEM,YEAR(R.DATEDEBSEM) as anneeDebut,MONTH(R.DATEDEBSEM) as moisDebut,DAY(R.DATEDEBSEM) as jourDebut,YEAR(DATEFINSEM) as anneeFin,MONTH(DATEFINSEM) as moisFin,DAY(DATEFINSEM) as jourFin,NOMVILLAGEOIS,PRENOMVILLAGEOIS,ADRMAIL,NOTEL,NOPORT,R.CODEETATRESA,DATERESA,DATEACCUSERECEPT,YEAR(DATEACCUSERECEPT) as anneeRecept,MONTH(DATEACCUSERECEPT) as moisRecept,DAY(DATEACCUSERECEPT) as jourRecept,YEAR(DATEARRHES) as anneeArrhes,MONTH(DATEARRHES) as moisArrhes,DAY(DATEARRHES) as jourArrhes,MONTANTARRHES,NBOCCUPANT,PRIXRESA,NOMETATRESA FROM resa R, hebergement H, villageois V, semaine S, etat_resa E WHERE H.NOHEB=R.NOHEB AND R.NOVILLAGEOIS=V.NOVILLAGEOIS AND R.DATEDEBSEM=S.DATEDEBSEM AND R.CODEETATRESA=E.CODEETATRESA AND H.NOMHEB=:nomHeb AND R.CODEETATRESA=:etapeResa');
					$req->bindParam(":nomHeb",$_POST['nomHeb']);
					$req->bindParam(":etapeResa",$_POST['etapeResa']);
				}

				else
				{
					if(isset($_POST['semaineResa']) && $_POST['semaineResa'] != '' && $_POST['semaineResa'] != "touteSemaine")
					{
						$req = $bdd->prepare('SELECT R.NOHEB, H.NOMHEB,R.DATEDEBSEM,YEAR(R.DATEDEBSEM) as anneeDebut,MONTH(R.DATEDEBSEM) as moisDebut,DAY(R.DATEDEBSEM) as jourDebut,YEAR(DATEFINSEM) as anneeFin,MONTH(DATEFINSEM) as moisFin,DAY(DATEFINSEM) as jourFin,NOMVILLAGEOIS,PRENOMVILLAGEOIS,ADRMAIL,NOTEL,NOPORT,R.CODEETATRESA,DATERESA,DATEACCUSERECEPT,YEAR(DATEACCUSERECEPT) as anneeRecept,MONTH(DATEACCUSERECEPT) as moisRecept,DAY(DATEACCUSERECEPT) as jourRecept,YEAR(DATEARRHES) as anneeArrhes,MONTH(DATEARRHES) as moisArrhes,DAY(DATEARRHES) as jourArrhes,MONTANTARRHES,NBOCCUPANT,PRIXRESA,NOMETATRESA FROM resa R, hebergement H, villageois V, semaine S, etat_resa E WHERE H.NOHEB=R.NOHEB AND R.NOVILLAGEOIS=V.NOVILLAGEOIS AND R.DATEDEBSEM=S.DATEDEBSEM AND R.CODEETATRESA=E.CODEETATRESA AND R.DATEDEBSEM=:semaineResa AND R.CODEETATRESA=:etapeResa');
						$req->bindParam(":semaineResa",$_POST['semaineResa']);
						$req->bindParam(":etapeResa",$_POST['etapeResa']);
					}

					else
					{
						$req = $bdd->prepare('SELECT R.NOHEB, H.NOMHEB,R.DATEDEBSEM,YEAR(R.DATEDEBSEM) as anneeDebut,MONTH(R.DATEDEBSEM) as moisDebut,DAY(R.DATEDEBSEM) as jourDebut,YEAR(DATEFINSEM) as anneeFin,MONTH(DATEFINSEM) as moisFin,DAY(DATEFINSEM) as jourFin,NOMVILLAGEOIS,PRENOMVILLAGEOIS,ADRMAIL,NOTEL,NOPORT,R.CODEETATRESA,DATERESA,DATEACCUSERECEPT,YEAR(DATEACCUSERECEPT) as anneeRecept,MONTH(DATEACCUSERECEPT) as moisRecept,DAY(DATEACCUSERECEPT) as jourRecept,YEAR(DATEARRHES) as anneeArrhes,MONTH(DATEARRHES) as moisArrhes,DAY(DATEARRHES) as jourArrhes,MONTANTARRHES,NBOCCUPANT,PRIXRESA,NOMETATRESA FROM resa R, hebergement H, villageois V, semaine S, etat_resa E WHERE H.NOHEB=R.NOHEB AND R.NOVILLAGEOIS=V.NOVILLAGEOIS AND R.DATEDEBSEM=S.DATEDEBSEM AND R.CODEETATRESA=E.CODEETATRESA AND R.CODEETATRESA=:etapeResa');
						$req->bindParam(":etapeResa",$_POST['etapeResa']);
					}
				}
			}
		}

		$req->execute();
		$resa = $req->fetchall();

		if ($req->rowCount()>0)
		{
			$_SESSION['resa']=$resa;
			header('location:etat_reservations.php');
		}

		else
		{
			$_SESSION['resa']=false;
			header('location:etat_reservations.php');
		}
	}

	else
	{
		echo "Acc&egraves direct interdit";
	}
?>