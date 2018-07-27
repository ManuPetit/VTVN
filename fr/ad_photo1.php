<?php # script : ad_photo1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Créer une galerie photo.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$err=FALSE;
$erru=FALSE;
if (isset($_POST['soumis'])) {
	
	if (isset($_POST['lnom'])) {//verification du nom
		if (trim($_POST['lnom'])!='') {//on a un nom
			$nom=escape_data(htmlentities(trim($_POST['lnom'])));//on transforme le nom pour enlever les risques de hacking
		} else {
			$err=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de nommer votre galerie.</font></p>';
		}
	} else {
		$err=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de nommer votre galerie.</font></p>';
	}
	
	if (isset($_POST['lnomuk'])) {//verification du nom
		if (trim($_POST['lnomuk'])!='') {//on a un nom
			$nomuk=escape_data(htmlentities(trim($_POST['lnomuk'])));//on transforme le nom pour enlever les risques de hacking
		} else {
			$erru=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de nommer votre galerie en Anglais.</font></p>';
		}
	} else {
		$erru=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de nommer votre galerie en Anglais.</font></p>';
	}
	
	if (empty($errors)) {//pas d'erreur
		$public=$_POST['lpublic'];
		$actif=$_POST['lactif'];
		$query = "INSERT INTO vsysphotogroupes ( v_GroupeNom, v_GroupePublic, v_GroupeActif, v_GroupeNomUK) VALUES( '$nom', $public, $actif, '$nomuk')";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		if (mysql_affected_rows() == 1) {// on a un resultat
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
			
			<p><span class="sstitre">Créer une galerie photo</span></p><br />
			<p>La galerie a été créée avec succès.</p>
			</div>
			<?php
			print_ligne(14);
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
			
			<p><span class="sstitre">Créer une galerie photo</span></p><br />
			<p>La galerie n'a pas pu être créée dans la base de données. Veuillez contacter l'adminstrateur du site.</p>
			</div>
			<?php
			print_ligne(14);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
		} 
	
	}// fin de "	if (empty($errors)) {	
			
} // fin de "if (isset($_POST['soumis'])) {
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

<p><span class="sstitre">Créer une galerie photo</span></p><br />
<p>Entrer les details de la galerie à créer.</p><p><br /></p>
<?php
//on imprime les erreurs
if (!empty($errors)) {
	report_erreurs($errors);
}
?>
<fieldset><legend>Galerie photo : </legend>
<br />
<table width="100%" border="0" cellpadding="5">
<form action="ad_photo1.php" method="post">
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
		} else {
			echo '<option value="0">Galerie non activée</option>';
			echo "\n";
			echo '<option value="1" selected="selected">Galerie active</option>';
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
		} else {
			echo '<option value="0" selected="selected">Réservée aux membres de VTVN</option>';
			echo "\n";
			echo '<option value="1">Ouverte au public</option>';
			echo "\n";
		}
		echo "</select>\n</td>\n</tr>\n";			
	?>
	<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Créer la galerie" /></td></tr>
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
		