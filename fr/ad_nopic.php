<?php # script : ad_nopic.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Créer un établissement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$badQuery=FALSE;
$errmsg=FALSE;

//on récupère le numéro d'établissement
if ((isset($_GET['etab'])) && (is_numeric($_GET['etab']))) {
	$etab_id=$_GET['etab'];
} elseif ((isset($_POST['etab'])) && (is_numeric($_POST['etab']))) {
	$etab_id=$_POST['etab'];
} else {
	$badQuery=TRUE;
	$errmsg .= "Page accédée par erreur.\n";
}

if (isset($etab_id)) {
	//on retrouve le nom de l'établissement
	$query="SELECT v_EtabNom, v_EtabFileNom FROM vsyscommerces WHERE v_EtabID=$etab_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_NUM);
		$etab_nom=$row[0];
		$dossier=$row[1];
	} else {
		$badQuery=TRUE;
		$errmsg .= "Impossible de retrouver le nom de l'etablissement.\n";
	}
	//on enregistre rien pour cet etablissement
	$query="INSERT INTO vsyscomdetails (v_EtabID, v_DetailType, v_Details) VALUES ( $etab_id, 1, ' '), ( $etab_id, 2, ' ')";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	if (!$result) {
		$badQuery=TRUE;
		$errmsg .= "Impossible d'enregistrer l'absence de photo.\n";
	}
}

if ($badQuery) {// on a eu un probleme
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
	<p><span class="sstitre">Créer un établissement</span></p><br />
		<p>Il est impossible au systeme de récuperer les détails pour créer un nouvel établissement. Veuillez contacter l'administrateur du site.</p><p>Problemes suivants:<?php echo "\n$errmsg"; ?></p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //  FIN DE "if ($badQuery) {

	
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

<p><span class="sstitre">Aucune photo choisie</span></p><br />
<p>Vous avez décidé de n'avoir aucune photo sur la page de l'établissement "<?php echo $etab_nom; ?>" sur le site du Vieux Nyons. La création de l'établissement est terminée.  
</p>
</div>
	
<?php
print_ligne(13);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>