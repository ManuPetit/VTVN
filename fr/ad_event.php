<?php # script : ad_event.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Menu : événement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');


?>
	<div id="longHaut">
	  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
	</div>
	<div id="longMilieu">
<?php	
	$header='event';
	$lienactif=NULL;
	include('./includes/admin.php'); 
	echo'<div id="mainMemb">';
?>
	<p><span class="sstitre">Menu : événement</span></p><br />
	<p>Vous pouvez créer un événement ou en modifier un existant.</p></div>
<?php
	print_ligne(10);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
?>
