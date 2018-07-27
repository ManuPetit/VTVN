<?php # script : ad_etab1c.php
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
//on récupère le numéro d'établissement
if ((isset($_GET['etab'])) && (is_numeric($_GET['etab']))) {
	$etab_id=$_GET['etab'];
} elseif ((isset($_POST['etab'])) && (is_numeric($_POST['etab']))) {
	$etab_id=$_POST['etab'];
} else {
	$badQuery=TRUE;
	$errmsg .= "Page accédée par erreur.\n";
}

if (isset($etab_id)) {
	//on retrouve le nom de l'établissement
	$query="SELECT v_EtabNom, v_EtabFileNom FROM vsyscommerces WHERE v_EtabID=$etab_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_NUM);
		$etab_nom=$row[0];
		$dossier=$row[1];
	} else {
		$badQuery=TRUE;
		$errmsg .= "Impossible de retrouver le nom de l'etablissement.\n";
	}
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
	<p><span class="sstitre">Créer un établissement</span></p><br />
		<p>Il est impossible au systeme de récuperer les détails pour créer un nouvel établissement. Veuillez contacter l'administrateur du site.</p><p>Problemes suivants:<?php echo "\n$errmsg"; ?></p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //  FIN DE "if ($badQuery) {

$max_no_img=4;//nbre maxi d'upload

if (isset($_POST['submitted'])) {//la forme a été submitted
	//le dossier du système
	echo '<p>Téléchargement en cours. Veuillez patienter...</p><p><br /></p>';
	$content_dir = '../images/' . $dossier . '/';
	//array contenant les fichiers permits
	$permit=array('image/gif', 'image/jpg', 'image/jpeg', 'image/pjpeg');
	$uploadingok=TRUE;
	// start for loop
	for($x=0;$x<sizeof($_FILES['images']['name']);$x++){
		// Si l'input est vide, on passe
      	if(isset($_FILES['images']['name'][$x])) {//continue;			
			if (in_array($_FILES['images']['type'][$x],$permit)) {//fichier est valide
				if ($_FILES['images']['size'][$x] < 256000) {//verifier la taille du fichier
					$tmp_file = $_FILES['images']['tmp_name'][$x];
					$name_file = $_FILES['images']['name'][$x];
					if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\ ]#', $name_file) ) {
						$errors[]='<p><font color="red"> - Nom de fichier invalide. Vérifier le fichier.</font></p>';
						$uploadingok=FALSE;
					} elseif( move_uploaded_file($tmp_file, $content_dir . $name_file)) {
						//ici on verifie la taille du fichier et on le réduit si c'est necessaire
						$full_file=$content_dir . $name_file;
						$size=getimagesize($full_file);
						if (($size[0] > 400) || ($size[1] > 400)) {//le fichier fait plus de 400 x 400 on resize
							$new=resize_jpg($name_file,$_FILES['images']['type'][$x], $content_dir);
						}
						//ici on renomme le nom du fichier
						$new_name=make_password(12-$x); //on utilise la fonction password pour créer un nom aléatoire de 12 lettres
						//on retrouve le type de fichier
						switch ($_FILES['images']['type'][$x]) {
							case 'image/gif':
								$new_file=$new_name . '.gif';
								break;
							case 'image/jpeg':
								$new_file=$new_name . '.jpeg';
								break;
							case 'image/pjpeg':
								$new_file=$new_name . '.pjpeg';
								break;
							default:
								$new_file=$new_name . '.jpg';
								break;
						}
						//ici on rename le fichier
						$newfichier=$content_dir . $new_file;
						rename($full_file,$newfichier);
						if ((substr($name_file,-4,4))=='.gif') {
							$new_am_name=str_replace('.gif','',$name_file);
						} elseif ((substr($name_file,-4,4))=='.jpg') {
							$new_am_name=str_replace('.jpg','',$name_file);
						} elseif ((substr($name_file,-5,5))=='.jpeg') {
							$new_am_name=str_replace('.jpeg','',$name_file);
						} elseif ((substr($name_file,-6,6))=='.pjpeg') {
							$new_am_name=str_replace('.pjpeg','',$name_file);
						} else {
							$new_am_name=$name_file;
						}
						$final_name=substr($new_am_name,0,12);
						//ici on ajoute le fichier dans la base de données
						$query="INSERT INTO vsyscompict (v_EtabID, v_PictNom, v_PictNomShow) VALUES ($etab_id, '$new_file', '$final_name')";
						$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
						if (mysql_affected_rows() != 1) {//on a eu un problème
							$uploadingok=FALSE;
							$errors[]='<p><font color="red"> - Le fichier ' . $name_file . ' n\'a pas pu être sauvegardé dans la base données.</font></p>';
						}
					} else {			
						//message d'erreur
						switch ($_FILES['upload']['error'][$x]) {
							case 1:
								$uploadingok=FALSE;
								$errors[]='<p><font color="red"> - Le fichier ' . $name_file . ' dépasse la taille du upload_max_filesize de php.ini.</font></p>';
								break;
							case 2:
								$uploadingok=FALSE;
								$errors[]='<p><font color="red"> - Le fichier ' . $name_file . ' dépasse la taille de 512Ko.</font></p>';
								break;
							case 3:
								$uploadingok=FALSE;
								$errors[]='<p><font color="red"> - Le fichier ' . $name_file . ' n\'a été que partiellement téléchargé.</font></p>';
								break;
							case 4:
								$uploadingok=FALSE;
								$errors[]='<p><font color="red"> - Aucun fichier n\a été téléchargé.</font></p>';
								break;
							case 6:
								$uploadingok=FALSE;
								$errors[]='<p><font color="red"> - Il n\'y a pas de fichier temporaire sur le système. Erreur de téléchargement</font></p>';
								break;
							default:
								$uploadingok=FALSE;
								$errors[]='<p><font color="red"> - Erreur v020. Veuillez contacter votre administrateur..</font></p>';
								break;
						} //fin de switch
					}// FIN de "if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
				} else {
					$uploadingok=FALSE;
					$errors[]='<p><font color="red"> - Le fichier ' .  $_FILES['images']['name'][$x] . ' dépasse la taille de 512Ko et n\'a pas été téléchargé.</font></p>';
				} //FIN DE "if ($_FILES['images']['size'][$x] < 512000)
			} // fin de "if (in_array($_FILES['images']['type'][$x],$permit)
			
		}// fin de "if(!$_FILES['images']['name'][$x]) 
		
	} // fin de loop
	
	if ($uploadingok) {//aucune erreur on retourne au fichier de choix des photos
		//creation de l'URL de redirection
		$url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);
		//verifier pour le backslash
		if ((substr($url,-1) == '/') OR (substr($url,-1) == '\\')) {
			//enlever le slash
			$url=substr($url,0,-1);
		}
		//ajoute le nom du fichier
		$url .= '/ad_etab1d.php?etab=' . $etab_id;
		//rediriger
		ob_end_clean();
		header("Location: $url");
		exit();
	} //FIN DE if ($uploadingok)
	
} //fin de "if (isset($_POST['submitted']))
?>
<div id="longHaut">
	  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
	</div>
	<div id="longMilieu">
