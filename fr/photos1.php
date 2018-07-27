<?php # script : photos1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//Output buffering
ob_start();
//debut de session
session_start();

include ('./includes/headerconex.php');

if ((isset($_GET['galid'])) && (is_numeric($_GET['galid']))) {//on a une valeur on peut donc afficher
	$gal_id=$_GET['galid'];
} else {
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='photos';
		$lienactif=NULL;
		include('./includes/membmenu.php'); 
		echo'<div id="mainMemb">';
	?>
	
	<p><span class="sstitre">Galerie photo</span></p><br />
	<p>Une erreur s'est produite. Veuillez le signaler à l'administrateur du site ce problème persiste.</p>
	</div>
	<?php
	print_ligne(12);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
	exit();
}

$query="SELECT v_GroupeNom FROM vsysphotogroupes WHERE v_GroupeID=$gal_id";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
//verifier que l'on a un resultat
if (@mysql_num_rows($result) == 1) {
	$row=mysql_fetch_array($result,MYSQL_NUM);
	//on retrouve notre dossier
	$pics=$row[0];
} else {
	?>	
		<p><span class="sstitre">Documents</span></p><br />
		<p>Une erreur s'est produite. Veuillez le signaler à l'administrateur du site ce problème persiste.</p>
		</div>
		<?php
		print_ligne(12);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
}
//mise en place des éléments de la page
$titre_page="Photos : $pics";
$image_entete='enteteMembres';
$menu_item="membres";
$java=TRUE;
include ('./includes/headerUnColv2.php');
?>

	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='photos';
	$lienactif='photos' . $gal_id;
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre"><?php echo $pics; ?></span></p><br />
<p>Cliquez sur l'image de votre choix pour voir apparaître la photo en plus grand</p><p><br  /></p>
<table width="100%" border="0" cellpadding="5">
	<tr>
	<?php
		//on retrouve la liste des photos qui est dans la db
		$query="SELECT v_FileNom, v_PhotoNom FROM vsysphotos WHERE v_GroupeID=$gal_id AND v_PhotoActif=1 ORDER BY v_FileNom ASC";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		//verifier le resultat
		if (@mysql_num_rows($result) >= 1) {
			$file=array();
			$phot_nom=array();
			while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {//on proccess le resultat
				$file[]=$row['v_FileNom'];
				$phot_nom[]=$row['v_PhotoNom'];
			}
			$nb=count($file)-1;
			$counter=0;
			for ($i=0; $i<=$nb;$i++) {
				$counter++;
				echo '<td width="33%" align="center" class="miniphoto">';			
				//creation des nom d'images
				$picture = '../images/photogal/' . $file[$i];
				//creation du nom de la vignette
				$newvalue= str_replace('.', '_th.', $file[$i]);
				$thumb = '../images/photogal/' . $newvalue;
				//on verifie que la vignette n'existe pas
				if (!file_exists($thumb)) {//on la construit
					$thumb = createthumb ($picture, 100, 100);
				}
				if ($la_photo= @getimagesize($thumb)) {
					$size=@getimagesize($picture);
					$w=($size[0]/2)+35;
					$h=($size[1]/2)+35;
					echo '<a href="#"><img border="0" src="' . $thumb . '" alt="' . $phot_nom[$i] . '" ' . $la_photo[3] . ' title="' . $phot_nom[$i] . '" onClick="popUpWindow(\'' . $picture . '\',0,0,' . $w . ',' . $h . ')" /></a><br />' . $phot_nom[$i] . '</td>';
				}
				if ( ($counter / 3) == ((int)($counter / 3))) {	// nouveau row
					echo "</tr><tr>\n";
					$flag=FALSE;
				} else {
					$flag=TRUE;
				}
			}// fin de "for ($i=0; $i<=$nb;$i++) 
			if ($flag) {
				echo '</tr>';
			}
			$count=(int)($counter/3);
		} else {
			echo '<td width="100%" align="center" class="photo">Il n\'y a aucune photo dans cette catégorie.</td></tr>';
			$count=0;
		}
	?>
</table>
</div>
	
<?php
$nba=6-$count;
if ($nba <= 0) {
	$nba=0;
}
print_ligne($nba);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>