<?php # script : ad_connect.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Connection Administration.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');
//afficher le dernier login si c'est l'ouverture de la page
if ($_SESSION['phase1'] == 1) {
	$dernierLogin=get_dernier_login($u_id);
	$_SESSION['phase1']=2;
} else {
	$dernierLogin = "2";
}
?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2>Bienvenue, <?php echo $prenom; ?> !</h2>
    </div>
	<div id="longMilieu">
<?php	
	$header=NULL;
	$lienactif=NULL;
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
	//on affiche la derniere connexion
	if ($dernierLogin != "2") {
		echo '<p class="connexion">' . $dernierLogin . '<br  /></p>'; 
	}		
?>

</div>
	
<?php
print_ligne(12);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>