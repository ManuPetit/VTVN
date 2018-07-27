<?php # script : ad_photo2mod.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier une galerie photo.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$err=FALSE;
$erru=FALSE;
$badQuery=FALSE;
if ((isset($_GET['picid'])) && (is_numeric($_GET['picid']))) {
	$pic_id=$_GET['picid'];
} elseif ((isset($_POST['picid'])) && (is_numeric($_POST['picid']))) {
	$pic_id=$_POST['picid'];
} else {
	$badQuery=TRUE;
}

if (!$badQuery) {//on a une id
	$query="SELECT v_GroupeNom, v_GroupePublic, v_GroupeActif, v_GroupeNomUK FROM vsysphotogroupes WHERE v_GroupeID=$pic_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_ASSOC);
		$v_GroupeNom=stripslashes($row['v_GroupeNom']);
		$v_GroupePublic=$row['v_GroupePublic'];
		$v_GroupeActif=$row['v_GroupeActif'];
		$v_GroupeNomUK=stripslashes($row['v_GroupeNomUK']);
	} else {
		$badQuery=TRUE;
	}
}

if ($badQuery) {
	?>
		<div id="longHaut">
		<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='photo';
		$lienactif=NULL;
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?>
	<p><span class="sstitre">Modifier une galerie</span></p><br />
		<p>Il est impossible au systeme de récuperer les détails de la galerie à modifier. Veuillez contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(12);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //  FIN DE "if ($badQuery) {

if (isset($_POST['soumis'])) {
	
	$dbcol=FALSE;
	
	if (isset($_POST['lnom'])) {//verification du nom
		if (trim($_POST['lnom'])!='') {//on a un nom
			$nom=escape_data(htmlentities(trim($_POST['lnom'])));//on transforme le nom pour enlever les risques de hacking
			if ($nom != $v_GroupeNom) {
				$dbcol .= " v_GroupeNom='$nom',";
			}
		} else {
			$err=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de nommer votre galerie.</font></p>';
		}
	} else {
		$err=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de nommer votre galerie.</font></p>';
	}

	
	$public=$_POST['lpublic'];
	if ($public != $v_GroupePublic) {
		$dbcol .= " v_GroupePublic=$public,";
	}
	$actif=$_POST['lactif'];
	if ($actif != $v_GroupeActif) {
		$dbcol .= " v_GroupeActif=$actif,";
	}
		
	if (isset($_POST['lnomuk'])) {//verification du nom
		if (trim($_POST['lnomuk'])!='') {//on a un nom
			$nomuk=escape_data(htmlentities(trim($_POST['lnomuk'])));//on transforme le nom pour enlever les risques de hacking
			if ($nomuk != $v_GroupeNomUK) {
				$dbcol .= " v_GroupeNomUK='$nomuk',";
			}
		} else {
			$erru=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de nommer votre galerie en Anglais.</font></p>';
		}
	} else {
		$erru=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de nommer votre galerie en Anglais.</font></p>';
	}
	
	if (empty($errors)) {//pas d'erreur
		
		if ($dbcol) {// on a des changement
			$long=strlen($dbcol);
			$n_dbcol = substr($dbcol,0,$long-1);			
			$query="UPDATE vsysphotogroupes SET $n_dbcol WHERE v_GroupeID=$pic_id";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (!$result) {
				?>
					<div id="longHaut">
					<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
					</div>
					<div id="longMilieu">
				<?php	
					$header='photo';
					$lienactif=NULL;
					include('./includes/admin.php'); 
					echo'<div id="mainMemb">';
				?>
				<p><span class="sstitre">Modifier une galerie</span></p><br />	
				<p>Les données n'ont pas pu être modifiées. Veuillez contacter l'administrateur du serveur.</p>
				</div>
				<?php
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
					$header='photo';
					$lienactif=NULL;
					include('./includes/admin.php'); 
					echo'<div id="mainMemb">';
				?>
				<p><span class="sstitre">Modifier une galerie</span></p><br />	
				<p>Les modifications ont été enregistrées dans la base de données. </p>
				</div>
				<?php
					print_ligne(12);
					$menu_choix =NULL;
					include ('./includes/footerUnCol.php');
					exit();
			}// fin de "if (!$result) {
			
		} else { //aucun changement
			?>
				<div id="longHaut">
				<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
				</div>
				<div id="longMilieu">
			<?php	
				$header='photo';
				$lienactif=NULL;
				include('./includes/admin.php'); 
				echo'<div id="mainMemb">';
			?>
			<p><span class="sstitre">Modifier une galerie</span></p><br />	
			<p>Aucun changement n'a été enregistré dans la base de données. </p>
			</div>
			<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		}
			
	}//if (empty($errors)) 
} // fin de "if (isset($_POST['soumis'])) {


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
<p><span class="sstitre">Modifier une galerie</span></p><br />
<p>Modifier les details de la galerie</p><p><br /></p>
<fieldset><legend>Détails de la galerie : </legend>
<table width="100%" border="0" cellpadding="5">
<form action="ad_photo2mod.php" method="post">
<input type="hidden" name="picid" value="<?php echo $pic_id; ?>" />
	<?php
	
		//nom de la galerie
		echo '<tr><td width="40%" class="photo" align="left">';
		if ($err) {
			echo '<font color="red">Nom :</font>';
		} else {
			echo 'Nom :';
		}
		echo "</td>\n";
		echo '<td width="60%" align="left"><input name="lnom" type="text" size="35" maxlength ="35" value="';
		if (isset($_POST['lnom'])) {
			echo $_POST['lnom'];
		} else {
			echo $v_GroupeNom;
		}
		echo "\" /></td>\n</tr>\n";
		
		echo '<tr><td width="40%" class="photo" align="left">';
		if ($erru) {
			echo '<font color="red">Nom Anglais:</font>';
		} else {
			echo 'Nom Anglais:';
		}
		echo "</td>\n";
		echo '<td width="60%" align="left"><input name="lnomuk" type="text" size="35" maxlength ="35" value="';
		if (isset($_POST['lnomuk'])) {
			echo $_POST['lnomuk'];
		} else {
			echo $v_GroupeNomUK;
		}
		echo "\" /></td>\n</tr>\n";
		
		echo '<tr><td class="photo">Galerie active :</td>';
		echo "\n";
		echo '<td><select name="lactif">';
		if (isset($_POST['lactif'])) {
			if ($_POST['lactif'] == 0) {
				echo '<option value="0" selected="selected">Galerie non activée</option>';
				echo "\n";
				echo '<option value="1">Galerie active</option>';
				echo "\n";
			} else {
				echo '<option value="0">Galerie non activée</option>';
				echo "\n";
				echo '<option value="1" selected="selected">Galerie active</option>';
				echo "\n";
			}
		} elseif ($v_GroupeActif == 1) {
			echo '<option value="0">Galerie non activée</option>';
			echo "\n";
			echo '<option value="1" selected="selected">Galerie active</option>';
			echo "\n";
		} else {
			echo '<option value="0" selected="selected">Galerie non activée</option>';
			echo "\n";
			echo '<option value="1">Galerie active</option>';
			echo "\n";
		} 
		echo "</select>\n</td>\n</tr>\n";
		
		echo '<tr><td class="photo">Galerie publique :</td>';
		echo "\n";
		echo '<td><select name="lpublic">';
		if (isset($_POST['lpublic'])) {
			if ($_POST['lpublic'] == 0) {
				echo '<option value="0" selected="selected">Réservée aux membres de VTVN</option>';
				echo "\n";
				echo '<option value="1">Ouverte au public</option>';
				echo "\n";
			} else {
				echo '<option value="0">Réservée aux membres de VTVN</option>';
				echo "\n";
				echo '<option value="1" selected="selected">Ouverte au public</option>';
				echo "\n";
			}
		} elseif ($v_GroupePublic == 0) {
			echo '<option value="0" selected="selected">Réservée aux membres de VTVN</option>';
			echo "\n";
			echo '<option value="1">Ouverte au public</option>';
			echo "\n";
		} else {
			echo '<option value="0">Réservée aux membres de VTVN</option>';
			echo "\n";
			echo '<option value="1" selected="selected">Ouverte au public</option>';
			echo "\n";
		}
		echo "</select>\n</td>\n</tr>\n";			
	?>
	<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Modifier les détails la galerie" /></td></tr>
	<input type="hidden" name="soumis" value="TRUE" />
</form>
</table>
</fieldset>
</div>
<?php
print_ligne(2);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>