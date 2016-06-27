<?php
/*
Ce fichier est responsable de l'enregistrement de nouveaux hébergements dans une base de données MySQL
à partir d'un formulaire rempli par le gestionnaire sur la page précédente.
*/
	// On démarre la session pour récupérer les variables du formulaire rempli sur la page précédente
	session_start();
	/*
	Si la variable de session "uti" est déclarée et égale à 2, alors cela signifie que l'utilisateur est bien un gestionnaire.
	On vérifie également que la variable de session "nomHeb" est bien déclarée pour confirmer que le formulaire d'enregistrement
	du nouvel hébergement a bien été rempli. Si ces deux conditions sont remplies, alors l'enregistrement se poursuit.
	*/
	if(isset($_SESSION['uti']) && $_SESSION['uti']==2 && isset($_POST['nomHeb']))
	{
		// On instancie un objet PDO permettant de se connecter à la base de données MySQL avec le nom de la base de données et son mot de passe.
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');
		// On crée la requête SQL à effectuer sur la base de données pour enregistrer un hébergement, avec des paramètres pour éviter les injections SQL.
		$req = $bdd->prepare('INSERT INTO hebergement VALUES (NULL,:typeHeb,:nomHeb,:places,:surface,:internet,:annee,:secteur,:orientation,:etat,:descr,:photo,:site)');
		// Chaque paramètre est lié à une variable POST, celles-ci étant récupérées du formulaire rempli par le gestionnaire précédemment.
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
		// On exécute la requête SQL pour insérer l'enregistrement dans la base de données.
		$req->execute();
		// On crée une requête pour sélectionner le numéro de l'hébergement, auto-incrémenté au moment de l'enregistrement.
		$reqNo = $bdd->prepare('SELECT NOHEB FROM hebergement WHERE NOMHEB=:nomHeb');
		// On lie le paramètre du nom de l'hébergement dont on veut sélectionner le numéro.
		$reqNo->bindParam(":nomHeb",$_POST['nomHeb']);
		// On exécute la requête pour récupérer le numéro auto-incrémenté du nouvel hébergement.
		$reqNo->execute();
		// On récupère le résultat de la requête dans la variable $result
		$result = $reqNo->fetchall();
		// On parcourt le tableau $result : pour chaque résultat de la requête SELECT (il ne peut y en avoir qu'un car il n'y a qu'un formulaire) on effectue les opérations suivantes :
		foreach($result as $r)
		{
			// On effectue une requête pour insérer le tarif haute-saison de l'hébergement dans la base de données
			$reqTarifHs = $bdd->prepare('INSERT INTO tarif VALUES (:noHeb,"HS",:hs)');
			// On utilise le numéro de l'hébergement récupéré 
			$reqTarifHs->bindParam(":noHeb",$r['NOHEB']);
			$reqTarifHs->bindParam(":hs",$_POST['hs']);
			$reqTarifHs->execute();
			// On effectue une autre requête pour insérer le tarif moyenne-saison 
			$reqTarifMs = $bdd->prepare('INSERT INTO tarif VALUES (:noHeb,"MS",:ms)');
			$reqTarifMs->bindParam(":noHeb",$r['NOHEB']);
			$reqTarifMs->bindParam(":ms",$_POST['ms']);
			$reqTarifMs->execute();
			// Et enfin une dernière pour insérer le tarif basse-saison
			$reqTarifBs = $bdd->prepare('INSERT INTO tarif VALUES (:noHeb,"BS",:bs)');
			$reqTarifBs->bindParam(":noHeb",$r['NOHEB']);
			$reqTarifBs->bindParam(":bs",$_POST['bs']);
			$reqTarifBs->execute();
		}
		
		// On déclare le dossier d'upload de l'image de l'hébergement sous forme de string
		$uploaddir = "img/";
		// On y concatène le nom du fichier de l'image de l'hébergement
		$uploadfile = $uploaddir . basename($_FILES['photo']['name']);
		// On déplace le fichier uploadé avec le formulaire à la destination indiquée par la variable $uploadfile
		move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
		// On crée une variable de session nommée "enregistOk" et on y assigne le booléen true pour indiquer que l'enregistrement s'est correctement effectué.
		// A la page suivante on pourra ainsi afficher un message de confirmation.
		$_SESSION['enregistOk']=true;
		// Enfin, on redirige l'utilisateur vers la page du gestionnaire, nommée avv.php
		header('location:avv.php');
	}

	// Si les deux variables de sessions "uti" et "nomHeb" ne sont pas assignées ou que "uti" n'est pas égal à 2, alors on affiche "Accès interdit".
	else
	{
		echo "Acc&egraves interdit";
	}
?>
