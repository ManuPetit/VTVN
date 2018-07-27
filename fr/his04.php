<?php # script : his02.php
$titre_page='Histoire : La Monarchie.';
$image_entete='enteteHistoire';
$menu_item="histoire";
include ('includes/headerDeuxColv2.php');
?>

<div id="gauche">
  <div class="petitHaut">Périodes</div>
  <div class="petitMilieu">
    <ul>
      <li><a href="his01.php">Antiquité</a></li>
      <li><a href="his02.php">Les invasions</a></li>
      <li><a href="his03.php">Moyen-Age</a></li>
      <li><a class="choix">Monarchie</a></li>
      <li><a href="his05.php">Guerre de religion</a></li>
      <li><a href="his06.php">XIXe XXe Si&egrave;cles</a></li>
    </ul>
  </div>
  <div class="petitBas"></div>
</div>
<div id="droite">
  <div class="moyenHaut">
    <h2>La Monarchie</h2>
  </div>
  <div class="moyenMilieu">
    <p>En 1349, le Dauphin&eacute; devint propri&eacute;t&eacute; de la couronne de  France. Une nouvelle &egrave;re commen&ccedil;a pour Nyons. <br />
	La construction du pont sur l&rsquo;Eygues fut entreprise vers  1390.</p>
    <img class="liens" src="../images/histoire/his007.jpg" alt="Vignette cliquable du Pont Roman" title="Vignette cliquable du Pont Roman" width="100" height="68" onclick="window.open('vue/pont.php','pont','top=0,left=0,width=520,height=475,toolbar=no,menubar=no,location=no,directories=no');window.event.cancelBubble=true;window.event.returnValue=false;"   />
    <p>C&rsquo;est vers cette &eacute;poque, que la peste d&eacute;ferla sur la r&eacute;gion due  &agrave; l&rsquo;absence d&rsquo;hygi&egrave;ne de la population. Mais ce furent les juifs qui allaient  &ecirc;tre consid&eacute;r&eacute;s comme coupables et accus&eacute;s d'avoir empoisonn&eacute; les puits et  fontaines. <br />

        Ces juifs faisaient beaucoup de commerce &agrave; Nyons, et on les  enfermait la nuit dans un ghetto situ&eacute; rue de la Libert&eacute;, rue Juiverie et place  aux Herbes. Ceux qui ne parvinrent pas &agrave; s&rsquo;enfuir, furent massacr&eacute;s par la  population. Sans eux, la peste f&icirc;t n&eacute;anmoins son retour, vers 1630&hellip;.<br  /><br  />
Vivant maintenant sous le r&eacute;gime monarchique, les Nyonsais  avaient de plus en plus de mal &agrave; faire respecter leurs privil&egrave;ges. </p>
    <img class="liens" src="../images/histoire/his008.jpg" alt="Vignette cliquable de la citadelle de Nyons" title="Vignette cliquable de la citadelle de Nyons" width="100" height="74" onclick="window.open('vue/citadelle.php','citadelle','top=0,left=0,width=520,height=500,toolbar=no,menubar=no,location=no,directories=no');window.event.cancelBubble=true;window.event.returnValue=false;"   />
    <p>En 1612, le  gouverneur de Nyons racheta les privil&egrave;ges des Nyonsais, et fut en lutte permanente  avec les habitants. Il fit construire la citadelle sur les hauteurs de la rive  gauche de l&rsquo;Eygues en 1587, qui fut d&eacute;moli sous l&rsquo;ordre de louis XIII en 1633.</p>	

  </div>
  <?php
include ('includes/footerDeuxCol.php');
?>
