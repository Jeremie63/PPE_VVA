<?php
// Ce fichier est responsable de le connexion et de l'initialisation des variables de session de type de compte
	session_start();
	if(isset($_POST['login']) && isset($_POST['mdp']))
	{
		$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');
		$req = $bdd->prepare('SELECT * FROM compte WHERE USER=:login AND MDP=:mdp');
		$req->bindParam(":login",$_POST['login']);
		$req->bindParam(":mdp",$_POST['mdp']);
		$req->execute();
		$result = $req->fetchall();

		if ($req->rowCount()>0)
		{
			foreach($result as $r)
			{
				$_SESSION['user']=$r['USER'];
				$_SESSION['mdpUti']=$r['MDP'];
				$_SESSION['nomUti']=$r['NOMCOMPTE'];
				$_SESSION['prenomUti']=$r['PRENOMCOMPTE'];
				switch($r['TYPECOMPTE'])
				{
					case ('ADM'):
						$_SESSION['uti']=1;
						header('location:admin.php');
						break;
					case ('AVV'):
						$_SESSION['uti']=2;
						header('location:avv.php');
						break;
					case ('VIL'):
						$_SESSION['uti']=3;
						header('location:villageois.php');
						break;
				}
			}
		}

		else
		{
			$_SESSION['echec']="Login et/ou mot de passe incorrect";
			header('location:connexion.php');
		}
	}

	else
	{
		echo "Acc&egraves interdit";
	}
?>