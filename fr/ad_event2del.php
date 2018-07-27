<?php # script : ad_event2del.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Supprimer un événement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');



$badQuery=FALSE;
if ((isset($_GET['eventid'])) && (is_numeric($_GET['eventid']))) {
	$event_id=$_GET['eventid'];
} else {
	$badQuery=TRUE;
}

if (!$badQuery) {
	$query="DELETE FROM vsysevents WHERE v_EventID=$event_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	if ($result) {
		?>
			<div id="longHaut">
			  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
			</div>
			<div id="longMilieu">
		<?php	
			$header='event';
			$lienactif=NULL;
			include('./includes/admin.php'); 
			echo'<div id="mainMemb">';
		?>
		<p><span class="sstitre">Supprimer un événement</span></p><br />
		<p>L'événement sélectionné a été supprimé de la base de données.</p><br />
		</div>
		<?php
		print_ligne(12);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
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
		$header='event';
		$lienactif=NULL;
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?>
	<p><span class="sstitre">Supprimer un événement</span></p><br />
	<p>L'événement sélectionné n'a pas pu être supprimé de la base de données. Veuillez contacter l'administrateur du site.</p><br />
	</div>
	<?php
	print_ligne(12);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
	exit();
}
?>