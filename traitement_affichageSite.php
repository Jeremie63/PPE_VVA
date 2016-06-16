<?php
	
	$bdd = new PDO('mysql:host=localhost;dbname=resa_vva;charset=utf8', 'root', '');
	$req = $bdd->prepare('SELECT cdSite, nomSite FROM site S');
	$req->execute();
	$res = $req->fetchall();

	foreach($res as $resu)
	{
		echo "<option value='".$resu['cdSite']."'>".$resu['nomSite']."</option>";
	}

?>