<?php # script : ad_photo2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier une galerie photo.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$query="SELECT v_GroupeID, v_GroupeNom FROM vsysphotogroupes ORDER BY v_GroupeNom";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$grp_id=array();
	$grp_nom=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$grp_id[]=$row['v_GroupeID'];
		$grp_nom[]=stripslashes($row['v_GroupeNom']);
	}
} else {
	?>
		<div id="longHaut">
		<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='photo';
		$lienactif='photo1';
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?>
	
	<p><span class="sstitre">Modifier une galerie photo</span></p><br />
	<p>Il n'y a aucune galerie photo à modifier.</p></div>
	<?php
	print_ligne(14);
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
	$header='photo';
	$lienactif='photo2';
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Modifier une galerie photo</span></p><br />
<p>Choisissez la galerie photo que vous souhaitez modifier ou supprimer.</p><p><br /></p>
<fieldset><legend>Galeries photo : </legend>
<?php
	echo '<table width="100%" border="0" cellpadding="5">';
	echo "\n";
	echo '<tr><td class="photo" width="60%" align="left"><b>Galerie</b></td>';
	echo "\n";
	echo '<tr width="20%" align="center"></td><tr width="20%" align="center"></td>';
	echo "\n";
	$count=count($grp_id)-1;
	for ($i=0; $i<=$count; $i++) {
		echo "<tr>\n";
		echo '<td class="photo">' . $grp_nom[$i] . '</td>';
		echo "\n";
		echo '<td class="photo"><a class="event" href="ad_photo2mod.php?picid=' . $grp_id[$i] . '">Modifier</a></td>';
		echo "\n";
		echo '<td class="photo"><a class="event" href="ad_photo2del.php?picid=' . $grp_id[$i] . '">Supprimer</a></td>';
		echo "\n";
		echo "</tr>\n";
	}
	echo "</table>\n</fieldset>\n</div>\n";
	$nb=6-$count;
	if ($nb <= 0) {
		$nb=0;
	}
	print_ligne($nb);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
?>