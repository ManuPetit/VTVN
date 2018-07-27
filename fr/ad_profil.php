<?php # script : ad_monprofil.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Menu : profils.';
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
	$header='profils';
	$lienactif=NULL;
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Menu : profils</span></p><br />
<p>Dans cette section vous pouvez :<br  /><br  />1/ Créer de nouveau profil utilisateurs.<br  /><br  />2/ Modifier les profils d'utilisateurs.
</p>
</div>
	
<?php
print_ligne(8);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>