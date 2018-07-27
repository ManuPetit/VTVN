<?php  # script - noscom.php

//Output buffering
ob_start();
//debut de session
session_start();
//connection to db
require_once('../../vtvn_connection.php');
//inclure les functions de database
require_once('./includes/db.inc.php');
require_once('./includes/config.inc.php');

$badQuery=FALSE;
//verifier les valeurs
if ((isset($_GET['typid'])) && (is_numeric($_GET['typid']))) {
	$type_id=$_GET['typid'];
} else {
	$badQuery=TRUE;
}
if ((isset($_GET['comid'])) && (is_numeric($_GET['comid']))) {
	$com_id=$_GET['comid'];
} else {
	$badQuery=TRUE;
}
if (!$badQuery) {
	//on retrouve le type de commerce
	$query="SELECT v_ComNom FROM vsyscommercetype WHERE v_ComTypeID=$type_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_ASSOC);
		$entetetype=$row['v_ComNom'];
	}
	//verifier que le commerce ID n'est pas egal à zero
	if ($com_id != 0) {
		$query="SELECT v_EtabNom FROM vsyscommerces WHERE v_EtabID=$com_id";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		//verifier que l'on a un resultat
		if (@mysql_num_rows($result) == 1) {
			$row=mysql_fetch_array($result,MYSQL_ASSOC);
			$entete=$row['v_EtabNom'];
			$titre_page="$entete sur vieuxnyons.com";
			$image_entete='enteteCom' . $com_id;
			$menu_item="commerces";
		}
	} else {
		//ce n'est pas un commerce mais une categorie
		$titre_page="Nos commerces : $entetetype";
		$image_entete='enteteTyp' . $type_id;
		$menu_item="commerces";
	}// fin de "if ($com_id != 0) {
	
	include ('includes/headerDeuxColssBuf.php');
	echo '<div id="gauche">';
	//on retrouve les differents etablissements
	$query="SELECT v_EtabNom, v_EtabID FROM vsyscommerces WHERE v_EtabActive=1 AND v_ComTypeID=$type_id ORDER BY v_EtabNom ASC";	
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) >= 1) {
		echo '<div class="petitHaut">' . $entetetype . '</div><div class="petitMilieu">';
		echo "\n<ul>\n";
		while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
			echo '<li><a ';
			if ($com_id != $row['v_EtabID']) {
				echo 'href="noscom.php?typid=' . $type_id . '&comid=' . $row['v_EtabID'] . '"';
			} else {
				echo ' class="choix"';
			}
			echo ">" . $row['v_EtabNom'] . "</a></li>\n";
		}
		echo "</ul>\n</div>";
		echo '<div class="petitBas"></div>';
	}
		
	$query="SELECT v_ComNom, v_ComTypeID FROM vsyscommercetype WHERE v_ComActive=1 ORDER BY v_ComNom ASC";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) >= 1) {
		echo '<div class="petitHaut">Commerces</div><div class="petitMilieu">';
		echo "<ul>\n";
		while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
			echo '<li><a ';
			if ($row['v_ComTypeID'] != $type_id) {
				echo ' href="noscom.php?typid=' . $row['v_ComTypeID'] . '&comid=0"';
			} else {
				echo ' class="choix"';
			}
			echo ">" . $row['v_ComNom'] . "</a></li>\n";
		}
		echo "</ul>\n</div>";
		echo '<div class="petitBas"></div>';
	}
	echo '</div>
    <div id="droite">';
	
	if ($com_id == 0) {
		switch ($type_id) {
			case 1:
				//alimentation
				include ('pre_aliment.php');
				break;
			case 2:
				//art et decoration
				include ('pre_art.php');
				break;
			case 3:
				//divers
				include ('pre_divers.php');
				break;
			case 4:
				//mode et beauté
				include ('pre_mode.php');
				break;
			case 5:
				//services
				include ('pre_servi.php');
				break;
			case 6:
				//sortir
				include ('pre_sortir.php');
				break;
		}
	} else { //on a un commerce
		//on retrouve tous les details
		$query="SELECT v_EtabNom, v_EtabNumero, v_EtabPhone, v_EtabFax, v_EtabMobile, v_HoraireOnMatin, v_HoraireOffMatin, v_HoraireOnSoir, v_HoraireOffSoir, v_EtabFerme, v_EtabResponsable1, v_EtabResponsable2, v_EtabActivite, v_EtabURL, v_EtabEmail, v_EtabFileNom, v_RueNom FROM vsyscommerces INNER JOIN vsysrues on vsyscommerces.v_RueID=vsysrues.v_RueID WHERE v_EtabID=$com_id";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		//verifier que l'on a un resultat
		if (@mysql_num_rows($result) == 1) {
			$row=mysql_fetch_array($result,MYSQL_ASSOC);
			$v_EtabFileNom=$row['v_EtabFileNom'];
			$v_EtabNom=$row['v_EtabNom'];
			echo '<div class="moyenHaut"><h2>' . $row['v_EtabNom'] . '</h2></div>
			<div class="moyenMilieu"><br />';
			echo "\n";
			echo '<table width="90%" border="0" cellpadding="5" class="commer">';
			echo "\n";
			echo '<tr><td width="35%" align="left" class="d1">Adresse :</td>';
			echo '<td width="65%" align="left" class="d3">' . $row['v_EtabNumero'] . ' ' . $row['v_RueNom'] . '<br />26110 Nyons</td></tr>';
			echo "\n";
			if ((trim($row['v_EtabPhone'])) != '') {
				echo '<tr><td align="left" class="d1">Téléphone :</td>';
				echo '<td align="left" class="d3">' . $row['v_EtabPhone'] . '</td></tr>';
				echo "\n";
			}
			if ((trim($row['v_EtabFax'])) != '') {
				echo '<tr><td align="left" class="d1">Fax :</td>';
				echo '<td align="left" class="d3">' . $row['v_EtabFax'] . '</td></tr>';
				echo "\n";
			}
			if ((trim($row['v_EtabMobile'])) != '') {
				echo '<tr><td align="left" class="d1">Mobile :</td>';
				echo '<td align="left" class="d3">' . $row['v_EtabMobile'] . '</td></tr>';
				echo "\n";
			}
			echo '<tr><td align="left" class="d1">Horaires :</td>';
			echo '<td class="d3" align="left"';
			if ((trim($row['v_HoraireOnSoir'])) !='') {
				echo '>De ' . $row['v_HoraireOnMatin'] . ' à ' . $row['v_HoraireOffMatin'];
				echo '<br />et de ' . $row['v_HoraireOnSoir'] . ' à ' . $row['v_HoraireOffSoir'] . '</td></tr>';
				echo "\n";
			} else {
				echo '>De ' . $row['v_HoraireOnMatin'] . ' à ' . $row['v_HoraireOffMatin'] . '</td></tr>';
			}
			echo "\n";
			//jour de fermeture
			echo '<tr><td align="left" class="d1">Fermeture :</td>';
			echo '<td class="d3" align="left">';
			$jferme=edit_fermeture($row['v_EtabFerme'],'fr');
			echo $jferme . "</td>\n</tr>\n";
			//activite
			echo '<tr><td align="left" class="d1">Activité :</td>';
			echo '<td class="d3" align="left">';
			echo $row['v_EtabActivite'] . "</td>\n</tr>\n";
			//responsables
			echo '<tr><td align="left" class="d1">Responsable';
			if ((trim($row['v_EtabResponsable2'])) != '') {
				echo 's';
			}
			echo ' :</td><td class="d3" align="left">';
			echo $row['v_EtabResponsable1'];
			if ((trim($row['v_EtabResponsable2'])) != '') {
				echo '<br />' . $row['v_EtabResponsable2'];
			}
			echo "</td></tr>\n";
			//internet
			if ((trim($row['v_EtabURL'])) != '') {
				echo '<tr><td align="left" class="d1">Site internet :</td>';
				echo '<td align="left" class="d3"><a href="http://' . $row['v_EtabURL'] . '" target="_new" class="inLien">' . $row['v_EtabURL'] . '</a></td></tr>';
				echo "\n";
			}
			//email
			if ((trim($row['v_EtabEmail'])) != '') {
				echo '<tr><td align="left" class="d1">Courriel :</td>';
				echo '<td align="left" class="d3"><a href="mailto:' . $row['v_EtabEmail'] . '" target="_new" class="inLien">' . $row['v_EtabEmail'] . '</a></td></tr>';
				echo "\n";
			}
			echo "</table>\n";
			echo '</div><div class="moyenBas"></div>';
			//fin des données générales
			//nouvelle requete
			$query="SELECT v_DetailType, v_Details FROM vsyscomdetails WHERE v_EtabID=$com_id AND (v_DetailType=1 OR v_DetailType=2 OR v_DetailType=3 or v_DetailType=4 or v_DetailType=5) ORDER BY v_DetailType ASC";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			//verifier que l'on a un resultat
			if (@mysql_num_rows($result) >= 1) {
				echo '<div class="moyenHaut"><h2>Présentation</h2></div>
				<div class="moyenMilieu"><br />';
				$detail=array();
				while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
					$detail[]=$row['v_Details'];
				}
				echo '<p>' . stripslashes($detail[2]) . '</p>';
				if ((trim($detail[0])) != '') {
					$file="../images/$v_EtabFileNom/{$detail[0]}";
					$photo=getimagesize($file);
					echo '<img src="' . $file . '" title="' . $v_EtabNom . ' : première photo" alt="' . $v_EtabNom . ' : première photo" ' . $photo[3] . ' />';
				}
				echo '<p>' . stripslashes($detail[3]) . '</p>';
				if ((trim($detail[1])) != '') {
					$file="../images/$v_EtabFileNom/{$detail[1]}";
					$photo=getimagesize($file);
					echo '<img src="' . $file . '" title="' . $v_EtabNom . ' : première photo" alt="' . $v_EtabNom . ' : deuxième photo" ' . $photo[3] . ' />';
				}
				echo '<p>' . stripslashes($detail[4]) . '</p>';
				echo '</div><div class="moyenBas"></div>';
				
			} //fin de "if (@mysql_num_rows($result) >= 1)
		} //fin de "if (@mysql_num_rows($result) == 1) {
	} //fin de if ($com_id == 0) {
	echo '</div>';			
	echo $menu_choix =NULL;
	include ('./includes/footerUnCol.php');
}// fin de "if (!$badQuery) {
?>		
			
			
			
			
			
				
			

			
			
		