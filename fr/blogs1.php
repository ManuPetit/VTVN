<?php # script : blogs1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Cr&eacute;er un article.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');
?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2>Bienvenue, <?php echo $prenom; ?> !</h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='blogs';
	$lienactif='blogs1';
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Cr&eacute;er un article</span></p><br />
Utilisez le menu de gauche pour sélectionner vos actions.<br  />La section &quot;mon profil&quot; vous permet de changer vos donn&eacute;es personnelles, votre mot de passe, ainsi que l'image associ&eacute;e &agrave; votre nom.<br  />
Dans &quot;mon &eacute;tablissement&quot;, vous pouvez modifier les renseignements de votre commerce, sa description et changer les images qui apparaissent sur le site.<br  />
Le menu &quot;mes &eacute;v&eacute;nements&quot; vous permet d'afficher dans la section &eacute;v&eacute;nements du site, les soir&eacute;es ou autres activit&eacute;s sp&eacute;ciales que vous organisez.<br  />
&quot;Documents VTVN&quot; vous permet de voir les divers compte rendu de meeting de l'association.<br  />
&quot;Photos&quot;.... A vous de d&eacute;couvrir....<br  />
Enfin, pour quitter cette partie du site cliquez sur &quot;Deconnexion&quot;.  
</p>
</div>
	
<?php
print_ligne(1);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>