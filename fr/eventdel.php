<?php # script : event2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Annuler un &eacute;v&eacute;nement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

if ((isset($_GET['eveid'])) && (is_numeric($_GET['eveid']))) {//on a un event id
	$eve_id=$_GET['eveid'];
	$query="UPDATE vsysevents SET v_EventActif=0 WHERE v_EventID=$eve_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='event';
		$lienactif=NULL;
		include('./includes/membmenu.php'); 
		echo'<div id="mainMemb">';
	?>
		<p><span class="sstitre">Annuler un &eacute;v&eacute;nement</span></p><br />
		<p>Votre événement a été supprimé.</p>
	</div>

	<?php
		print_ligne(13);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} else {
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='event';
		$lienactif=NULL;
		include('./includes/membmenu.php'); 
		echo'<div id="mainMemb">';
	?>
		<p><span class="sstitre">Annuler un &eacute;v&eacute;nement</span></p><br />
		<p>Une erreur s'est produite. Veuillez contacter l'administrateur du site.</p>
	</div>

	<?php
		print_ligne(13);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
}
?>
	
