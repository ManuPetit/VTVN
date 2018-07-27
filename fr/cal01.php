<?php # script : cal01.php
$titre_page='Galerie Photo.';
$image_entete='enteteCalendrier';
$menu_item="calendrier";
include ('includes/headerDeuxColGalerie.php');
//connection to db
require_once('../../vtvn_connection.php');
//inclure les functions de database
require_once('./includes/db.inc.php');
require_once('./includes/config.inc.php');
 
$okay=FALSE;
$errors=array();
//on retrouve les différentes galeries
$query="SELECT v_GroupeID, v_GroupeNom FROM vsysphotogroupes WHERE v_GroupePublic=1 AND v_GroupeActif=1 ORDER BY v_GroupeNom ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$v_GroupeID=array();
	$v_GroupeNom=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$v_GroupeID[]=$row['v_GroupeID'];
		$v_GroupeNom[]=stripslashes($row['v_GroupeNom']);
	}
} else {
	$errors[]="Une erreur s'est produite durant le repatriement des galeries.";
}

if ((isset($_GET['galid'])) && (is_numeric($_GET['galid']))) {//on a une valeur on peut donc afficher
	$gal_id=$_GET['galid'];
	$okay=TRUE;
}

if ($okay) {	
	//creation du menu
	echo '<div id="gauche">
	<div class="petitHaut">Galeries Photos</div>
  <div class="petitMilieu">
    <ul>';
	$count=count($v_GroupeID)-1;
	for ($i=0; $i<=$count; $i++) {
		echo '<li><a ';
		if ($v_GroupeID[$i] == $gal_id) {
			echo 'class="choix">' . $v_GroupeNom[$i];
		} else {
			echo ' href="cal01.php?galid=' . $v_GroupeID[$i] . '">' . $v_GroupeNom[$i];
		}
		echo "</a></li>\n";
	}
	echo ' </ul>
  </div>
  <div class="petitBas"></div>';
	
  echo '<div class="petitHaut">Evénements</div>
  <div class="petitMilieu">
    <ul>
      <li><a href="calendrier.php">Calendrier</a></li>
      <li><a class="choix">Galeries photos</a></li>
    </ul>
  </div>
  <div class="petitBas"></div></div>';
  
  echo '<div id="droite">
  <div class="moyenHaut">';
  
    //galerie egal zero on fait donc voir les possibilités
	if ($gal_id==0) {
		echo '<h2>Galeries photos</h2></div>
  		<div class="moyenMilieu">
    	<p>Bienvenue dans notre galerie de photos.<br />Choisissez dans le menu de gauche la galerie que vous souhaitez visiter.<br /> Une fois la galerie affichée, cliquez sur les vignettes des photos pour les voir en taille réelle.</p>';
		print_ligne(12);
	} else { //on affiche la galerie choisie
		$count=count($v_GroupeID)-1;
		for ($i=0; $i<=$count; $i++) {
			if ($v_GroupeID[$i] == $gal_id) {
				$nomgal=$v_GroupeNom[$i];
			}
		}
		echo '<h2>' . $nomgal . '</h2></div><div class="moyenMilieu">';
		echo '<p>Cliquez sur une photo pour lancer le diaporama.<br /><br />Vous pouvez naviguer dans le diaporama : avec la souris et en cliquant sur Suiv. ou Prec. pour avancer ou reculer, en utilisant les fl&ecirc;ches du clavier, ou en pressant S ou P sur votre clavier.<br /><br />Pour quitter le diaporama vous pouvez : cliquez Fermer, ou appuyez sur la touche "Echap" de votre clavier.</p>';
		//on retrouve la liste des photos qui est dans la db
		$query="SELECT v_FileNom, v_PhotoNom FROM vsysphotos WHERE v_GroupeID=$gal_id AND v_PhotoActif=1 ORDER BY v_FileNom ASC";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		//verifier le resultat
		if (@mysql_num_rows($result) >= 1) {
			$file=array();
			$titre_foto=array();
			while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {//on proccess le resultat
				$file[]=$row['v_FileNom'];
				$titre_foto[]=$row['v_PhotoNom'];
			}
			$nb=count($file)-1;
			$counter=0;
			echo '<table class="descrip" width="90%" border="0" cellpading="5"><tr>';
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
					$size=@getimagesize($thumb);
					$w=($size[0]);
					$h=($size[1]);
					//echo '<a href="#"><img border="0" src="' . $thumb . '" alt="Cliquez moi" ' . $la_photo[3] . ' title="Cliquez moi" onClick="popUpWindow(\'' . $picture . '\',0,0,' . $w . ',' . $h . ')" /></a></td>';
					echo '<a href="' . $picture . '" rel="lightbox[gallerie]" title="' . $titre_foto[$i] . '"><img src="' . $thumb . '" width="' . $w . '" height="' . $h . '" border="0" /></a>
</td>';
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
			$count=-11;
		}
		echo '</table>';
		$nba=8-$count;
		if ($nba <= 0) {
			$nba=0;
		}
		print_ligne($nba);
	} // fin de "if ($gal_id==0) {
	
} // fin de "if ($gal_id) {

echo '</div>';
$menu_choix =NULL;
include ('includes/footerDeuxCol.php');
?>