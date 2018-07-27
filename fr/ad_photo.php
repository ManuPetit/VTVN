<?php # script : ad_photo.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Menu : photos.';
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
	$header='photo';
	$lienactif=NULL;
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Menu : photos</span></p><br />
<p>Dans cette section vous pouvez :<br  /><br  />1/ Créer des galeries photos.<br  /><br  />2/ Modifier des galeries photos.<br  /><br  />3/ Télécharger des photos.<br  /><br  />4/ Modifier les photos.<br  /><br  />
</p>
</div>
	
<?php
print_ligne(4);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>