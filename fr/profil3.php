<?php # script : profil3.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Changer mon image.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

$errors=array();

if (isset($_POST['submitted'])) {

	//on retourve la valeur de $f_photo
	if (isset($_POST['photo'])) {//on a bien une photo selectionnée
		$f_photo=escape_data(trim($_POST['photo']));
	} else {
		$f_photo=FALSE;
		$errors[]='<p><font color="red"> - Vous devez choisir une photo.</font></p>';
	}
	
	if ($f_photo) {
		$query="UPDATE vsysmembres SET v_MembreImage='$f_photo' WHERE v_MembreID=$u_id";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		if (mysql_affected_rows() == 1) {// on a un resultat
			//recuperation de l'image
			$photo=get_image($u_id);
			$retour= "Votre image a été mise à jour, et enregistrée.";
		} else {
			$errors[]='<p><font color="red"> - Votre changement n\'a pas pu être enregistré. Veuillez contacter votre administrateur de site.</font></p>';
		}
	}//fin de "if ($f_photo)"
	
} //fin de if (isset($_POST['submitted']))
		
?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='profil';
	$lienactif='profil3';
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Changer mon image</span></p><br />
<?php
	if (isset($retour)) {
		echo '<p>' . $retour . '</p><br /><br />';
	}
?>
<p>Choisissez une nouvelle image pour vous représenter, parmi celles qui vous sont proposées...<br /><br />
</p>
<fieldset><legend>Choisissez une photo : </legend>
<table border="0" cellspacing="5" cellpadding="5" width="100%">
	<tr>
	<form action="profil3.php" method="post">
	
	<?php // on retrouve les photos générales et celles qui appartiennent a l'user
	
	$query="SELECT v_ImageID, v_ImageFile, v_ImageNom FROM vsysimages WHERE v_ImageMembreID =0 or v_ImageMembreID = $u_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	//on retourne les resultats
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {	
		if ($row['v_ImageFile'] == $photo ) {//c'est la photo choisi de l'user
			echo '<td align="center" width="25%" class="photo"><img src="../images/avatar/' . $row['v_ImageFile'] . '" height="50" width="50" /><br  /><input type="radio" name="photo" value="' . $row['v_ImageFile'] . '" checked />' . $row['v_ImageNom'] . '</td>';
		} else {
			echo '<td align="center" width="25%" class="photo"><img src="../images/avatar/' . $row['v_ImageFile'] . '" height="50" width="50" /><br  /><input type="radio" name="photo" value="' . $row['v_ImageFile'] . '"  />' . $row['v_ImageNom'] . '</td>';
		}
		//verifier que l'on est en fin de row
		if ( ($row['v_ImageID'] / 4) == ((int)($row['v_ImageID'] / 4))) {
			echo "</tr>\n<tr>";
		}
	}
	?>
	</tr>
	<tr>
		<td align="center" colspan="4"><input type="submit" name="submit" value="Valider mon choix" /></td>
	</tr>
	<input type="hidden" name="submitted" value="TRUE" />
	</form>
</table>
</fieldset>
</div>
	
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>