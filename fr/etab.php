<?php # script : etab.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Menu : mon &eacute;tablissement.';
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
	$header='etab';
	$lienactif=NULL;
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Menu : mon &eacute;tablissement</span></p><br />
<p>Dans cette section vous pouvez :<br  /><br  />1/ Editez les d&eacute;tails de votre &eacute;tablissement.<br  /><br  />2/ Changer la description de votre &eacute;tablissement.<br  /><br  />
3/ Modifier et télécharger de nouvelles photos pour votre &eacute;tablissement.
</p>
</div>
	
<?php
print_ligne(7);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>