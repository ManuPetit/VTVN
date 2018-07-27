<?php # script : membres.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Membres login.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('includes/headerUnCol.php');

//Verifier si la page a été soumise
if (isset($_POST['submitted'])) {
	
	//connection à la database
	require_once('../../vtvn_connection.php');
	
	// creation tableau des erreurs
	$errors=array();
	
	//verifier pour un nom d'identifiant (3 à 15 lettres)
	if (eregi ('^[[:alpha:]]{3,15}$', stripslashes(trim($_POST['nom'])))) {
		$nom = escape_data($_POST['nom']);
	} else {
		$nom = FALSE;
		$errors[] = '<p><font color="red"> - Veuillez v&eacute;rifier que vous avez correctement entr&eacute; votre identifiant.</font></p>';
	}
	
	//verifier pour un passeport (4 à 20 caractères alpha numériques)
	if (eregi ('^[[:alnum:]]{4,20}$', stripslashes(trim($_POST['password'])))) {
		$motp = escape_data($_POST['password']);
	} else {
		$motp = FALSE;
		$errors[]= '<p><font color="red"> - Veuillez v&eacute;rifier que vous avez correctement entr&eacute; votre mot de passe.</font></p>';
	}
	
	if ($nom && $motp) {//si on a un nom et un mot de passe
	
		//faire la requete
		$query = "SELECT v_MembreID, v_MembreActive, v_MembrePrenom, v_GroupeID FROM vsysmembres WHERE v_MembreIdentite='$nom' AND v_MembreMotPasse=SHA('$motp') AND v_MembreLive=1";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		//Il y a un match
		if (@mysql_num_rows($result) == 1) {
			// enregistrement des valeurs et redirection
			$row=mysql_fetch_array($result,MYSQL_NUM);
			$_SESSION['v_mid']=$row[0];
			$_SESSION['prenom']=$row[2];
			$_SESSION['lagent']=md5($_SERVER['HTTP_USER_AGENT']);
			
			//creation de l'url de redirection en fonction de l'activation
			if ($row[1] == 0) {//membre non active
				$fichier = '/active.php';
			} elseif ($row[1] == 1) {//membre a reçu une email d'activation mais n'a pas clique le lien
				$fichier = '/nonactive.php';
			} else {// le membre est forcément active
				$fichier = '/connection.php';
				//on ajoute cette variable pour pouvoir affiche la date de connexion
				$_SESSION['phase1']=1;
			} 
			
			//creation de l'url de redirection en fonction du groupe
			if ($row[3] == 1) {//membre du groupe d'administration 
				$_SESSION['admin']=TRUE;
				$fichier = '/ad_connect.php';
			} else {// on utilise le fichier créer dans activation
				$_SESSION['admin']=FALSE;
			}
						
			//creation de l'URL de redirection
			$url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);
			//verifier pour le backslash
			if ((substr($url,-1) == '/') OR (substr($url,-1) == '\\')) {
				//enlever le slash
				$url=substr($url,0,-1);
			}
			//ajoute le nom du fichier
			$url .= $fichier;
			//rediriger
			ob_end_clean();
			header("Location: $url");
			exit();
			
		} else {//il n'y a pas de match
			$errors[]='<p><font color="red"> - L&acute;identifiant et le mot de passe saisies ne correspondent à aucune entrée.</font></p>';
		}// fin de "if (@mysql_num_rows($result) == 1)"
		
		mysql_close();//close the connection
		
	}//fin de "if ($nom && $motp)"
	
}// fin de "if (isset($_POST['submitted']))"



?>
	<div id="longHaut">
      <h2>Membres</h2>
    </div>
	<div id="longMilieu">
<?php

//on imprime les erreurs
if (!empty($errors)) {
report_erreurs($errors);
}

//verifier si oubli existe si oui on ajoute 1
if (isset($_POST['oubli'])) {
	$_POST['oubli'] += 1;
}

//
?>
	<div id="ident">
<fieldset><legend>Veuillez vous identifier : </legend>
<form action="membres.php" method="post"> 
	<table border="0" cellpadding="5" width="90%">
		<tr>
			<td width="50%" align="left">Votre identifiant :</td>
			<td width="50%" align="left"><input type="text" size="15" maxlength="20" name="nom" value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>" /></td>
		</tr>
		<tr>
			<td>Votre mot de passe :</td>
			<td><input type="password" size="15" maxlength="20" name="password" /></td>
		</tr>
		<?php # si on a fait 2 mauvaise tentative afficher le message pour demander un nouveau passeport
		//verifier que oubli existe
		if (isset($_POST['oubli'])) {
			//verifier oubli est supérieur à 1
			if ($_POST['oubli'] >= 2) {//on affiche le message
				echo '<tr><td colspan="2"><a class="inLien" href="gene_motp.php">J&acute;ai oubli&eacute; mon mot de passe...</a></td></tr>';
			}// FIN de "if ($_POST['oubli'] >= 2)"
		}//FIN de "if (isset($_POST['oubli']))"
		?>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="Valider" /></td>
		</tr>
	</table>
	<input type="hidden" name="submitted" value="TRUE" />
	<input type="hidden" name="oubli" value="<?php 
	if (isset($_POST['oubli'])) {
		echo $_POST['oubli'];
	} else {
		echo 0;
	}
	?>" />
</form>
</fieldset>
</div>
</div>
<?php
$menu_choix =NULL;
include ('includes/footerUnCol.php');
?>
