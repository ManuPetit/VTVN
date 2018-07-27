<?php # script : ad_profil_del.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Supprimer un profil.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

if ((isset($_GET['memid'])) && (is_numeric($_GET['memid']))) {//on verifie que l'on a bien une id et qu'elle est numeric
	$mem_id=$_GET['memid'];
	
	//requete
	$query="DELETE FROM vsysmembres WHERE v_MembreID=$mem_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='profils';
		$lienactif=NULL;
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?><p><span class="sstitre">Supprimer un profil</span></p><br />
		<p>Le membre a été supprimer de la base de donnée avec succès.</p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
	
} else {
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='profils';
		$lienactif=NULL;
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?>
	<p><span class="sstitre">Supprimer un profil</span></p><br />
		<p>Le membre n'a pas été supprimer de la base de donnée. Une erreur s'étant produite, veuillez contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
}

		
