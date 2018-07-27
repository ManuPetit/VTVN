<?php # script : event.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Menu : mes &eacute;v&eacute;nements.';
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
	$header='event';
	$lienactif=NULL;
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Menu : mes &eacute;v&eacute;nements</span></p><br />
<p>Dans cette section vous pouvez :<br  /><br  />1/ Ajouter un &eacute;v&eacute;nement relatif &agrave; votre &eacute;tablissement.<br  /><br  />2/ Changer la description de vos &eacute;v&eacute;nements.<br  /><br  />
3/ Annuler vos &eacute;v&eacute;nements.
</p>
</div>
	
<?php
print_ligne(7);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>