<?php # script : ad_profil2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier un profil.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

//on va cherché la liste des membres 
$query="SELECT v_MembreID, v_MembreIdentite FROM vsysmembres ORDER BY v_MembreID ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$mem_id=array();
	$memb=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		//on retrouve nos membres
		$mem_id[]=$row['v_MembreID'];
		$memb[]=$row['v_MembreIdentite'];
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
	$lienactif='profil2';
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Modifier un profil</span></p><br />
<p>Choisissez ci-dessous le profil que vous souhaitez modifier ou supprimer.</p><br />

<fieldset><legend>Modifier un profil de membre :</legend><br />
<table width="100%" border="0" cellpadding="5">
	<tr>
		<td width="50%" align="left" class="photo"><b>Identifiant</b></td>
		<td width="25%"></td>
		<td width="25%"></td>
	</tr>
	<?php
		$nb=count($mem_id)-1;
		for ($i=0; $i<=$nb; $i++) {
			echo '<tr><td class="photo">' . $memb[$i] . '</td>';
			echo '<td class="photo"><a class="event" href="ad_profil_mod.php?memid=' . $mem_id[$i] . '">modifier</a></td>';
			echo '<td class="photo"><a class="event" href="ad_profil_del.php?memid=' . $mem_id[$i] . '">supprimer</a></td>';
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
