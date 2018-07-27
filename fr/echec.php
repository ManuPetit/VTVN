<?php # script : membres.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Accès refusé!!!';
$image_entete='enteteMembres';
$menu_item=NULL;
include ('includes/headerUnCol.php');
?>
<div id="longHaut">
      <h2>Erreur d&acute;acc&egrave;s !</h2>
    </div>
	<div id="longMilieu">
	<p>L&acute;acc&egrave;s &agrave; cette page n&acute;est pas autoris&eacute; sans identification.</p>
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