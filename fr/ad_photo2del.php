<?php # script : ad_photo2del.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Supprimer une galerie photo.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$err=FALSE;
$badQuery=FALSE;
if ((isset($_GET['picid'])) && (is_numeric($_GET['picid']))) {
	$pic_id=$_GET['picid'];
} else {
	$badQuery=TRUE;
}

if (!$badQuery) {
	$query="DELETE FROM vsysphotogroupes WHERE v_GroupeID=$pic_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	if ($result) {
		$query="DELETE FROM vsysphotos WHERE v_GroupeID=$pic_id";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		if ($result) {
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
			<p><span class="sstitre">Supprimer une galerie photo</span></p><br />
			<p>La galerie sélectionnée a été supprimée de la base de données. Les photos relatives à cette galerie ont aussi été supprimée.</p><br />
			</div>
			<?php
			print_ligne(12);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
		} else {
			$badQuery=TRUE;
		}
	} else {
		$badQuery=TRUE;
	}
}

if ($badQuery) {
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
	<p><span class="sstitre">Supprimer une galerie photo</span></p><br />
	<p>La galerie sélectionnée n'a pas pu être supprimée de la base de données. Veuillez contacter l'administrateur du site.</p><br />
	</div>
	<?php
	print_ligne(12);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
	exit();
}
?>
	
