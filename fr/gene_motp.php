<?php # script : gene_motp.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Génération d&acute;un nouveau mot de passe.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('includes/headerUnCol.php');

//verifier que le script est soumis
if (isset($_POST['submitted'])) {
	
	//connection to db
	require_once('../../vtvn_connection.php');
	
	//creation du tableau d'erreur
	$errors=array();
	
	//verifier pour un nom d'identifiant (3 à 15 lettres)
	if (eregi ('^[[:alpha:]]{3,15}$', stripslashes(trim($_POST['nom'])))) {
		$nom = escape_data($_POST['nom']);
	} else {
		$nom = FALSE;
		$errors[] = '<p><font color="red"> - Veuillez v&eacute;rifier que vous avez correctement entr&eacute; votre identifiant.</font></p>';
	}
	
	//verification de la validité de l'addresse email fournie
	if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['email'])))){
		$em=escape_data($_POST['email']);
	} else {
		$em=FALSE;
		$errors[]='<p><font color="red"> - Veuillez v&eacute;rifier l&acute;adresse email que vous avez saisie.</font></p>';
	}

	if ($nom && $em) {//on a un identifiant et une email
	
		//selection du numero d'id pour ce membre
		$query="SELECT v_MembreID, v_MembrePrenom FROM vsysmembres WHERE v_MembreIdentite='$nom' AND v_MembreEmail ='$em'";
		$result = mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		//vérifier que l'on a bien un update
		if (mysql_affected_rows() == 1) {//on a un match on peut generer un mot de passe
			$row=mysql_fetch_array($result,MYSQL_NUM);
			$uid=$row[0];
			$prenom=$row[1];
			$motp=make_password(10);
			
			//on fait un update dans le db
			$query="UPDATE vsysmembres SET v_MembreMotPasse = SHA('$motp') WHERE v_MembreID = $uid";
			$result = mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			
			if (mysql_affected_rows() == 1) {// on a un resultat
				//creation du mail
				$body = $prenom . ",\n\nComme vous l'avez souhaité, nous vous faisons parvenir un nouveau mot de passe pour accéder au serveur de \"vieuxnyons.com\".\nVous pourrez changer ce mot de passe lors de votre prochaine connexion au serveur, si vous le souhaitez.\n\n";
				$body .= "Votre identifiant : $nom\nVotre nouveau mot de passe : $motp\n\n";
				$body .="A bientôt sur vieuxnyons.com\n\nPS: Veillez à bien respecter les majuscules de votre mot de passe";				
				
				mail($em, 'Informations de connexion',$body, 'From: administration@vieuxnyons.com');
				
				//creation de l'URL de redirection
				$url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);
				//verifier pour le backslash
				if ((substr($url,-1) == '/') OR (substr($url,-1) == '\\')) {
					//enlever le slash
					$url=substr($url,0,-1);
				}
				//ajoute le nom du fichier
				$url .= '/envoiMail.php';
				//rediriger
				ob_end_clean();
				header("Location: $url");
				exit();
				
			} elseif (mysql_affected_rows() == 0) {//on a pas pu faire l'update
				$errors[]='<p><font color="red"> - Erreur v005. Veuillez contacter votre administrateur.</font></p>';
			} else {//on a plus d'un row
				$errors[]='<p><font color="red"> - Erreur v006. Veuillez contacter votre administrateur.</font></p>';
			}// fin du deuxième "if (mysql_affected_rows() == 1)"
		} else {// on a pas de match entre identifiant et utilisateur
			$errors[] ='<p><font color="red"> - L\'identifiant entré ne correspond à aucune adresse email. Si votre compte n\'a pas encore été activé, veuillez contacter l&acute;<a class="inLien" href="mailto:webmaster@vieuxnyons.com">administrateur</a> du site.</font></p>';
		}// fin du premier "if (mysql_affected_rows() == 1)"
	
	}//fin de "if ($nom && $em)"
	
	mysql_close();
	
}//fin de "if (isset($_POST['submitted'])) "
	
?>
<div id="longHaut">
      <h2>Mot de passe oublié...</h2>
    </div>
	<div id="longMilieu">
<?php

//on imprime les erreurs
if (!empty($errors)) {
	report_erreurs($errors);
} 

?>
<p>Vous avez oublié votre mot de passe. Veuillez fournir les indications ci-après, et nous vous ferons parvenir par email, un nouveau mot de passe.</p><br />
<div id="ident">
<fieldset><legend>Veuillez vous identifier : </legend>
<form action="gene_motp.php" method="post"> 
	<table border="0" cellpadding="5" width="90%">
		<tr>
			<td width="50%" align="left">Votre identifiant :</td>
			<td width="50%" align="left"><input type="text" size="15" maxlength="20" name="nom" value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>" /></td>
		</tr>
		<tr>
			<td>Votre adresse email :</td>
			<td><input type="text" size="20" maxlength="60" name="email" /></td>
		</tr>
		<tr>
			<td align="center" colspan="2">
			<input type="submit" name="submit" value="Envoie d'un nouveau mot de passe" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
</fieldset>
</div>
<?php
$menu_choix =NULL;
include ('includes/footerUnCol.php');
?>