<?php # script : activation.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Activation.';
$image_entete='enteteMembres';
$menu_item=NULL;
include ('includes/headerUnCol.php');

//on retrouve les données de l'email
if  (isset($_GET['x'])) {//on a reçu un x
	$x=$_GET['x'];
} else {
	$x=FALSE;
}

if (isset($_GET['y'])) {//on a reçu y
	$y=$_GET['y'];
} else {
	$y=FALSE;
}

if (isset($_GET['z'])) {//on a reçu z
	$z=$_GET['z'];
} else {
	$z=FALSE;
}

//creation des erreurs
$errors=array();

//si on a x et y
if ($x && $y && $z) {
	
	//connection to db
	require_once('../../vtvn_connection.php');
	
	//creer la requete
	$query ="UPDATE vsysmembres SET v_MembreActive = 2 WHERE v_MembreID = " . base64_decode($y) . " AND v_MembreTS = '" . base64_decode($x) . "' AND SHA(v_MembreIdentite) = '$z'";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	//verifier que l'on a un resultat
	if (mysql_affected_rows() == 1) {
		?>
		<div id="longHaut">
      <h2>Activation completée</h2>
    </div>
	<div id="longMilieu">
	<p>Vous pouvez maintenant vous connecter au serveur de "vieuxnyons.com".<br/>Pour ce faire, allez sur la page <a class="inLien" href="membres.php">membres</a> et entrez votre identifiant et mot de passe....</p>
		<?php
	} elseif (mysql_affected_rows() == 0){ //aucune trace dans la base de données
		$errors[]='<p><font color="red"> - Erreur v004. Veuillez contacter votre administrateur.</font></p>';
	} else {
		$errors[]='<p><font color="red"> - Erreur v003. Veuillez contacter votre administrateur.</font></p>';
	}// fin de "if (mysql_affected_rows() == 1)"

} else { //on n'a pas les valeurs auxquelles on s'attend accés compromis
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
}// fin de "if ($x && $y && $z)"

if (!empty($errors)) {//on a des erreurs
	?>
	<div id="longHaut">
      <h2>Problème durant l'activation</h2>
    </div>
	<div id="longMilieu">
	<?php
	report_erreurs($errors);
}//fin de "if (!empty($errors))"
?>
	<!-- FIN de la page web-->
	<!-- DEBUT Footer-->
	<div id="longBas"></div>
</div>
<div id="pied">
   <ul id="menubas">
   	<li><a href="../fr/mentions.php">Mentions</a></li>
	<li><a href="../fr/contacts.php">Contacts</a></li>
	<li><a href="../fr/plan.php">Plan du site</a></li>
   </ul>
</div>
</div>
</body>
</html>
<?php
//detruire la session
$_SESSION = array();//destroy the varaibles
session_destroy();//destroy the session itself
setcookie(session_name(), '', time()-300,'/', '',0);//destroy the cookie
//vider le buffer
ob_end_flush();
?>
