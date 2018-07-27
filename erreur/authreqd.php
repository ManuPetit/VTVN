<?php  # script - headerUnCol.php

//Output buffering
ob_start();
//debut de session
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="nyons, vieux, drôme, provence, france" />
<link rel="SHORTCUT ICON" href="http://www.vieuxnyons.com/images/favicon.ico" />
<title>Erreur 401 sur www.vieuxnyons.com</title>
<style type="text/css">
div#enteteCentre {
	width:439px;
	height:280px;
	float: left;
	background-image: url(../images/css1/enteteErrFR.jpg);
	background-repeat: no-repeat;
}
</style>
<link href="../css1/cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../css1/colUn.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="conteneur">
	<div id="haut">
	  <div id="enteteGauche"></div>
	  <div id="enteteCentre"></div>
	  <div id="enteteDroit">Le site internet de l'association "Vie et Travail dans le Vieux Nyons"</div>
	</div>
	<div id="menuHaut">
	  <ul id="thicktabs">
		<?php // Mise en place du menu
			//Accueil
			if ($menu_item == 'accueil') {//menu accueil selectionner
				echo '<li><a id="leftmostitem" class="selected">Accueil</a></li>';
				echo "\n";
			} else {
				echo '<li><a id="leftmostitem" href="../fr/accueil.php">Accueil</a></li>';
				echo "\n";
			}
			
			//Calendrier
			if ($menu_item == 'calendrier') {//menu Calendrier selectionner
				echo '<li><a class="selected">Ev&eacute;nements</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../fr/calendrier.php">Ev&eacute;nements</a></li>';
				echo "\n";
			}
			
			//Commerces
			if ($menu_item == 'commerces') {//menu Commerces selectionner
				echo '<li><a class="selected">Commerces</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../fr/commerces.php">Commerces</a></li>';
				echo "\n";
			}
			
			//Archives
			if ($menu_item == 'archives') {//menu Archives selectionner
				echo '<li><a class="selected">Archives</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../fr/archives.php">Archives</a></li>';
				echo "\n";
			}
			
			//Histoire
			if ($menu_item == 'histoire') {//menu Histoire selectionner
				echo '<li><a class="selected">Histoire</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../fr/histoire.php">Histoire</a></li>';
				echo "\n";
			}
			
			//Liens
			if ($menu_item == 'liens') {//menu Liens selectionner
				echo '<li><a class="selected">Liens</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../fr/liens.php">Liens</a></li>';
				echo "\n";
			}
			/*
			//Le Blog
			if ($menu_item == 'blog') {//menu Le Blog selectionner
				echo '<li><a class="selected">Le Blog</a></li>';
				echo "\n";
			} else {
				echo '<li><a href="../fr/blog.php">Le Blog</a></li>';
				echo "\n";
			}
			*/
			//Membres
			if ($menu_item == 'membres') {//menu Membres selectionner
				echo '<li><a id="rightmostitem" class="selected">Membres</a></li>';
				echo "\n";
			} else {
				echo '<li><a id="rightmostitem" href="../fr/membres.php">Membres</a></li>';
				echo "\n";
			}
			?>
	  </ul>
	  <br style="clear:left" />
	</div>
	<div id="corpsLong">
	<!-- FIN Header -->
	<!-- DEBUT de la page web -->
	<div id="longHaut">
      <h2>Erreur HTTP 401 - Pas d'autorisation d'accès au document</h2>
    </div>
	<div id="longMilieu">
<p>
Veuillez contacter l'administrateur du serveur Web pour vérifier que vous disposez de l'autorisation permettant l'accès aux ressources demandées.
</p>
</div>
	<!-- FIN de la page web-->
<!-- DEBUT Footer-->
<div id="longBas"></div>
  <div id="pied">
    <ul id="menubas">
	  	<?php //Verification du menu présent
		
		//Mentions
		if ($menu_choix == 'mentions') {//menu Mentions selectionner
			echo '<li><a class="choisi">Mentions</a></li>';
			echo "\n";
		} else {
			echo '<li><a href="../fr/mentions.php">Mentions</a></li>';
			echo "\n";
		}
		
		//Contacts
		if ($menu_choix == 'contacts') {//menu Contacts selectionner
			echo '<li><a class="choisi">Contacts</a></li>';
			echo "\n";
		} else {
			echo '<li><a href="../fr/contacts.php">Contacts</a></li>';
			echo "\n";
		}
		
		//Plan
		if ($menu_choix == 'plan') {//menu Plan selectionner
			echo '<li><a class="choisi">Plan du site</a></li>';
			echo "\n";
		} else {
			echo '<li><a href="../fr/plan.php">Plan du site</a></li>';
			echo "\n";
		}
		?>
      </ul>
  </div>
</div>
</div>
</body>
</html>
<?php
//vider le buffer
ob_end_flush();
?>