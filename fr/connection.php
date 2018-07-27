<?php # script : connection.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Menu Principal.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

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
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
	//on affiche la derniere connexion
	if ($dernierLogin != "2") {
		echo '<p class="connexion">' . $dernierLogin . '<br  /></p>'; 
	}		
?>
<p>Utilisez le menu de gauche pour sélectionner vos actions.<br  /><br  />La section &quot;mon profil&quot; vous permet de changer vos donn&eacute;es personnelles, votre mot de passe, ainsi que l'image associ&eacute;e &agrave; votre nom.<br  /><br  />
Dans &quot;mon &eacute;tablissement&quot;, vous pouvez modifier les renseignements de votre commerce, sa description et changer les images qui apparaissent sur le site.<br  /><br  />
Le menu &quot;mes &eacute;v&eacute;nements&quot; vous permet d'afficher dans la section &eacute;v&eacute;nements du site, les soir&eacute;es ou autres activit&eacute;s sp&eacute;ciales que vous organisez.<br  /><br  />
&quot;Documents VTVN&quot; vous permet de voir les divers compte rendu de meeting de l'association.<br  /><br  />
&quot;Photos&quot;.... A vous de d&eacute;couvrir....<br  /><br  />
Enfin, pour quitter cette partie du site cliquez sur &quot;Deconnexion&quot;.  
</p>
</div>
	
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>