<?php # script : ad_event2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier un événement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

date_default_timezone_set("Europe/Paris");
$aujourdhui=getdate();

//retrouver les établissements
$query="SELECT v_EtabID, v_EtabNom FROM vsyscommerces ORDER BY v_EtabNom";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

$etab_id=array();
$etab_nom=array();
//on crée un faux etablissement pour les evenements généraux
$etab_id[]=0;
$etab_nom[]='V.T.V.N.';
//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$etab_id[]=$row['v_EtabID'];
		$etab_nom[]=$row['v_EtabNom'];
	}
}  // fin de "if (@mysql_num_rows($result) >= 1) 

?>
	<div id="longHaut">
	  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
	</div>
	<div id="longMilieu">
<?php	
	$header='event';
	$lienactif='event2';
	include('./includes/admin.php'); 
	echo'<div id="mainMemb">';
?>
	<p><span class="sstitre">Modifier un événement</span></p><br />
	<p>Modifier ou supprimer des événements.</p><p><br /></p>
	
<?php
	
	// on va passer en revue les $etab_id pour retrouver les infos à display
	$count=count($etab_id)-1;
	$today=mktime(0,0,0,$aujourdhui['mon'],$aujourdhui['mday'],$aujourdhui['year']);
	$cejour=date('Y-m-d 0:00:01',$today);
	$nbligne=0;
	for ($i=0; $i<=$count; $i++) {
		$query="SELECT v_EventID, v_EventDate, v_EventNom FROM vsysevents WHERE v_EtabID={$etab_id[$i]} AND v_EventDate >= '$cejour' ORDER BY v_EventDate ASC";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		//verifier que l'on a un resultat
		if (@mysql_num_rows($result) >= 1) {
			echo '<fieldset><legend>Evénéments proposés par &quot;'. $etab_nom[$i] .'&quot; :</legend>';
			$nbligne++;
			$nbligne++;
			echo "\n<br />\n";
			echo '<table width="100%" border="0" cellpadding="5"><tr><td width="35%" class="photo" align="left"><b>Evénément</b></td><td width="25%" class="photo" align="left"><b>Date</b></td>';
			echo "\n";
			echo '<td width="20%" align="center"></td><td width="20%" align="center"></td>';
			echo "</tr>\n";
			while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
				$nbligne++;
				$ladate=date("d/m/Y", strtotime($row['v_EventDate']));
				echo "<tr>\n";
				echo '<td width="35%" class="photo">' . $row['v_EventNom'] . '</td><td class="photo" width="25%">' . $ladate . '</td>';
				echo "\n";
				echo '<td width="20%" align="center" class="photo"><a class="event" href="ad_event2mod.php?eventid=' . $row['v_EventID'] . '">Modifier</a></td>';
				echo "\n";
				echo '<td width="20%" align="center" class="photo"><a class="event" href="ad_event2del.php?eventid=' . $row['v_EventID'] . '">Supprimer</a></td>';
				echo "\n</tr>\n";
			}
			$nbligne++;
			echo "</table>\n</fieldset>\n<br />";
			
		}	
	}			
	?>
	<table width="100%" border="0" cellpadding="5">
		<tr><td width="100%" align="center"><button type="button" onclick="self.location.href='del_past_event.php'">Supprimer tous les événements passés de la base de données</button></td></tr></table>
		
	</div>
<?php
	$nb=6-$nbligne;
	if ($nb <=0) {
		$nb=0;
	}
	print_ligne($nb);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
?>