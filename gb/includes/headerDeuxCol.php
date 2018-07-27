<?php  # script - headerDeuxCol.php

//Output buffering
ob_start();
//debut de session
session_start();

//Verifier le titre de la page
if (!isset($titre_page)) {
	$titre_page='VieuxNyons.com';
}

//verifier l'image de l'entete
if (!isset($image_entete)) {
	$image_entete='enteteAccueil';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="nyons, vieux, drôme, provence, france" />

<title><?php echo $titre_page; ?></title>
<style type="text/css">
div#enteteCentre {
	width:439px;
	height:280px;
	float: left;
	background-image: url(../images/css1/<?php echo $image_entete; ?>.jpg);
	background-repeat: no-repeat;
}
</style>
<link href="../css1/cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../css1/colDeux.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="conteneur">
	<div id="haut">
	  <div id="enteteGauche"></div>
	  <div id="enteteCentre"></div>
	  <div id="enteteDroit">The internet site of the association "Vie et Travail dans le Vieux Nyons"</div>
	</div>
	<div id="menuHaut">
	  <ul id="thicktabs">
		<?php // Mise en place du menu
			//Accueil
			if ($menu_item == 'accueil') {//menu accueil selectionner
				echo '<li><a id="leftmostitem" class="selected">Home</a></li>';
				echo "\n";
			} else {
				echo '<li><a id="leftmostitem" href="../gb/accueil.php">Home</a></li>';
				echo "\n";
			}
			
			//Calendrier
			if ($menu_item == 'calendrier') {//menu Calendrier selectionner
				echo '<li><a class="selected">Events</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../gb/calendrier.php">Events</a></li>';
				echo "\n";
			}
			
			//Commerces
			if ($menu_item == 'commerces') {//menu Commerces selectionner
				echo '<li><a class="selected">Shopping</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../gb/commerces.php">Shopping</a></li>';
				echo "\n";
			}
			
			//Archives
			if ($menu_item == 'archives') {//menu Archives selectionner
				echo '<li><a class="selected">Archives</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../gb/archives.php">Archives</a></li>';
				echo "\n";
			}
			
			//Histoire
			if ($menu_item == 'histoire') {//menu Histoire selectionner
				echo '<li><a class="selected">History</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../gb/histoire.php">History</a></li>';
				echo "\n";
			}
			
			//Liens
			if ($menu_item == 'liens') {//menu Liens selectionner
				echo '<li><a class="selected">Links</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../gb/liens.php">Links</a></li>';
				echo "\n";
			}
			
			?>
	  </ul>
	  <br style="clear:left" />
	</div>
	<div id="corps">
	<!-- FIN Header -->
	<!-- DEBUT de la page web -->
