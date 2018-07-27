<?php # script : ad_etab1b.php
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
	$query="SELECT v_EtabNom FROM vsyscommerces WHERE v_EtabID=$etab_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_NUM);
		$etab_nom=$row[0];
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

//variables pour les erreur
$errors=array();
$err=array();
for ($i=0; $i<6; $i++) {
	$err[$i]=FALSE;
}

if (isset($_POST['soumis'])) {//la forme est soumise

	if ((trim($_POST['desc1fr'])) != '') {//on a une description
		$des1f=escape_data(htmlentities($_POST['desc1fr']));
	} else {
		$err[0]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une première description française.</font></p>';
	}
	
	if ((trim($_POST['desc1uk'])) != '')  {//on a une description
		$des1u=escape_data(htmlentities($_POST['desc1uk']));
	} else {
		$err[1]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une première description anglaise.</font></p>';
	}

	if ((trim($_POST['desc2fr'])) != '') {//on a une description
		$des2f=escape_data(htmlentities($_POST['desc2fr']));
	} else {
		$err[2]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une deuxième description française.</font></p>';
	}
	
	if ((trim($_POST['desc2uk'])) != '')  {//on a une description
		$des2u=escape_data(htmlentities($_POST['desc2uk']));
	} else {
		$err[3]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une deuxième description anglaise.</font></p>';
	}
	
	if ((trim($_POST['desc3fr'])) != '') {//on a une description
		$des3f=escape_data(htmlentities($_POST['desc3fr']));
	} else {
		$err[4]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une troisième description française.</font></p>';
	}
	
	if ((trim($_POST['desc3uk'])) != '')  {//on a une description
		$des3u=escape_data(htmlentities($_POST['desc3uk']));
	} else {
		$err[5]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une troisième description anglaise.</font></p>';
	}
	
	if (empty($errors)) {//aucune erreur
		$query="INSERT INTO vsyscomdetails ( v_EtabID, v_DetailType, v_Details) VALUES ( $etab_id, 3, '$des1f'), ( $etab_id, 4, '$des2f'), ( $etab_id, 5, '$des3f'), ( $etab_id, 6, '$des1u'), ( $etab_id, 7, '$des2u'), ( $etab_id, 8, '$des3u')";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		//verifier que l'on a un resultat
		if (@mysql_affected_rows() >= 1) {
			//donc on va maintenant entrer les photos sur une autre page
			//creation de l'URL de redirection
			$url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);
			//verifier pour le backslash
			if ((substr($url,-1) == '/') OR (substr($url,-1) == '\\')) {
				//enlever le slash
				$url=substr($url,0,-1);
			}
			//ajoute le nom du fichier
			$url .= "/ad_etab1c.php?etab=$etab_id";
			//rediriger
			ob_end_clean();
			header("Location: $url");
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
				include('./includes/admin.php'); 
				echo'<div id="mainMemb">';
			?>
			<p><span class="sstitre">Descriptions de "<?php echo $etab_nom; ?>"</span></p><br />
			<p>Les descriptions n'ont pas pu être enregistrées dans la base de données du serveur.</p><br />
			</div>
			<?php
			print_ligne(12);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();		
		} // fin de "if (@mysql_affected_rows() >= 1)
		
	}//fin de "if (empty($errors)) 
	
}// FIN DE "if (isset($_POST['soumis'])) {

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
<p><span class="sstitre">Descriptions de "<?php echo $etab_nom; ?>"</span></p><br />
<p>Entrer les descriptions françaises et anglaises de l'établissement "<?php echo $etab_nom; ?>".</p><br />
<?php
//on imprime les erreurs
if (!empty($errors)) {
	report_erreurs($errors);
}
//on prepare la forme
echo '<form action="ad_etab1b.php" method="post"><fieldset><legend>Première description :</legend><br />';
echo "\n<p>";
if ($err[0]) {
	echo '<font color="red">Français :</font>';
} else {
	echo 'Français :';
}
echo '</p><textarea name="desc1fr" cols="55" rows="4">';
if (isset($_POST['desc1fr'])) {
	echo stripslashes($_POST['desc1fr']);
}
echo "</textarea>\n<p><br /></p><p>";
if ($err[1]) {
	echo '<font color="red">Anglais :</font>';
} else {
	echo 'Anglais :';
}
echo '</p><textarea name="desc1uk" cols="55" rows="4">';
if (isset($_POST['desc1uk'])) {
	echo stripslashes($_POST['desc1uk']);
}
echo "</textarea>\n</fieldset><p><br /></p>\n";

//deuxième description
echo '<fieldset><legend>Deuxième description :</legend><br />';
echo "\n<p>";
if ($err[2]) {
	echo '<font color="red">Français :</font>';
} else {
	echo 'Français :';
}
echo '</p><textarea name="desc2fr" cols="55" rows="4">';
if (isset($_POST['desc2fr'])) {
	echo stripslashes($_POST['desc2fr']);
}
echo "</textarea>\n<p><br /></p><p>";
if ($err[3]) {
	echo '<font color="red">Anglais :</font>';
} else {
	echo 'Anglais :';
}
echo '</p><textarea name="desc2uk" cols="55" rows="4">';
if (isset($_POST['desc2uk'])) {
	echo stripslashes($_POST['desc2uk']);
}
echo "</textarea>\n</fieldset><p><br /></p>\n";

//Troisième description
echo '<fieldset><legend>Troisième description :</legend><br />';
echo "\n<p>";
if ($err[4]) {
	echo '<font color="red">Français :</font>';
} else {
	echo 'Français :';
}
echo '</p><textarea name="desc3fr" cols="55" rows="4">';
if (isset($_POST['desc3fr'])) {
	echo stripslashes($_POST['desc3fr']);
}
echo "</textarea>\n<p><br /></p><p>";
if ($err[5]) {
	echo '<font color="red">Anglais :</font>';
} else {
	echo 'Anglais :';
}
echo '</p><textarea name="desc3uk" cols="55" rows="4">';
if (isset($_POST['desc3uk'])) {
	echo stripslashes($_POST['desc3uk']);
}
echo "</textarea>\n</fieldset>\n";
echo '<table width="100%"><tr><td width="100%" align="center"><input type="submit" name="submit" value="Créer les descriptions pour ' . $etab_nom . '" /></td></tr></table>';
echo "\n";
echo '<input type="hidden" name="soumis" value="TRUE" />';
echo "\n";
echo '<input type="hidden" name="etab" value="' . $etab_id . '" />';
echo "\n</form>\n</div>";

print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
