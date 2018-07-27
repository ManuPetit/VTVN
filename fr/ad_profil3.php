<?php # script : ad_profil3.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Audit des profils.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

date_default_timezone_set("Europe/Paris");

//on va cherché la liste des membres 
$query="SELECT v_MembreID, v_MembrePrenom, v_MembreNom, v_MembreLive, v_MembreActive, v_MembreDernierLogin FROM vsysmembres ORDER BY v_MembreNom ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$mem_id=array();
	$memNom=array();
	$memLive=array();
	$memActive=array();
	$memLogin=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		//on retrouve nos membres
		$mem_id[]=$row['v_MembreID'];
		$memNom[]=substr($row['v_MembrePrenom'],0,1) . '.' . $row['v_MembreNom'];
		if ($row['v_MembreLive'] == '1' ) {
			$memLive[]="Oui";
		} else {
			$memLive[]="Non";
		}
		if ($row['v_MembreActive'] == '0') {
			$memActive[]="Non";
		} elseif ($row['v_MembreActive'] == '1') {
			$memActive[]="En cours";
		} else {
			$memActive[]="Oui";
		}
		if ((trim($row['v_MembreDernierLogin'])) == '') {
			$memLogin[]="Aucun";
		} else {
			$memLogin[]=$row['v_MembreDernierLogin'];
		}		
	}
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
	?><p><span class="sstitre">Modifier un profil</span></p><br />
		<p>Une erreur s'est produite. Si le problème persiste, contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(13);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} // FIN DE "if (@mysql_num_rows($result) >= 1) {


?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='profils';
	$lienactif='profil3';
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Audit des Profils</span></p><br /><br />

<fieldset><legend>L'audit des membres :</legend><br />
<table width="100%" border="0" cellpadding="5">
	<tr>
		<td width="30%" align="left" class="photo"><b>Membres</b></td>
		<td width="15%" align="center" class="photo"><B>Live</B></td>
		<td width="20%" align="center" class="photo"><b>Activé</b></td>
		<td width="35%" align="center" class="photo"><b>Dernier Login</b></td>
	</tr>
	<?php
		$nb=count($mem_id)-1;
		for ($i=0; $i<=$nb; $i++) {
			echo '<tr><td align="left" class="miniphoto">' . $memNom[$i] . '</td>';
			echo '<td align="center" class="miniphoto">' . $memLive[$i] . '</td>';
			echo '<td align="center" class="miniphoto">' . $memActive[$i] . '</td>';
			echo '<td align="center" class="miniphoto">' . $memLogin[$i] . '</td>';
			echo "</tr>\n";
		}
	?>
</table>
</fieldset>

</div>
	
<?php
$u=4-$nb;
if ($u<=0) {
	$u=0;
}
print_ligne($u);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
