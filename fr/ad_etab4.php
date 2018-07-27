<?php # script : ad_etab4.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier une catégorie.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

//on retrouve les catégories existantes
$query="SELECT v_ComTypeID, v_ComNom FROM vsyscommercetype ORDER BY v_ComNom ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$categ=array();
	$cat_id=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$cat_id[]=$row['v_ComTypeID'];
		$categ[]=$row['v_ComNom'];
	}
} else {
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

		<p><span class="sstitre">Modifier une catégorie</span></p><br />
		<p>Le système n'a pas été en mesure de retrouver les catégories d'établissements.</p></div>
	<?php
		print_ligne(12);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //FIN de "if (@mysql_num_rows($result) >= 1) {

?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='etab';
	$lienactif='etab4';
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Modifier une catégorie</span></p><br />
<p>Choisissez ci-dessous la catégorie que vous souhaitez modifier ou supprimer.</p><br  />

<fieldset><legend>Modifier une catégorie :</legend><br  />
<table width="100%" border="0" cellpadding="5">
	<tr>
		<td width="50%" align="left" class="photo">
	<?php
	$count=count($cat_id)-1;
	if ($count>0) {
		echo "<b>Catégories</b></td>\n";
	} else {
		echo "<b>Catégorie</b></td>\n";
	}
	echo '<td width="25%"></td><td width="25%"></td>';
	echo "</tr>\n";
	for ($i=0; $i<=$count; $i++) {
		echo "<tr>\n";
		echo '<td class="photo" width="50%" align="left">';
		echo $categ[$i] . "</td>\n";
		echo '<td class="photo"><a class="event" href="ad_etab3_mod.php?catid=' . $cat_id[$i] . '">Modifier</a>';
		echo "</td>\n";
		echo '<td class="photo"><a class="event" href="ad_etab3_del.php?catid=' . $cat_id[$i] . '">Supprimer</a>';
		echo "</td></tr>\n";
	}
	$ligne=2-$count;
	if ($ligne<=0) {
		$ligne=0;
	}
	?>
</table>
</fieldset>
</div>

<?php
print_ligne($ligne);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
