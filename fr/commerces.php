<?php # script : accueil.php
$titre_page='Nos commerces.';
$image_entete='enteteCommerce';
$menu_item="commerces";
include ('includes/headerDeuxCol.php');
//connection to db
require_once('../../vtvn_connection.php');
//inclure les functions de database
require_once('./includes/db.inc.php');
require_once('./includes/config.inc.php');


$query="SELECT v_ComNom, v_ComTypeID FROM vsyscommercetype WHERE v_ComActive=1 ORDER BY v_ComNom ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	echo '<div id="gauche"><div class="petitHaut">Commerces</div><div class="petitMilieu">';
	echo "<ul>\n";
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		echo '<li><a href="noscom.php?typid=' . $row['v_ComTypeID'] . '&comid=0">';
		echo $row['v_ComNom'] . "</a></li>\n";
	}
	echo "</ul>\n</div>";
	echo '<div class="petitBas"></div>';
}

?>
    </div>
    <div id="droite">
      <div class="moyenHaut"><h2>Nos commerces</h2></div>
      <div class="moyenMilieu">
        <p>La vieille ville de Nyons est un endroit idéal pour chiner, tout en se promenant.<br />
Au gré de votre ballade, vous découvrirez des artisans habiles, de curieuses échoppes, des magasins de mode, mais aussi plusieurs commerces et services de proximité.<br  />
Le quartier est également réputé pour ses nombreux lieux de détente : bars, restaurants et autres discothèques.<br />
Utilisez le menu de droite pour partir à la découverte de nos commerçants, qui se feront toujours un plaisir de vous accuillir.

</p>
</div>
<?php
$menu_choix =NULL;
include ('includes/footerDeuxCol.php');
?>
