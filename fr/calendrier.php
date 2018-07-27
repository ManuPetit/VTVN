<?php # script : calendrier.php
$titre_page='Ev&eacute;nements.';
$image_entete='enteteCalendrier';
$menu_item="calendrier";
include ('includes/headerDeuxCol.php');
//connection to db
require_once('../../vtvn_connection.php');
//inclure les functions de database
require_once('./includes/db.inc.php');
require_once('./includes/config.inc.php');


date_default_timezone_set("Europe/Paris");
$aujourdhui=getdate();
$annee1=$aujourdhui['year'];
$today=mktime(0,0,0,$aujourdhui['mon'],$aujourdhui['mday'],$aujourdhui['year']);
$cejour=date('Y-m-d 0:00:01',$today);
$lastdate=mktime(23,59,59,12,31,$annee1);
$derday=date('Y-m-d 23:59:59',$lastdate);

?>
	<div id="gauche">
  <div class="petitHaut">Evénements</div>
  <div class="petitMilieu">
    <ul>
      <li><a class="choix">Calendrier</a></li>
      <li><a href="cal01.php?galid=0">Galeries photos</a></li>
    </ul>
  </div>
  <div class="petitBas"></div>
</div>
<div id="droite">
  <div class="moyenHaut">
    <h2>Le Calendrier <?php echo $annee1; ?></h2>
  </div>
  <div class="moyenMilieu">
  
<?php
	// evenment VTVN
	$query="SELECT v_EventNom, v_EventDesc, v_EventDate, v_EventTime FROM vsysevents WHERE v_EventActif=1 AND ((v_EventDate>='$cejour') AND (v_EventDate<='$derday')) AND v_EtabID=0 ORDER BY v_EventDate ASC";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) >= 1) {
		//creataion de la table de presentation
		echo '<table class="descrip" width="90%" border="0" cellpading="5">';
		echo '<tr><td width="20%"></td><td width="25%"></td><td width="55%"></td></tr>';
		echo "\n";
		while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
			echo '<tr><td width="45%" align="left" colspan="2" class="d1">';
			echo my_date_handler($row['v_EventDate'],4) . ':';
			echo "</td>\n";
			echo '<td width="55%" align="left" class="d2">';
			echo stripslashes($row['v_EventNom']);
			echo "</td>\n</tr>\n";
			echo '<tr><td width="20%" align="left" class="d3"></td>';
			echo "\n";
			echo '<td width="80%" colspan="2" align="left" class="d3">';
			echo stripslashes($row['v_EventDesc']) . '<br />A partir de ' . $row['v_EventTime'] . '<br /><br />';
			echo "</td>\n</tr>\n";
		}
		echo "</table>\n";
	} else {
		echo '<p>Il n\'y a aucun événement prévu pour le moment par l\'association V.T.V.N';
	}
	echo '</div><div class="moyenBas"></div>';
	echo "\n";
	//evenement organisé par les commercants
	echo '<div class="moyenHaut"><h2>Le calendrier de vos commerçants</h2></div><div class="moyenMilieu">';
	$query="SELECT DISTINCT vsysevents.v_EtabID, v_EtabNom FROM vsysevents INNER JOIN vsyscommerces ON vsysevents.v_EtabID=vsyscommerces.v_EtabID WHERE v_EventActif=1 AND ((v_EventDate>='$cejour') AND (v_EventDate<='$derday')) AND vsysevents.v_EtabID!=0 ORDER BY v_EtabNom ASC";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	if (@mysql_num_rows($result) >= 1) {//on retrouve tous les etablissements
		$v_EtabID=array();
		$v_EtabNom=array();
		while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
			$v_EtabID[]=$row['v_EtabID'];
			$v_EtabNom[]=$row['v_EtabNom'];
		}
		$count=count($v_EtabID)-1;
		for ($i=0; $i<=$count; $i++) {
			//on retrouve les evenements
			$query="SELECT v_EventNom, v_EventDesc, v_EventDate, v_EventTime FROM vsysevents WHERE v_EventActif=1 AND ((v_EventDate>='$cejour') AND (v_EventDate<='$derday')) AND v_EtabID={$v_EtabID[$i]} ORDER BY v_EventDate ASC";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (@mysql_num_rows($result) >= 1) {
				//creataion de la table de presentation
				echo '<table class="descrip" width="90%" border="0" cellpading="5">';
				echo '<tr><td width="20%"></td><td width="25%"></td><td width="55%"></td></tr>';
				echo '<tr><td colspan="3" class="d4" align="left">';
				echo "<b>{$v_EtabNom[$i]}</b> vous propose :</td>\n</tr>\n";
				while ($nrow=mysql_fetch_array($result,MYSQL_ASSOC)) {
					echo '<tr><td width="45%" align="left" colspan="2" class="d1">';
					echo my_date_handler($nrow['v_EventDate'],4) . ':';
					echo "</td>\n";
					echo '<td width="55%" align="left" class="d2">';
					echo stripslashes($nrow['v_EventNom']);
					echo "</td>\n</tr>\n";
					echo '<tr><td width="20%" align="left" class="d3"></td>';
					echo "\n";
					echo '<td width="80%" colspan="2" align="left" class="d3">';
					echo stripslashes($nrow['v_EventDesc']) . '<br />A partir de ' . $nrow['v_EventTime'] . '<br /><br />';
					echo "</td>\n</tr>\n";
				}
				echo "</table>\n";
			} else {
				echo '<p>Il n\'y a aucun événement prévu par les commerçants du vieux Nyons pour le moment.';
			}
			
		}// fin de for ($i=0; $i<=$count; $i++) {
		
	} else {
		echo '<p>Il n\'y a aucun événement prévu par les commerçants du vieux Nyons pour le moment.';
	} //fin de  de "if (@mysql_num_rows($result) >= 1) {//on retrouve tous les etablissements
			
	
?>
  </div>
  <?php
$menu_choix =NULL;
include ('includes/footerDeuxCol.php');
?>