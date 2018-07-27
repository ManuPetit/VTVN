<?php // script : headerconex.php
//inscrit les détails de base pour chaque page une fois connecté

//verifier que le script est atteint avec les variables necessaire
if ((!isset($_SESSION['v_mid'])) OR ($_SESSION['admin']==TRUE) OR (!isset($_SESSION['prenom'])) OR (!isset($_SESSION['lagent'])) OR ($_SESSION['lagent'] != md5($_SERVER['HTTP_USER_AGENT']))) {//accès par erreur.....
	//creation de l'URL de redirection
	$url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);
	//verifier pour le backslash
	if ((substr($url,-1) == '/') OR (substr($url,-1) == '\\')) {
		//enlever le slash
		$url=substr($url,0,-1);
	}
	//ajoute le nom du fichier
	$url .= '/echec.php';
	//rediriger
	ob_end_clean();
	header("Location: $url");
	exit();
} else { //creation des variables
	$u_id = $_SESSION['v_mid'];
	$prenom = $_SESSION['prenom'];
}

//connection to db
require_once('../../vtvn_connection.php');
//inclure les functions de database
require_once('./includes/db.inc.php');
//recuperation de l'image
$photo=get_image($u_id);


?>
