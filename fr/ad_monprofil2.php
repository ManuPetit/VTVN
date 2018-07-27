<?php # script : profil2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Changer de mot de passe.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');
$errors=array();

if (isset($_POST['submitted'])) {//si on  a soumi la forme
		
	//verifier pour un passeport (4 à 20 caractères alpha numériques)
	if (eregi ('^[[:alnum:]]{4,20}$', stripslashes(trim($_POST['password'])))) {
		$motp = escape_data($_POST['password']);
	} else {
		$motp = FALSE;
		$errors[]= '<p><font color="red"> - Veuillez v&eacute;rifier que vous avez correctement entr&eacute; votre mot de passe.</font></p>';
	}
	
	//verifier pour un nouveau passeport (4 à 20 caractères alpha numériques)
	if (eregi ('^[[:alnum:]]{4,20}$', stripslashes(trim($_POST['passworda'])))) {
		$motpa = escape_data($_POST['passworda']);
		if ($motpa != escape_data($_POST['passwordb'])) {//si les deux mots de passe sont different
			$motpa=FALSE;
			$errors[]= '<p><font color="red"> - Le nouveau mot de passe ne correspond pas à la confirmation du nouveau mot de passe.</font></p>';
		}
	} else {
		$motpa = FALSE;
		$errors[]= '<p><font color="red"> - Veuillez v&eacute;rifier que vous avez correctement entr&eacute; votre nouveau mot de passe.</font></p>';
	}
	
	if ($motp && $motpa) {// on a les deux entrées
		
		if ($motp != $motpa) {//le nouveau mot de passe ne corespond pas à l'ancien
			//verification du mot de passe actuel
			$query="SELECT v_MembreID FROM vsysmembres WHERE v_MembreMotPasse=SHA('$motp')";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			
			//verifier que l'on a un resultat
			if (@mysql_num_rows($result) == 1) {
				$row=mysql_fetch_array($result,MYSQL_NUM);
				$memID=$row[0];
			
				if ($memID == $u_id) {//correspondance entre l'utilisateur loggé et son mot de passe
					//on mais a jour la db
					$query="UPDATE vsysmembres SET v_MembreMotPasse = SHA('$motpa') WHERE v_MembreID = $u_id";
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
							include('./includes/admin.php'); 
							echo'<div id="mainMemb">';
						?>
							<p><span class="sstitre">Changer de mot de passe</span></p><br /><br  />
							<p>Votre mot de passe a été modifié.</p>
							</div>
						<?php
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
							include('./includes/admin.php'); 
							echo'<div id="mainMemb">';
						?>
							<p><span class="sstitre">Changer de mot de passe</span></p><br /><br  />
							<p>Aucune modification n'a été faite.</p>
							</div>
						<?php
							print_ligne(12);
							$menu_choix =NULL;
							include ('./includes/footerUnCol.php');
							exit();
					} else { // on a pas de resultat
						$errors[]=$errors[]='<p><font color="red"> - Erreur v008. Veuillez contacter votre administrateur.</font></p>';
				
					}// fin de "if (mysql_affected_rows() == 1)"
					
				} else { //mauvaise correspondance entre l'utilisateur loggé et son mot de passe
					$errors[]='<p><font color="red"> - Le mot de passe que vous avez entré ne correspond pas à votre compte.</font></p>';
				}//fin de "if ($memID == $u_id)"
			
			} else {//on a pas retrouve le mot de passe entré
				$errors[]='<p><font color="red"> - Le mot de passe que vous avez entré ne correspond à aucun compte. Contacter l&acute;administrateur du site.</font></p>';
			} // fin de "if (@mysql_num_rows($result) == 1)"
			
		} else {//le mot de passe et le mouveau sont identiques
			$errors[]='<p><font color="red"> - Le nouveau mot de passe que vous avez entré, est identique à votre mot de passe actuel.</font></p>';
			
		} //fin de "if ($motp != $motpa)"
	
	}// fin de "if ($motp && $motpa)"
	mysql_close();
	
}//fin de "if (isset($_POST['submitted']))"
?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='profil';
	$lienactif='profil2';
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	} 
?>

<p><span class="sstitre">Changer de mot de passe</span></p><br />
<p>
<form action="ad_monprofil2.php" method="post">
<fieldset><legend>Mot de passe : </legend>
	<table border="0" cellpadding="5" width="100%">
		<tr>
			<td align="left" width="70%" class="photo">Mot de passe actuel :</td>
			<td align="left" width="30%"><input type="password" name="password" size="15" maxlength="20" /></td>
		</tr>
		<tr>
			<td height="20" colspan="2"></td>
		</tr>
		<tr>
			<td class="photo">Nouveau mot de passe :</td>
			<td><input type="password" name="passworda" size="15" maxlength="20" /></td>
		</tr>
		<tr>
			<td class="photo">Confirmer le nouveau mot de passe :</td>
			<td><input type="password" name="passwordb" size="15" maxlength="20" /></td>
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
print_ligne(4);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>