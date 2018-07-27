<?php # script : ad_monprofil.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Menu : mon profil.';
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
	$header='profil';
	$lienactif=NULL;
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Menu : mon profil</span></p><br />
<p>Dans cette section vous pouvez :<br  /><br  />1/ Editez votre profil, nom, prénom, email.<br  /><br  />2/ Changer votre mot de passe.<br  /><br  />
3/ Selectionnez une image pour votre profil.
</p>
</div>
	
<?php
print_ligne(8);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>