<?php # script : accueil.php
$titre_page='Bienvenue sur le site du vieux nyons.';
$image_entete='enteteAccueil';
$menu_item="accueil";
include ('includes/headerDeuxCol.php');
?>

<div id="gauche">
  <div class="petitHaut">Accueil</div>
  <div class="petitMilieu">
    <ul>
      <li><a class="choix">Pr&eacute;sentation</a></li>
      <li><a href="acc02.php">M&eacute;di&eacute;vales du Pontias</a></li>
      <li><a href="acc01.php">Qui sommes-nous ?</a></li>
    </ul>
  </div>
  <div class="petitBas"></div>
</div>
<div id="droite">
  <div class="moyenHaut">
    <h2>Bienvenue</h2>
  </div>
  <div class="moyenMilieu">
    <p>Bienvenue sur le site vieuxnyons.com qui vous est propos&eacute; par les commer&ccedil;ants de l'association &quot;Vie et travail dans le Vieux Nyons&quot;.<br /><br />
     Au fil des pages, vous pourrez d&eacute;couvrir les <a class="inLien" href="calendrier.php">activit&eacute;s d'animations</a> de notre quartier du Vieux Nyons.<br /><br />
     L'association est &eacute;galement l'organisateur des <a class="inLien" href="acc02.php">F&ecirc;tes M&eacute;di&eacute;vales du Pontias</a> qui font revivre nos rues au temps du Moyen-Age.</p>
      <img src="../images/accueil/nyons01.jpg" alt="Vue de la ville de Nyons" width="400" height="300" title="Vue de la ville de Nyons"/>
	  <p>Retrouvez &eacute;galement <a class="inLien" href="commerces.php">vos commer&ccedil;ants</a>, et retournez dans <a class="inLien" href="histoire.php">le pass&eacute; de notre ville</a> sur nos pages historiques.<br /><br />
      N'h&eacute;sitez pas &agrave; nous faire parvenir vos commentaires sur le site, et sur notre quartier par courriel &agrave; <a class="inLien" href="mailto:info@vieuxnyons.com">vieuxnyons.com</a>. <br /><br />
      Nous vous souhaitons une bonne ballade dans notre vieux Nyons.</p><br  />
      <p class="t3">Toute l'&eacute;quipe de l'association VTVN.</p>
  </div>
  <?php
include ('includes/footerDeuxCol.php');
?>
