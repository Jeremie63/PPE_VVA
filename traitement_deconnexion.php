<?php
// en cas de déconnexion on est déconnecté et rédirigé vers la page de connexion
	session_start();
	session_unset();
	session_destroy();
	header('location:connexion.php');
?>