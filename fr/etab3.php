<?php # script : etab3.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Changer mes photos.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

$requete=TRUE;
$errors=array();
//on recherche les images dans le fichiers de l'user
$query="SELECT v_EtabID, v_EtabFileNom FROM vsyscommerces WHERE v_MembreID=$u_id";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) == 1) {
	$row=mysql_fetch_array($result,MYSQL_NUM);
	//on retrouve notre dossier
	$etab_id=$row[0];
	$dossier=$row[1];
	
	//mettre les photos en vide
	$photos[0]='';
	$photos[1]='';
	//maintenant on cherche les deux fichiers selectionner comme photo
	$query="SELECT v_DetailType, v_Details FROM vsyscomdetails WHERE v_EtabID=$etab_id AND ((v_DetailType=1) OR (v_DetailType=2)) ORDER BY v_DetailType ASC";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	//verifier que l'on a un resultat
	
	if (@mysql_num_rows($result) >= 1) {
		while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {//on proccess le resultat
			if ($row['v_DetailType'] ==1) {//premiere photo
				$photos[0]=trim($row['v_Details']);
			}elseif ($row['v_DetailType'] ==2) {//premiere photo
				$photos[1]=trim($row['v_Details']);
			} else {
				$requete=FALSE;
				$errors[]='<p><font color="red"> - Erreur v014. Veuillez contacter votre administrateur..</font></p>';
			}
		}//fin de "while ($row=mysql_fetch_array($result,MYSQL_ASSOC))"
	} else {
		$requete=FALSE;
		$errors[]='<p><font color="red"> - Erreur v015. Veuillez contacter votre administrateur..</font></p>';
	}//fin de "if (@mysql_num_rows($result) >= 1)"
} else {
	$requete=FALSE;	
	$errors[]='<p><font color="red"> - Erreur v016. Veuillez contacter votre administrateur..</font></p>';	
}

//maintenant on va recuperer les images dans le dossier du user		
$images=array();
$imgnom=array();
$ufile= "../images/$dossier/";
$query="SELECT v_PictNom, v_PictNomShow FROM vsyscompict WHERE v_EtabID=$etab_id ORDER BY v_PictNomShow ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier le resultat
if (@mysql_num_rows($result) >= 1) {
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {//on proccess le resultat
		$images[]=$row['v_PictNom'];
		$imgnom[]=$row['v_PictNomShow'];
	}
}



