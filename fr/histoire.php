<?php # script : his01.php
$titre_page='Histoire de Nyons.';
$image_entete='enteteHistoire';
$menu_item="histoire";
include ('includes/headerDeuxCol.php');
?>

<div id="gauche">
  <div class="petitHaut">Périodes</div>
  <div class="petitMilieu">
    <ul>
      <li><a href="his01.php">Antiquité</a></li>
      <li><a href="his02.php">Les invasions</a></li>
      <li><a href="his03.php">Moyen-Age</a></li>
      <li><a href="his04.php">Monarchie</a></li>
      <li><a href="his05.php">Guerre de religion</a></li>
	  <li><a href="his06.php">XIXe XXe Si&egrave;cles</a></li>
    </ul>
  </div>
  <div class="petitBas"></div>
</div>
<div id="droite">
  <div class="moyenHaut">
    <h2>Histoire de Nyons</h2>
  </div>
  <div class="moyenMilieu">
    <p>L'histoire de Nyons est riche et surprenante. La ville connue les Romains, les invasions barbares, puis les guerres de religion, avant d'entrer doucement dans le 3&egrave;me mill&eacute;naire.<br  /><br  />
	Nous vous invitons donc &agrave; parcourir notre histoire en selectionant la p&eacute;riode qui vous int&eacute;resse sur le menu de droite.
</p>
	<img src="../images/histoire/his000.jpg" alt="Vue de la chapelle Saint-R&eacute;parat" title="Vue de la chapelle Saint-R&eacute;parat" width="360" height="270" />
	<p>Au cours des pages suivantes, n'hésitez pas à cliquer sur les vignettes, pour voir un agrandissement des images et photographies.<br  /><br  />
	Pour ceux d'entre vous qui voudrait appronfondir leur soif de connaissances sur le pass&eacute; de Nyons, nous vous recommandons les ouvrages suivants :<br />
        - Nyons, m&eacute;moires de l'Aygues par Freddy Tondeur<br />
        - Pages d'histoire nyonsaise par Camille Br&eacute;chet.</p>
  </div>
  <?php
include ('includes/footerDeuxCol.php');
?>
