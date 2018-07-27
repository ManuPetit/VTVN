<?php # script : envoiMail.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Mail envoyé.';
$image_entete='enteteMembres';
$menu_item=NULL;
include ('includes/headerUnCol.php');

?>
<div id="longHaut">
      <h2>Envoi de mail confirmé</h2>
    </div>
	<div id="longMilieu">
	<p>Un email vous a &eacute;t&eacute; envoy&eacute;. Consultez votre messagerie, et utilisez les informations de connexion fournies pour accéder au serveur de &quot;vieuxnyons.com&quot;.</p>
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