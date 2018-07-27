<?php # script : docus.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Menu : Documents VTVN.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');
?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='docus';
	$lienactif=NULL;
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Menu : Documents VTVN</span></p><br />
<p>Choisissez dans le menu, les documents que vous souhaitez consulter, selon l'année.
</p>
</div>
	
<?php
print_ligne(12);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>