<?php # script : event2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Annuler un &eacute;v&eacute;nement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

$errors = array();
$requete=TRUE;
//on retrouve le ID de l'etablissement
$query="SELECT v_EtabID FROM vsyscommerces WHERE v_MembreID=$u_id";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) == 1) {
	$row=mysql_fetch_array($result,MYSQL_NUM);
	//on retrouve notre dossier
	$etab_id=$row[0];
} else {
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='event';
		$lienactif=NULL;
		include('./includes/membmenu.php'); 
		echo'<div id="mainMemb">';
	?><p><span class="sstitre">Annuler un &eacute;v&eacute;nement</span></p><br />
		<p>Une erreur s'est produite, et vos données ne peuvent pas être rappatriées. Si le problème persiste, contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(13);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
}

// on va maintenant récupérer tous les evenements qui sont dans le futur et toujours actif pour ce membre
$query="SELECT v_EventID, v_Eventnom, v_EventDate FROM vsysevents WHERE v_EventDate > NOW() AND v_EventActif=1 AND v_EtabID=$etab_id ORDER by v_EventDate ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$ev_id=array();
	$ev_nom=array();
	$ev_date=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {//on proccess le resultat
		$ev_id[]=$row['v_EventID'];
		$ev_nom[]=stripslashes($row['v_Eventnom']);
		$ev_date[]=$row['v_EventDate'];
	}
} else {
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='event';
		$lienactif=NULL;
		include('./includes/membmenu.php'); 
		echo'<div id="mainMemb">';
	?><p><span class="sstitre">Annuler un &eacute;v&eacute;nement</span></p><br />
		<p>Il n'y a aucun événement enregistré dans la base de données vous concernant.</p></div>
		
	<?php
		print_ligne(13);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
}


?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='event';
	$lienactif='event3';
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Annuler un &eacute;v&eacute;nement</span></p><br />
<p>Selectionnez dans la liste ci-dessous, l'événement que vous souhaitez annuler, en cliquant son nom :</p><p><br  /></p>

<table border="0" cellpadding="2" width="100%">
	<tr>
		<td width="52%" align="left"><b>Nom</b></td>
		<td width="48%" align="left"><b>Date</b></td>
	</tr>
	<?php
		//on compte les evenements
		$nbr_ev=count($ev_id)-1;
		for ($i=0; $i<=$nbr_ev; $i++) {//on passe en revue chaque evenement
			echo '<tr><td align="left" class="photo"><a class="event" href="eventdel.php?eveid=' . $ev_id[$i] . '">';
			echo $ev_nom[$i] . '</a></td><td align="left" class="photo">';
			echo my_date_handler($ev_date[$i],0);
			echo '</td></tr>';
		}
	?>
</table>

</div>

<?php
$nbrei=8-$nbr_ev;
if ($nbrei <=0) {
	$nbrei=0;
}
print_ligne($nbrei);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>