<?php # script : archives.php
$titre_page='Les archives du site.';
$image_entete='enteteArchive';
$menu_item="archives";
include ('includes/headerDeuxCol.php');
?>

<div id="gauche">
  <div class="petitHaut">Archives</div>
  <div class="petitMilieu">
    <ul>
      <li><a href="arch01_00.php">Carnaval</a></li>
      <li><a href="arch02_00.php">Hephaïstos</a></li>
      <li><a href="arch03_00.php">Historique VTVN</a></li>
      <li><a href="arch04_00.php">Marché Floral</a></li>      <li><a href="arch05_00.php">Mardi-gras</a></li>
    </ul>
  </div>
  <div class="petitBas"></div>
</div>
<div id="droite">
  <div class="moyenHaut">
    <h2>Les documents d'archives</h2>
  </div>
  <div class="moyenMilieu">
    <p>Depuis sa cr&eacute;ation en 1984, l'association V.T.V.N. a souvent &eacute;t&eacute; relay&eacute;e par les journaux locaux.<br /><br />
    Nous vous proposons ici une s&eacute;lection de ces articles, class&eacute;s par th&egrave;mes.</p>
      <img src="../images/archives/imgArchives.gif" alt="photo montage sur les archives" width="281" height="300" title="photo montage sur les archives"/>
	  <p>Vous trouverez aussi d'anciennes photos des activit&eacute;s et manifestations organis&eacute;es par l'association au cours de ces derni&egrave;res ann&eacute;es.<br /><br />
      D'autres documents viendront bient&ocirc;t enrichir ces archives de l'association.</p>
  </div>
  <?php
include ('includes/footerDeuxCol.php');
?>
