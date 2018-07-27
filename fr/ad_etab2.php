<?php # script : ad_etab2.php
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
// on retrouve tous les etablissement
$query="SELECT v_EtabID, v_EtabNom FROM vsyscommerces ORDER BY v_EtabNom ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$etab_id=array();
	$etab_nom=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$etab_id[]=$row['v_EtabID'];
		$etab_nom[]=$row['v_EtabNom'];
	}
} else {
	$badQuery=TRUE;
	$errmsg .= "Il n'y a aucun établissement dans la base de données.\n";
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
	<p><span class="sstitre">Modifier établissement</span></p><br />
		<p>Problemes suivants:<?php echo "\n$errmsg"; ?></p></div>
		
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
		$lienactif='etab2';
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?>
	<p><span class="sstitre">Modifier établissement</span></p><br />
	<p>Choisissez l'établissement que vous souhaiter modifier ou celui que vous souhaitez supprimer.</p><br />
	<fieldset><legend>Modifier un établissement : </legend>
	<br />
	<table width="100%" border="0" cellpadding="5">
		<tr>
			<td width="50%" align="left" class="photo"><b>Etablissements</b></td>
			<td width="25%" align="center"></td>
			<td width="25%" align="center"></td>
		</tr>
		<?php
			$count=count($etab_id)-1;
			for ($i=0; $i<=$count; $i++) {
				echo '<tr><td class="photo">' . $etab_nom [$i] . '</td>';
				echo "\n";
				echo '<td class="photo"><a class="event" href="ad_etab2mod.php?etab=' . $etab_id[$i] . '">Modifier</a></td>';
				echo "\n";
				echo '<td class="photo"><a class="event" href="ad_etab2del.php?etab=' . $etab_id[$i] . '">Supprimer</a></td>';
				echo "</tr>\n";
			}
		?>
	</table>
</fieldset>

</div>
	
<?php
$u=4-$count;
if ($u<=0) {
	$u=0;
}
print_ligne($u);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>

			
