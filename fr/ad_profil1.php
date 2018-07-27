<?php # script : ad_profil1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Créer un profil.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$e1=FALSE;
$e2=FALSE;
$e3=FALSE;
$pass=make_password(8);//creation du mot de passe
$groupe=array();//type de membres
$grp_id=array();
$query="SELECT v_GroupeID, v_GroupeNom FROM vsysgroupe ORDER BY v_GroupeNom DESC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		//on retrouve nos groupes
		$grp_id[]=$row['v_GroupeID'];
		$groupe[]=$row['v_GroupeNom'];
	}
} else {
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='profils';
		$lienactif=NULL;
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?><p><span class="sstitre">Créer un nouveau profil</span></p><br />
		<p>Une erreur s'est produite. Si le problème persiste, contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(13);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} // FIN DE "if (@mysql_num_rows($result) >= 1) {

if (isset($_POST['soumis'])) {
	$errors=array();
	
	//verifier pour un nom d'identifiant (3 à 15 lettres)
	if (eregi ('^[[:alpha:]]{3,15}$', stripslashes(trim($_POST['ident'])))) {
		$ident = escape_data($_POST['ident']);
	} else {
		$e1=TRUE;
		$ident = FALSE;
		$errors[] = '<p><font color="red"> - Veuillez v&eacute;rifier que vous avez correctement entr&eacute; l\'identifiant.</font></p>';
	}

	//verifier pour un prenom d'identifiant (3 à 20 lettres)
	if (eregi ('^[[:alpha:] àâçéèêëîïôöùû-]{3,20}$', stripslashes(trim($_POST['prenom'])))) {
		$prenom = escape_data($_POST['prenom']);		
	} else {
		$prenom = FALSE;
		$e2=TRUE;
		$errors[] = '<p><font color="red"> - Le prénom que vous avez saisi n\'est pas correct..</font></p>';
	}// fin de "if (eregi ('^[[:alpha:]]{3,20}$', stripslashes(trim($_POST['prenom']))))"
	
	//verifier pour un prenom d'identifiant (3 à 25 lettres)
	if (eregi ('^[[:alpha:] àâçéèêëîïôöùû-]{3,25}$', stripslashes(trim($_POST['nom'])))) {
		$nom = escape_data($_POST['nom']);		
	} else {
		$nom = FALSE;
		$e3=TRUE;
		$errors[] = '<p><font color="red"> - Le nom que vous avez saisi n\'est pas correct.</font></p>';
	}//fin de "if (eregi ('^[[:alpha:]]{3,25}$', stripslashes(trim($_POST['nom']))))"
	
	if ($ident && $prenom && $nom) {//on a des entrées correctes
		$groupeid=$_POST['groupe'];
		$password=$_POST['password'];
		
		//faire la requete
		$query="INSERT INTO vsysmembres (v_MembreIdentite, v_MembreMotPasse, v_MembreLive, v_MembreActive, v_MembrePrenom, V_MembreNom, v_GroupeID, v_MembreImage, v_MembreCreation) VALUES ('$ident', SHA('$password'), 1, 0, '$prenom', '$nom', $groupeid, 'av_000.jpg', NOW())";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

		//verifier que l'on a un resultat
		if (@mysql_affected_rows() == 1) {
			$body="Le profil d'utilisateur $ident a été créé avec succés avec le mot de passe suivant :\n$password";
			mail('webmaster@vieuxnyons.com','Nouveau membre',$body,'From: administration@vieuxnyons.com');			
			?>
				<div id="longHaut">
				  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
				</div>
				<div id="longMilieu">
			<?php	
				$header='profils';
				$lienactif=NULL;
				include('./includes/admin.php'); 
				echo'<div id="mainMemb">';
			?><p><span class="sstitre">Créer un nouveau profil</span></p><br />
				<p>Le profil a été créer avec succès.</p></div>
				
			<?php
				print_ligne(13);
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
				$header='profils';
				$lienactif=NULL;
				include('./includes/admin.php'); 
				echo'<div id="mainMemb">';
			?><p><span class="sstitre">Créer un nouveau profil</span></p><br />
				<p>Une erreur s'est produite durant la création du profil. Si le problème persiste, contacter l'administrateur du site.</p></div>
				
			<?php
				print_ligne(13);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		} // FIN DE "if (@mysql_num_rows($result) == 1) {

	}//fin de "if ($ident && $prenom && $nom)

}// FIN DE "if (isset($_POST['soumis'])) {	
	
	
	
?>

	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='profils';
	$lienactif='profil1';
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Créer un nouveau profil</span></p><br />
<p>Vous allez créer le profil d'un nouvel utilisateur de l'intranet vieuxnyons.com</p><br />
<?php 
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	} 
?>
<fieldset><legend>Profil d'utilisateur</legend>
<p><br /></p>
<table width="100%" border="0" cellspacing="5">
<form action="ad_profil1.php" method="post">
	<tr>
		<td width="40%" align="left" class="photo">
		<?php
			if (isset($e1)) {
				if ($e1==TRUE) {
					echo '<font color="red">Identifiant :</font></td>';
				} else {
					echo 'Identifiant :</td>';
				}
			}
		?>				
		<td width="60%" align="left"><input type="text" size="20" maxlength="15" name="ident" value="<?php if (isset($_POST['ident'])) echo $_POST['ident']; ?>" /></td>
	</tr>
	<tr>
		<td class="photo">Mot de passe :</td>
		<td><input type="text" value="<?php echo $pass; ?>" name="password" size="20"/></td>
	</tr>
	<tr>
		<td class="photo">Type de membre :</td>
		<td><select name="groupe">
		<?php
			$count=count($groupe)-1;
			for ($i=0; $i<=$count;$i++) {
				echo '<option value="' . $grp_id[$i] . '"';
				if (isset($_POST['groupe'])) {
					if ($_POST['groupe'] == $grp_id[$i]) {
						echo '  selected="selected"';
					}
				}
				echo ">" . $groupe[$i] . "</option>\n";
			}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td class="photo">
		<?php
			if (isset($e2)) {
				if ($e2==TRUE) {
					echo '<font color="red">Prénom :</font></td>';
				} else {
					echo 'Prénom :</td>';
				}
			}
		?>	
		<td><input type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) echo $_POST['prenom']; ?>" size="20" maxlength="20" />
		</td>
	</tr>
	<tr>
		<td class="photo">
		<?php
			if (isset($e3)) {
				if ($e3==TRUE) {
					echo '<font color="red">Nom :</font></td>';
				} else {
					echo 'Nom :</td>';
				}
			}
		?>	
		<td><input type="text" name="nom" value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>" size="20" maxlength="25" />
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="submit" name="submit" value="Créer le nouveau membre" /></td>
	</tr>
	<input type="hidden" name="soumis" value="TRUE" />
</form>
</table>
</fieldset>
</div>
	
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
