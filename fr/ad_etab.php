<?php # script : ad_etab.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Menu : &eacute;tablissements.';
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
	$header='etab';
	$lienactif=NULL;
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Menu : &eacute;tablissements</span></p><br />
<p>Dans cette section vous pouvez :<br  /><br  />1/ Créer des catégories d'établissement.<br  /><br  />2/ Modifier des catégories d'établissement.<br  /><br  />3/ Créer des &eacute;tablissements.<br  /><br  />4/ Changer la description des &eacute;tablissements.<br  /><br  />
</p>
</div>
	
<?php
print_ligne(4);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>