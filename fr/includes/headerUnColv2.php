<?php  # script - headerUnColv2.php


//Verifier le titre de la page
if (!isset($titre_page)) {
	$titre_page='VieuxNyons.com';
}

//verifier l'image de l'entete
if (!isset($image_entete)) {
	$image_entete='enteteAccueil';
}

//determiner la date pour afficher le css correct
date_default_timezone_set("Europe/Paris");
$ladate=getdate();
$lannee=$ladate['year'];
$dec1=mktime(0,0,0,12,1,$lannee);
$dec2=mktime(23,59,59,12,31,$lannee);
$jan1=mktime(0,0,0,1,1,$lannee);
$jan2=mktime(23,59,59,1,7,$lannee);

// Verification de la date ppour aficher le bon css fichier
if (($ladate[0] >= $dec1) && ($ladate[0] <= $dec2)){ //on utilise le css de noel
	$css="noel";
} elseif (($ladate[0] >= $jan1) && ($ladate[0] <= $jan2)){ //on utilise le css de noel
	$css="noel";
} else {
	$css="css1";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="nyons, vieux, drôme, provence, france" />
<link rel="SHORTCUT ICON" href="http://www.vieuxnyons.com/images/favicon.ico" />
<?php
if (isset($java)) {
	?>
		<script language="javascript">
		var popUpWin=0;
		function popUpWindow(URLStr, left, top, width, height)
		{
		  if(popUpWin)
		  {
			if(!popUpWin.closed) popUpWin.close();
		  }
		  popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
		}
		</script>
	<?php
}
?>
<title><?php echo $titre_page; ?></title>
<style type="text/css">
div#enteteCentre {
	<?php
	if ($css == "noel") {
		echo "width:228px;height:225px;";
	} else {
		echo "width:439px;height:280px;";
	}
	?>
	float: left;
	background-image: url(../images/<?php echo $css . "/" . $image_entete; ?>.jpg);
	background-repeat: no-repeat;
}
</style>
<link href="../<?php echo $css; ?>/cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../<?php echo $css; ?>/colUn.css" rel="stylesheet" type="text/css" />
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
