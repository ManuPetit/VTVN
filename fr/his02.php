<?php # script : his02.php
$titre_page='Histoire : Les invasions.';
$image_entete='enteteHistoire';
$menu_item="histoire";
include ('includes/headerDeuxColv2.php');
?>

<div id="gauche">
  <div class="petitHaut">Périodes</div>
  <div class="petitMilieu">
    <ul>
      <li><a href="his01.php">Antiquité</a></li>
      <li><a class="choix">Les invasions</a></li>
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
    <h2>Les invasions</h2>
  </div>
  <div class="moyenMilieu">
    <p>En 406, les invasions barbares de tribus Germaniques annon&ccedil;aient  le d&eacute;clin de l&rsquo;empire Romain. Plusieurs villages furent mis &agrave; feu et &agrave;  sang&nbsp;: St Paul Trois Ch&acirc;teaux, Nyons, Vaison. </p>
    <img src="../images/histoire/his002.jpg" alt="dessin de cavalier Burgonde" title="dessin de cavalier Burgonde" width="91" height="183" />
    <p>Apr&egrave;s les Vandales, ce fut  les Burgondes (ou Bourguignons) qui arriv&egrave;rent et eurent la permission de  s&rsquo;installer dans les terres situ&eacute;es entre le Rh&ocirc;ne, les Alpes et la Durance.<br />
      Peuple d&rsquo;agriculteurs, ils s&rsquo;int&eacute;gr&egrave;rent tr&egrave;s bien avec la  population locale, et donn&egrave;rent un nouvel essor &agrave; Nyons.<br />
      Au VIe si&egrave;cle, 4 autres invasions vinrent troubl&eacute;e la vie  des Nyonsais.<br  />
      <br  />
      Vers 520, l&rsquo;abbaye ligure &agrave; Saint May&nbsp;et la colonie des  religieuses de l&rsquo;&eacute;v&ecirc;que d&rsquo;Arles, C&eacute;saire, furent fond&eacute;es. </p>
    <img class="liens" src="../images/histoire/his003.jpg" alt="Vignette cliquable de Saint C&eacute;saire" title="Vignette cliquable de Saint C&eacute;saire" width="100" height="75" onclick="window.open('vue/saintcesaire.php','saintcesaire','top=0,left=0,width=680,height=610,toolbar=no,menubar=no,location=no,directories=no');window.event.cancelBubble=true;window.event.returnValue=false;"  />
    <p>Les barbares se  convertirent alors au Christianisme, une soci&eacute;t&eacute; nouvelle &eacute;tait cr&eacute;&eacute;e. Une paix  durable s&rsquo;installa sur la r&eacute;gion jusqu&rsquo;en 734, o&ugrave; les Sarrasins envahirent la  r&eacute;gion. Apr&egrave;s en &ecirc;tre chass&eacute;, ils revinrent en 840 semant la terreur, le sang  et r&eacute;duisant la Provence &agrave; l&rsquo;&eacute;tat de d&eacute;sert. C&rsquo;est 973 que Guillaume Ier, Comte  de Provence, d&eacute;livra la r&eacute;gion de ces envahisseurs.</p>
  </div>
  <?php
include ('includes/footerDeuxCol.php');
?>