if (isset($_POST['submitted'])) {//on a envoyé la forme par submitted
	//on assigne notre variable 
	$nombre=$_POST['checkpic'];
	
	//on compte le nombre de checkbox choisi
	$total=count($nombre);
	
	//mise en place d'un flag
	$photok=TRUE;
	
	//on verifie que l'on a pas plus de 2 photo choisi
	if ($total > 2) {//on ne peut pas avoir plus de deux photos
		$errors[]='<p><font color="red"> - Vous ne pouvez pas choisir plus de deux photographies pour votre page.</font></p>';
	} elseif ($total < 1) {//on a choisi aucune photo soit équivalent du bouton ne pas afficher de photographies
		//creation de l'URL de redirection
		$url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);
		//verifier pour le backslash
		if ((substr($url,-1) == '/') OR (substr($url,-1) == '\\')) {
			//enlever le slash
			$url=substr($url,0,-1);
		}
		//ajoute le nom du fichier
		$url .= '/nopic.php';
		//rediriger
		ob_end_clean();
		header("Location: $url");
		exit();
	} else {//on a soit 1 ou 2 photos choisi et on va les enregistrées dans la base de données
		$newpic=array();
		$newpic[0]='';
		$newpic[1]='';
		for($i=0;$i<$total;$i++) {
			$newpic[$i]=$nombre[$i];
		}
		
		$pics1=FALSE;
		$pics2=FALSE;
		//creation de la requete
		$query="UPDATE vsyscomdetails SET v_Details ='{$newpic[0]}' WHERE v_EtabID=$etab_id AND v_DetailType=1";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		if (mysql_affected_rows() == 1) {// on a un resultat
			$pics1=TRUE;
		} else {				
			$errors[]='<p><font color="red"> - Erreur v017. Veillez contacter votre administrateur.</font></p>';
		}
		
		$query="UPDATE vsyscomdetails SET v_Details ='{$newpic[1]}' WHERE v_EtabID=$etab_id AND v_DetailType=2";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		if (mysql_affected_rows() == 1) {// on a un resultat
			$pics2=TRUE;
		} else {				
			$errors[]='<p><font color="red"> - Erreur v018. Veillez contacter votre administrateur.</font></p>';
		}
		
		//tout a bien marché
		if ($pics1 && $pics2) {
			?>
			<div id="longHaut">
		    <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		    </div>
			<div id="longMilieu">
			<?php
			$header='etab';
			$lienactif=NULL;
			include('./includes/membmenu.php'); 
			echo'<div id="mainMemb">';
			echo '<p><span class="sstitre">Changer mes photos</span></p><br />';
			echo '<p>Vos modifications ont été enregistrées dans la base de données du serveur.</p></div>';
			print_ligne(12);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
		} elseif ($pics1 || $pics2) {
			?>
			<div id="longHaut">
		    <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		    </div>
			<div id="longMilieu">
			<?php
			$header='etab';
			$lienactif=NULL;
			include('./includes/membmenu.php'); 
			echo'<div id="mainMemb">';
			echo '<p><span class="sstitre">Changer mes photos</span></p><br />';
			echo '<p>Une modifications a été enregistrée dans la base de données du serveur.</p></div>';
			print_ligne(12);
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
			$header='etab';
			$lienactif=NULL;
			include('./includes/membmenu.php'); 
			echo'<div id="mainMemb">';
			echo '<p><span class="sstitre">Changer mes photos</span></p><br />';
			echo '<p>Aucune modification n\'a été enregistrée dans la base de données du serveur.</p></div>';
			print_ligne(12);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
		}// fin de "if ($pics1 && $pics2)"
	
	}// fin de "if ($total > 2)"
	
} //fin de "if (isset($_POST['submitted']))"
?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='etab';
	$lienactif='etab3';
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Changer mes photos</span></p><br />
<?php
//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	}
?>
<p>Choisissez les photos que vous souhaitez voir sur la page de votre établissement (2 photos maximum). Vous pouvez également télécharger de nouvelles photos, ou choisir de n'avoir aucune photographies.</p><br  />
<fieldset><legend>Choisissez vos photographies :</legend>
	<br  />
	<form action="etab3.php" method="post">
	<table border="0" cellpadding="5" width="100%">
		<tr>
		<?php //on met en place les images thumbnails
		$counter=0;
		//creation du nombre de photo
		$nbreimg=((count($images))-1);
		for ($i=0; $i<=$nbreimg; $i++) {
			$counter++;
			echo '<td width="33%" align="center" class="miniphoto">';				
			//creation des nom d'images
			$picture = '../images/' . $dossier . '/' . $images[$i];
			//creation du nom de la vignette
			$newvalue= str_replace('.', '_th.', $images[$i]);
			$thumb = '../images/' . $dossier . '/' . $newvalue;
			//on verifie que la vignette n'existe pas
			if (!file_exists($thumb)) {//on la construit
				$thumb = createthumb ($picture, 100, 100);
			}
			if ($la_photo= @getimagesize($thumb)) {
				echo '<img src="' . $thumb . '" alt="' . $imgnom[$i] . '" ' . $la_photo[3] . ' title="' . $imgnom[$i] . '" />';
			}
			if ((strtolower($images[$i]) == strtolower($photos[0])) or (strtolower($images[$i]) == strtolower($photos[1]))) {//l'image match la photo de l'établissement
				echo '<br /><input type="checkbox" name="checkpic[]" value="' . $images[$i] . '" checked="checked" /><font color="blue">' . $imgnom[$i]. '</font></td>';
			} else {
				echo '<br /><input type="checkbox" name="checkpic[]" value="' . $images[$i] . '" />' . $imgnom[$i] . '</td>';
			}
			if ( ($counter / 3) == ((int)($counter / 3))) {	// nouveau row
				echo "</tr><tr>\n";
				$flag=FALSE;
			} else {
				$flag=TRUE;
			}
		}// FIN de "foreach ($images as $value )"
		//on annule le tableu $image
		unset($images);
		if ($flag) {
			echo '</tr>';
		}
		?>
		<tr>
			<td align="center" colspan="3"><input type="submit" name="submit" value="Valider mes choix" /></td>
		</tr>
		<tr>
			<td align="center" colspan="3"><input type="button" name="telecharge" value="Télécharger de nouvelles photos" onclick="self.location.href='telechagepic.php'" /></td>
		</tr>
		<tr>
			<td align="center" colspan="3"><input type="button" name="annule" value="Ne pas afficher de photographies" onclick="self.location.href='nopic.php'" /></td>
		</tr>
	</table>
	<input type="hidden" name="submitted" value="TRUE" />
	</form>
</p>
</div>
	
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>