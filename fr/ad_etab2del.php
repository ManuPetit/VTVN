<?php # script : ad_etab2del.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des �l�ments de la page
$titre_page='Supprimer un �tablissement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$badQuery=FALSE;
$errmsg=FALSE;
//on r�cup�re le num�ro d'�tablissement
if ((isset($_GET['etab'])) && (is_numeric($_GET['etab']))) {
	$etab_id=$_GET['etab'];
} else {
	$badQuery=TRUE;
	$errmsg .= "Page acc�d�e par erreur.\n";
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
	<p><span class="sstitre">Modifier un �tablissement</span></p><br />
		<p>Il est impossible au systeme de r�cuperer les d�tails pour modifier un �tablissement. Veuillez contacter l'administrateur du site.</p><p>Problemes suivants:<?php echo "\n$errmsg"; ?></p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //  FIN DE "if ($badQuery) {

//detruire les donn�es
$query="DELETE FROM vsyscommerces WHERE v_EtabID=$etab_id";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
$query="DELETE FROM vsyscomdetails WHERE v_EtabID=$etab_id";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
$query="DELETE FROM vsyscompict WHERE v_EtabID=$etab_id";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
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
<p><span class="sstitre">Supprimer un �tablissement</span></p><br />
	<p>Les donn�es de l'�tablissement selectionn� ont �t� supprim�es de la base de donn�es.</p></div>
	
<?php
	print_ligne(10);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
?>