<?php # script : profil1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Editer mon profil.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

$errors=array();

if (isset($_POST['submitted'])) {//form a été submitted

	//verifier pour un prenom d'identifiant (3 à 15 lettres)
	if (eregi ('^[[:alpha:] àâçéèêëîïôöùû]{3,20}$', stripslashes(trim($_POST['prenom'])))) {
		$prenom = escape_data($_POST['prenom']);		
	} else {
		$prenom = FALSE;
		$errors[] = '<p><font color="red"> - Le prénom que vous avez saisi n\'est pas correct..</font></p>';
	}// fin de "if (eregi ('^[[:alpha:]]{3,20}$', stripslashes(trim($_POST['prenom']))))"
	
	//verifier pour un prenom d'identifiant (3 à 15 lettres)
	if (eregi ('^[[:alpha:] àâçéèêëîïôöùû]{3,25}$', stripslashes(trim($_POST['nom'])))) {
		$nom = escape_data($_POST['nom']);		
	} else {
		$nom = FALSE;
		$errors[] = '<p><font color="red"> - Le nom que vous avez saisi n\'est pas correct.</font></p>';
	}//fin de "if (eregi ('^[[:alpha:]]{3,25}$', stripslashes(trim($_POST['nom']))))"
	
	//verification de la validité de l'addresse email fournie
	if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['email'])))){
		$email=escape_data($_POST['email']);
	} else {
		$email=FALSE;
		$errors[]='<p><font color="red"> - L\'email que vous avez saisie n\'est pas correcte..</font></p>';
	}// fin de "if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['email']))))"
	
	if ($prenom && $nom && $email) {// Si on a les données 
		//on met a jour la base de donnée
		$query="UPDATE vsysmembres SET v_MembrePrenom='$prenom', v_MembreNom='$nom', v_MembreEmail='$email' WHERE v_MembreID = $u_id";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		if (mysql_affected_rows() == 1) {// on a un resultat
			?>
				<div id="longHaut">
      			<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    			</div>
				<div id="longMilieu">
				<?php	
					$header='profil';
					$lienactif=NULL;
					include('./includes/membmenu.php'); 
					echo'<div id="mainMemb">';
				?>
				<p><span class="sstitre">Editer mon Profil</span></p><br /><br  />
				<p>Vos détails ont été mis à jour.</p>
				</div>
			<?php
				$_SESSION['prenom']=$prenom;
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		} elseif (mysql_affected_rows() == 0) {//on a fait aucun changement
			?>
				<div id="longHaut">
      			<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    			</div>
				<div id="longMilieu">
				<?php	
					$header='profil';
					$lienactif=NULL;
					include('./includes/membmenu.php'); 
					echo'<div id="mainMemb">';
				?>
				<p><span class="sstitre">Editer mon Profil</span></p><br /><br  />
				<p>Aucun détails n'ont été changés.</p>
				</div>
			<?php
				$_SESSION['prenom']=$prenom;
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
			
		} else { // on a pas de resultat
			$errors[]=$errors[]='<p><font color="red"> - Erreur v007. Veuillez contacter votre administrateur.</font></p>';
			
		}// fin de "if (mysql_affected_rows() == 1)"
		
	}// FIN DE "if ($prenom && $nom && $email)"
	
	//on doit donc retrouver les infos de la db
	$query="SELECT v_MembrePrenom, v_MembreNom, v_MembreEmail FROM vsysmembres WHERE v_MembreID = $u_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_NUM);
		$f_prenom=$row[0];
		$f_nom=$row[1];
		$f_email=$row[2];
	} else {
		$errors[]='<p><font color="red"> - Le système n\'a pas pu retrouver vos informations. Veuillez contacter l\administrateur du site.</font></p>';
	}// fin de "if (@mysql_num_rows($result) == 1)"
	
} else { //form pas submitted premier accès on retrouve les infos de la base de donnée
	
	$query="SELECT v_MembrePrenom, v_MembreNom, v_MembreEmail FROM vsysmembres WHERE v_MembreID = $u_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_NUM);
		$f_prenom=$row[0];
		$f_nom=$row[1];
		$f_email=$row[2];
	} else {
		$errors[]='<p><font color="red"> - Le système n\'a pas pu retrouver vos informations. Veuillez contacter l\administrateur du site.</font></p>';
	}// fin de "if (@mysql_num_rows($result) == 1)"
	
}// fin de "if (isset($_POST['submitted'])) "
		
	
?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $f_prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='profil';
	$lienactif='profil1';
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	} 
?>

<p><span class="sstitre">Editer mon Profil</span></p><br />
<p>
<form action="profil1.php" method="post">
<fieldset><legend>Mon profil : </legend>
	<table border="0" cellpadding="5" width="90%">
		<tr>
			<td align="left" width="25%" class="photo">Prénom :</td>
			<td align="left" width="75%"><input type="text" size="20" maxlength="20" name="prenom" value="<?php if (isset($f_prenom)) echo $f_prenom; ?>" /></td>
		</tr>
		<tr>
			<td class="photo">Nom :</td>
			<td><input type="text" size="20" maxlength="25" name="nom" value="<?php if (isset($f_nom)) echo $f_nom; ?>" /></td>
		</tr>
		<tr>
			<td class="photo">Email :</td>
			<td><input type="text" size="35" maxlength="60" name="email" value="<?php if (isset($f_email)) echo $f_email; ?>" /></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" name="submit" value="Valider" /></td>
		</tr>
	</table>
	<input type="hidden" name="submitted" value="TRUE" />
</fieldset>
</form>		
</p>
</div>
	
<?php
print_ligne(6);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>