<?php # script : active.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Premi&egrave;re visite : demande d&acute;activation.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('includes/headerUnCol.php');

//verifier que le script est atteint avec les variables necessaire
if ((!isset($_SESSION['v_mid'])) OR (!isset($_SESSION['prenom'])) OR (!isset($_SESSION['lagent'])) OR ($_SESSION['lagent'] != md5($_SERVER['HTTP_USER_AGENT']))) {//accès par erreur.....
	//creation de l'URL de redirection
	$url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);
	//verifier pour le backslash
	if ((substr($url,-1) == '/') OR (substr($url,-1) == '\\')) {
		//enlever le slash
		$url=substr($url,0,-1);
	}
	//ajoute le nom du fichier
	$url .= '/echec.php';
	//rediriger
	ob_end_clean();
	header("Location: $url");
	exit();
} else { //creation des variables
	$u_id = $_SESSION['v_mid'];
	$prenom = $_SESSION['prenom'];
}

//verifier que le script a été soumis
if (isset($_POST['submitted'])) {

	//connection to db
	require_once('../../vtvn_connection.php');
	
	//creation du tableau d'erreur
	$errors=array();
	
	//verification de la validité de l'addresse email fournie
	if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['emaila'])))){
		$ea=escape_data($_POST['emaila']);
	} else {
		$ea=FALSE;
		$errors[]='<p><font color="red"> - Veuillez v&eacute;rifier l&acute;adresse email que vous avez saisie.</font></p>';
	}
	
	//verifier que les deux addresse email sont similaires
	if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['emaila'])))){
		$eb=escape_data($_POST['emailb']);
	} else {
		$eb=FALSE;
		$errors[]='<p><font color="red"> - Veuillez v&eacute;rifier l&acute;adresse email que vous avez confirm&eacute;e.</font></p>';
	}
	
	//Si on a deux adresse email
	if ($ea && $eb){
		//comparons les deux adresses
		if ($ea == $eb) {
			
			//on peut faire l'enregistrement
			$query = "UPDATE vsysmembres SET v_MembreEmail='$ea', v_MembreActive=1 WHERE v_MembreID=$u_id";
			$result = mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			
			//vérifier que l'on a bien un update
			if (mysql_affected_rows() == 1) {
			
				//retrouver le timestamp
				$query="SELECT v_MembreTS, sha(v_MembreIdentite) FROM vsysmembres WHERE v_MembreID=$u_id";
				$result = mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
				
				if (mysql_affected_rows() == 1) {
					//on retrouve l'information
					$row=mysql_fetch_array($result,MYSQL_NUM);
					//on code les données
					$ts=base64_encode($row[0]);
					$tid=base64_encode($u_id); 
					$vmi=$row[1];
					
					//preparer le contenu du mail
					$body = $prenom . ',';
					$body .= "\n\nMerci pour avoir activer votre compte. Pour que vous puissiez accèder pleinement à tous les services, veuillez cliquer sur le lien ci-après:\n\n\n";
					$body .= "http://www.vieuxnyons.com/fr/activation.php?x=$ts&y=$tid&z=$vmi";
					$body .= "\n\nA bientôt sur vieuxnyons.com.";

					//envoyé le mail					
					mail($ea, 'Activation de votre compte',$body, 'From: administration@vieuxnyons.com');
					
					//creation de l'URL de redirection
					$url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);
					//verifier pour le backslash
					if ((substr($url,-1) == '/') OR (substr($url,-1) == '\\')) {
						//enlever le slash
						$url=substr($url,0,-1);
					}
					//ajoute le nom du fichier
					$url .= '/merci.php';
					//rediriger
					ob_end_clean();
					header("Location: $url");
					exit();
				
				} else {//on rapporte le probleme
					$errors[] = '<p><font color="red"> - Erreur v001. Veuillez contacter votre administrateur.</font></p>';
				
				}// fin de "if (mysql_affected_rows() == 1)" de la deuxième query
			
			} else {//on rapporte le probleme
					$errors[] = '<p><font color="red"> - Erreur v002. Veuillez contacter votre administrateur.</font></p>';
			
			}// fin de "if (mysql_affected_rows() == 1)" de la première query

			mysql_close();		
		
		} else {//les deux adresse emails sont différentes
			$errors[]='<p><font color="red"> - Les deux adresses saisies ne sont pas similaires.</font></p>';
			
		}//fin de "if ($ea == $eb) {"
	
	}// FIN DE "if ($ea && $eb){";
	
} // FIN DE "if (isset($_POST['submitted'])) {"				
?>	
	<div id="longHaut">
      <h2>Bienvenue, <?php echo $prenom; ?> !</h2>
    </div>
	<div id="longMilieu">
<?php

///on imprime les erreurs
if (!empty($errors)) {
report_erreurs($errors);
} else {//si il n'y a pas d'erreur, il s'agit du premier passage donc on affiche ce message

?>
	<p>Il s'agit de votre premi&egrave;re connexion sur le serveur de &quot;vieuxnyons.com&quot;.</p><br />
	<p>Avant que vous puissiez profiter pleinement du syst&egrave;me, il faut que vous fournissiez une adresse email valide. Cette adresse est n&eacute;cessaire pour le bon fonctionnement du serveur, et elle sera utilis&eacute; dans le cas d'un oubli de votre mot de passe.</p><br />
	<p>Une fois que vous aurez valid&eacute; votre adresse ci-dessous, un email sera envoy&eacute; dans les minutes qui suivent &agrave; l'adresse que vous avez fournie. Dans cet email, vous trouverez un lien d&acute;activation sur lequel vous pourrez cliquer pour finir la mise en service de votre compte.<p>
<?php
}//fin de "if (!empty($errors))"
?>
	<br />
	<div id="ident">
<fieldset><legend>Veuillez saisir votre adresse email : </legend>
<form action="active.php" method="post">
	<table border="0" cellpadding="5" width="90%">
		<tr>
			<td width ="75%" align="left">Votre adresse email :</td>
			<td width="25%" align="left"><input type="text" size="20" maxlength="60" value="<?php if (isset($_POST['emaila'])) echo $_POST['emaila']; ?>" name="emaila"/></td>
		</tr>
		<tr>
			<td>Confirmer votre adresse email :</td>
			<td><input type="text" size="20" maxlength="60" name="emailb" /></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" name="submit" value="Valider"  /></td>
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