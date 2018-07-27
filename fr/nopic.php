<?php # script : photos1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Aucune Photo choisie.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

$requete=TRUE;
$errors=array();
//on recherche les images dans le fichiers de l'user
$query="SELECT v_EtabID FROM vsyscommerces WHERE v_MembreID=$u_id";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) == 1) {
	$row=mysql_fetch_array($result,MYSQL_NUM);
	//on retrouve notre dossier
	$etab_id=$row[0];
	
	//maintenant on update avec une empty string les deux fichiers photos
	$query="UPDATE vsyscomdetails SET v_Details=' ' WHERE v_EtabID=$etab_id AND ((v_DetailType=1) OR (v_DetailType=2))";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
}
	
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

<p><span class="sstitre">Aucune photo choisie</span></p><br />
<p>Vous avez décidé de n'avoir aucune photo sur la page de votre établissement sur le site du Vieux Nyons. La base de données du serveur à été mise à jour.  
</p>
</div>
	
<?php
print_ligne(13);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>