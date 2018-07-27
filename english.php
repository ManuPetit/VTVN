<?php #script french.php
	  # ce script set la variable de session sur anglais et redriect sur le fichier principal
	ob_start();
	session_start();
	$_SESSION['lang']='gb';
	$url="principal.php"
	header("Location: $url");
	exit();
	ob_end_flush();
?>