<?php # script : nonactive.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Membre non actif.';
$image_entete='enteteMembres';
$menu_item=NULL;
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
}
?>
<div id="longHaut">
      <h2>Membre non actif...</h2>
    </div>
	<div id="longMilieu">
	<p>Un email vous a &eacute;t&eacute; envoy&eacute;. Mais vous n'avez pas encore cliqu&eacute; sur le lien d'activation fourni dans cet email.</p><br />
	<p>Vous ne pouvez pas vous connecter tant que votre compte n'aura pas &eacute;t&eacute; activ&eacute;. Veuillez consulter votre messagerie.</p><br />
	<p>Si le probl&egrave;me persiste, veuillez contacter l'<a class="inLien" href="mailto:webmaster@vieuxnyons.com">administrateur</a> du site.</p>
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