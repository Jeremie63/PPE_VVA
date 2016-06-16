<?php
/*
Ce fichier est responsable de l'affichage des semaines qui ne sont pas encore réservées dans la liste déroulante de la page de recherche d'hébergements.
Il affiche également les semaines qui ont déjà été réservées dans la liste déroulante de la page de recherche de réservations
*/
	if(isset($gestion) && $gestion==false)
	{
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');
		$req = $bdd->prepare('SELECT S.DATEDEBSEM, YEAR(S.DATEDEBSEM) as AnneeDeb, MONTH(S.DATEDEBSEM) as MoisDeb, DAY(S.DATEDEBSEM) as JourDeb, YEAR(S.DATEFINSEM) as AnneeFin, MONTH(S.DATEFINSEM) as MoisFin, DAY(S.DATEFINSEM) as JourFin FROM semaine S WHERE S.DATEDEBSEM NOT IN (SELECT R.DATEDEBSEM FROM resa R WHERE R.NOHEB=:noHeb) AND S.DATEDEBSEM > NOW()');
		$req->bindParam(":noHeb",$r['NOHEB']);
		$req->execute();
		$res = $req->fetchall();
	}

	else
	{
		if(isset($gestion) && $gestion==true)
		{
			$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');
			$req = $bdd->prepare('SELECT S.DATEDEBSEM, YEAR(S.DATEDEBSEM) as AnneeDeb, MONTH(S.DATEDEBSEM) as MoisDeb, DAY(S.DATEDEBSEM) as JourDeb, YEAR(S.DATEFINSEM) as AnneeFin, MONTH(S.DATEFINSEM) as MoisFin, DAY(S.DATEFINSEM) as JourFin FROM semaine S, resa R WHERE S.DATEDEBSEM=R.DATEDEBSEM');
			$req->execute();
			$res = $req->fetchall();
		}

		else
		{
			echo "Acc&egraves direct interdit";
		}
	}

	if(isset($res) && is_null($res)==false)
	{
		foreach($res as $re)
		{
			echo "<option value='".$re['DATEDEBSEM']."'>"."Semaine du ";

			if($re['JourDeb']<=9)
			{
				echo "0".$re['JourDeb'];
			}

			else
			{
				echo $re['JourDeb'];
			}

			echo "/";

			if($re['MoisDeb']<=9)
			{
				echo "0".$re['MoisDeb'];
			}

			else
			{
				echo $re['MoisDeb'];
			}

			echo "/".$re['AnneeDeb']." au ";

			if($re['JourFin']<=9)
			{
				echo "0".$re['JourFin'];
			}

			else
			{
				echo $re['JourFin'];
			}

			echo "/";

			if($re['MoisFin']<=9)
			{
				echo "0".$re['MoisFin'];
			}

			else
			{
				echo $re['MoisFin'];
			}

			echo "/".$re['AnneeFin']."</option>";
		}
	}

	else
	{
		if($gestion==false)
		{
			echo "<option value='aucune'>Aucune semaine de libre pour cet hébergement</option>";
		}
		else
		{
			echo "<option value='aucune'>Aucune réservation n'a encore été effectuée</option>";
		}
	}
?>