<?php	
	$header='etab';
	$lienactif='etab1';
	include('./includes/admin.php'); 
	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Photos pour "<?php echo $etab_nom; ?>"</span></p><br />
<p>Télécharger les photos pour "<?php echo $etab_nom; ?>".<br /><br /><font color="red"><b>Attention :</b></font><br /> - la taille maximale de chaque fichier à télécharger est de <font color="red">256Ko</font>.<br  /> - si la largeur ou la hauteur de vos images sont supérieures à <font color="red">400 pixels</font>, votre image sera automatiquement réduite par le serveur.<br  /> - le nom de fichier à télécharger ne peut pas contenir d'<font color="red">espace</font>. Changez son nom avant le téléchargement.<br  /> - N'appuyez qu'<font color="red">une seule fois</font> sur le bouton "Ajouter les images". Le temps de téléchargement dépend de la taille de vos photos et de votre vitesse de connexion.<br /><br />Lorsque le téléchargement de vos images sera terminé, la page de choix de vos photographies sera affichée sur votre écran.</p>
<br />
<?php
//on imprime les erreurs
if (!empty($errors)) {
	report_erreurs($errors);
}
?>

<fieldset><legend>Vos photos à télécharger : </legend><br />
<form enctype="multipart/form-data" method="post" action="ad_etab1c.php">
	<table border="0" cellpadding="5" width="100%">
		<?php
			for($i=1; $i<=$max_no_img; $i++){
				echo "<tr><td width=\"20%\">Image $i</td><td width=\"80%\">
				<input type=\"file\" name=\"images[]\" size=\"35\"></td></tr>";
			}
		?>
		<tr><td colspan=2 align=center><input type="submit" name="submit" value="Ajouter les images" /></td></tr>
		<input type="hidden" name="submitted" value="TRUE" />
		<input type="hidden" name="etab" value="<?php echo $etab_id; ?>" />
		<input type="hidden" name="MAX_FILE_SIZE" value="256" />
	</table>
</form>
</fieldset>
</div>
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>