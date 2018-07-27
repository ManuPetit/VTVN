<?php # script : accueil.php
$titre_page='Le plan de notre site internet.';
$image_entete='entetePlan';
include ('includes/headerUnCol.php');
?>
	<div id="longHaut">
      <h2>Plan de notre site</h2>
    </div>
	<div id="longMilieu">
<p>
<table width="90%" border="0" cellpadding="5" class="commer">
<tr>
<td width="20%" class="d1">Accueil</td><td width="80%"><a href="accueil.php" class="inLien">Présentation</a></td>
</tr><tr>
<td></td><td><a href="acc02.php" class="inLien">M&eacute;di&eacute;vales du Pontias</a></td>
</tr>
<tr>
<td></td><td><a href="acc01.php" class="inLien">Qui sommes-nous?</a></td>
</tr>
<tr>
<td class="d1">Evénements</td><td><a href="calendrier.php" class="inLien">Calendrier</a></td>
</tr>
<tr><td></td><td><a href="cal01.php?galid=0" class="inLien">Galeries de photographies</a></td>
</tr>
<tr>
<td class="d1">Commerces</td><td><a href="noscom.php?typid=1&comid=0" class="inLien">Alimentation</a></td>
</tr>
<tr><td></td><td><a href="noscom.php?typid=2&comid=0" class="inLien">Art et décoration</a></td></tr>
<tr><td></td><td><a href="noscom.php?typid=3&comid=0" class="inLien">Divers</a></td></tr>
<tr><td></td><td><a href="noscom.php?typid=4&comid=0" class="inLien">Mode et beauté</a></td></tr>
<tr><td></td><td><a href="noscom.php?typid=5&comid=0" class="inLien">Services</a></td></tr>
<tr><td></td><td><a href="noscom.php?typid=6&comid=0" class="inLien">Sortir</a></td></tr>
<tr>
<td class="d1">Archives</td><td><a href="arch01_00.php" class="inLien">Carnaval</a></td>
</tr>
<tr><td></td><td><a href="arch02_00.php" class="inLien">Hepha&iuml;stos</a></td></tr>
<tr><td></td><td><a href="arch03_00.php" class="inLien">Historique VTVN</a></td></tr>
<tr><td></td><td><a href="arch04_00.php" class="inLien">Marché Floral</a></td></tr>
<tr><td></td><td><a href="arch05_00.php" class="inLien">Mardi-gras</a></td></tr>
<tr>
<td class="d1">Histoire</td><td><a class="inLien" href="his01.php">Antiquité</a></td>
</tr>
<tr><td></td><td><a class="inLien" href="his02.php">Les invasions</a></td></tr>
<tr><td></td><td><a class="inLien" href="his03.php">Moyen-Age</a></td></tr>
<tr><td></td><td><a class="inLien" href="his04.php">Monarchie</a></td></tr>
<tr><td></td><td><a class="inLien" href="his05.php">Guerre de Religion</a></td></tr>
<tr><td></td><td><a class="inLien" href="his06.php">XIXème et XXème Siècles</a></td></tr>
<tr>
<td class="d1">Autres sections</td><td><a href="liens.php" class="inLien">Nos liens internet</a></td>
</tr>
<tr><td></td><td><a href="mentions.php" class="inLien">Mentions légales</a></td></tr>
<tr><td></td><td><a href="contacts.php" class="inLien">Pour nous contacter</a></td></tr>
<tr><td></td><td><a href="plan.php" class="inLien">Plan de notre site</a></td></tr>
<tr><td></td><td><a href="membres.php" class="inLien">Accès des membres de VTVN</a></td></tr>
</table>
</p>
</div>
<?php
$menu_choix='plan';
include ('includes/footerUnCol.php');
?>
