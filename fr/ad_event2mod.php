<?php # script : ad_event2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier un événement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

//variables
$heures =array ('06h00', '06h15', '06h30', '06h45', '07h00', '07h15', '07h30', '07h45', '08h00', '08h15', '08h30', '08h45', '09h00', '09h15', '09h30', '09h45', '10h00', '10h15', '10h30', '10h45', '11h00', '11h15', '11h30', '11h45', '12h00', '12h15', '12h30', '12h45', '13h00', '13h15', '13h30', '13h45', '14h00', '14h15', '14h30', '14h45', '15h00', '15h15', '15h30', '15h45', '16h00', '16h15', '16h30', '16h45', '17h00', '17h15', '17h30', '17h45', '18h00', '18h15', '18h30', '18h45', '19h00', '19h15', '19h30', '19h45', '20h00', '20h15', '20h30', '20h45', '21h00', '21h15', '21h30', '21h45', '22h00', '22h15', '22h30', '22h45', '23h00', '23h15', '23h30', '23h45', '24h00' );

$mois = array(1 => 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

date_default_timezone_set("Europe/Paris");
$aujourdhui=getdate();
$annee1=$aujourdhui['year'];
$annee2= $annee1+2;

$err=array();
for ($i=0; $i<=4; $i++) {
	$err[$i]=FALSE;
}
$badQuery=FALSE;

if ((isset($_GET['eventid'])) && (is_numeric($_GET['eventid']))) {
	$event_id=$_GET['eventid'];
} elseif ((isset($_POST['eventid'])) && (is_numeric($_POST['eventid']))) {
	$event_id=$_POST['eventid'];
} else {
	$badQuery=TRUE;
}

if (!$badQuery) {
	$query="SELECT v_EtabID, v_EventActif, v_EventDate, v_EventTime, v_EventNom, v_EventDesc, v_EventNomUK, v_EventDescUK FROM vsysevents WHERE v_EventID=$event_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {	
		$row=mysql_fetch_array($result,MYSQL_ASSOC);
		$v_EtabID=$row['v_EtabID'];
		$v_EventActif=$row['v_EventActif'];
		$v_EventDate=$row['v_EventDate'];
		$e_jour=date("j", strtotime($v_EventDate));
		$e_mois=date("n", strtotime($v_EventDate));
		$e_annee=date("Y", strtotime($v_EventDate));
		$v_EventTime=$row['v_EventTime'];
		$v_EventNom=stripslashes($row['v_EventNom']);
		$v_EventDesc=stripslashes($row['v_EventDesc']);
		$v_EventNomUK=stripslashes($row['v_EventNomUK']);
		$v_EventDescUK=stripslashes($row['v_EventDescUK']);
				
		//on retrouve le nom de l'établissement
		if ($v_EtabID ==0) {
			$v_EtabNom = 'V.T.V.N.';
		} else {
			$query="SELECT v_EtabNom FROM vsyscommerces WHERE v_EtabID=$v_EtabID";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
			//verifier que l'on a un resultat
			if (@mysql_num_rows($result) == 1) {	
				$row=mysql_fetch_array($result,MYSQL_ASSOC);
				$v_EtabNom=$row['v_EtabNom'];
			} else {
				$badQuery=TRUE;
			}	
		}//FIN de "	if ($v_EtabID ==0) {
	} else {
		$badQuery=TRUE;
	}
}// fin de "if (!$badQuery) {

if ($badQuery) {
	?>
		<div id="longHaut">
		<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='event';
		$lienactif=NULL;
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?>
	<p><span class="sstitre">Modifier un événement</span></p><br />
		<p>Il est impossible au systeme de récuperer les détails de l'événement à modifier. Veuillez contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //  FIN DE "if ($badQuery) {

if (isset($_POST['soumis'])) {// la forme est soumise
	
	$dbcol = FALSE;
	
	//verification de l'actif
	if ($_POST['lactif'] != $v_EventActif) {
		$e_actif=$_POST['lactif'];
		$dbcol .= " v_EventActif=$e_actif,";
	}
	
	//verification de la date choisie
	$madate=mktime(0,0,0,$_POST['lmois'],$_POST['ljour'],$_POST['lannee']);
	$today=mktime(0,0,0,$aujourdhui['mon'],$aujourdhui['mday'],$aujourdhui['year']);
	if ($madate < $today) {//mauvaise date
		$err[2]=TRUE;
		$errors[]='<p><font color="red"> - La date que vous avez selectionnée, est antérieure à aujourd\'hui.</font></p>';
	} else {
		$ladate=date('Y-m-d 23:59:59',$madate);
		if ($ladate != $v_EventDate) {
			$dbcol .= " v_EventDate='$ladate',";
		}
	}
	
	//verification de l'heure
	if ($_POST['lheure'] != $v_EventTime) {
		$e_heure=$_POST['lheure'];
		$dbcol .= " v_EventTime='$e_heure',";
	}
	
	if (isset($_POST['lnom'])) {//verification du nom
		if (trim($_POST['lnom'])!='') {//on a un nom
			$nom=escape_data(htmlentities(trim($_POST['lnom'])));//on transforme le nom pour enlever les risques de hacking
			if ($nom != $v_EventNom) {// si nom different on l'ajoute
				$dbcol .= " v_EventNom='$nom',";
			}
		} else {
			$err[0]=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de nommer votre événement.</font></p>';
		}
	} else {
		$err[0]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de nommer votre événement.</font></p>';
	}
	
	if (isset($_POST['ldescfr'])) {//verification de la description
		if (trim($_POST['ldescfr'])!='') {//on a une description
			$descfr=escape_data(htmlentities(trim($_POST['ldescfr'])));//on transforme la desc pour enlever les risques de hacking
			if ($descfr != $v_EventDesc) {
				$dbcol .= " v_EventDesc='$descfr',";
			}
		} else {
			$err[3]=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de décrire votre événement.</font></p>';
		}
	} else {
		$err[3]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de décrire votre événement.</font></p>';
	}
	
	if (isset($_POST['lnomuk'])) {//verification du nomuk
		if (trim($_POST['lnomuk'])!='') {//on a un nom
			$nomuk=escape_data(htmlentities(trim($_POST['lnomuk'])));//on transforme le nom pour enlever les risques de hacking
			if ($nomuk != $v_EventNom) {// si nom different on l'ajoute
				$dbcol .= " v_EventNomUK='$nomuk',";
			}
		} else {
			$err[1]=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de nommer votre événement en Anglais.</font></p>';
		}
	} else {
		$err[1]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de nommer votre événement en Anglais.</font></p>';
	}
	
	if (isset($_POST['ldescuk'])) {//verification de la description
		if (trim($_POST['ldescuk'])!='') {//on a une description
			$descuk=escape_data(htmlentities(trim($_POST['ldescuk'])));//on transforme la desc pour enlever les risques de hacking
			if ($descuk != $v_EventDescUK) {
				$dbcol .= " v_EventDescUK='$descuk',";
			}
		} else {
			$err[4]=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de décrire votre événement en anglais.</font></p>';
		}
	} else {
		$err[4]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de décrire votre événement en anglais.</font></p>';
	}
	
	// pas d'erreur
	if (empty($errors)) {
		if ($dbcol) {//on a des données
			//on enleve la derniere virgule
			$long=strlen($dbcol);
			$n_dbcol = substr($dbcol,0,$long-1);
			$query="UPDATE vsysevents SET $n_dbcol WHERE v_EventID=$event_id";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (!$result) {
				?>
					<div id="longHaut">
					<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
					</div>
					<div id="longMilieu">
				<?php	
					$header='event';
					$lienactif=NULL;
					include('./includes/admin.php'); 
					echo'<div id="mainMemb">';
				?>
				<p><span class="sstitre">Modifier un événement</span></p><br />	
				<p>Les données n'ont pas pu être modifiées. Veuillez contacter l'administrateur du serveur.</p>
				</div>
				<?php
					print_ligne(12);
					$menu_choix =NULL;
					include ('./includes/footerUnCol.php');
					exit();
			} else {
				?>
					<div id="longHaut">
					<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
					</div>
					<div id="longMilieu">
				<?php	
					$header='event';
					$lienactif=NULL;
					include('./includes/admin.php'); 
					echo'<div id="mainMemb">';
				?>
				<p><span class="sstitre">Modifier un événement</span></p><br />	
				<p>Les modifications ont été enregistrées dans la base de données. </p>
				</div>
				<?php
					print_ligne(12);
					$menu_choix =NULL;
					include ('./includes/footerUnCol.php');
					exit();
			}// fin de "if (!$result) {
			
		} else { //aucun changement
			?>
				<div id="longHaut">
				<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
				</div>
				<div id="longMilieu">
			<?php	
				$header='event';
				$lienactif=NULL;
				include('./includes/admin.php'); 
				echo'<div id="mainMemb">';
			?>
			<p><span class="sstitre">Modifier un événement</span></p><br />	
			<p>Aucun changement n'a été enregistré dans la base de données. </p>
			</div>
			<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		} // fin de "if ($dbcol && $dbval)
		
	} // fin de "if (empty($errors)) {
	
} // fin de "if (isset($_POST['soumis'])) {

?>
	<div id="longHaut">
	<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
	</div>
	<div id="longMilieu">
<?php	
	$header='event';
	$lienactif='event2';
	include('./includes/admin.php'); 
	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Modifier un événement</span></p><br />	
<p>Modifier les détails de l'événement choisi.</p><br />
<?php
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	}
?>
<fieldset><legend>Détails de l'événement : </legend>
<br />
<table width="100%" border="0" cellpadding="5">
<form action="ad_event2mod.php" method="post">
<input type="hidden" name="eventid" value="<?php echo $event_id; ?>" />
<?php
	//organisateur
	echo '<tr><td width="40%" align="left" class="photo">Organisateur :</td><td width="60%" align="left"><input type="text" disabled="disabled" value="' . $v_EtabNom . '" size="35" /></td></tr>';
	echo "\n";
	
	//nom
	echo '<tr><td class="photo">';
	if ($err[0]) {
		echo '<font color="red">Nom :</font>';
	} else {
		echo 'Nom :';
	}
	echo "</td>\n";
	echo '<td><input name="lnom" size="35" maxlength="50" value="';
	if (isset($_POST['lnom'])) {
		echo $_POST['lnom'];
	} else {
		echo $v_EventNom;
	}
	echo "\" /></td></tr>\n";
	
	//nom anglais
	echo '<tr><td class="photo">';
	if ($err[1]) {
		echo '<font color="red">Nom anglais:</font>';
	} else {
		echo 'Nom anglais:';
	}
	echo "</td>\n";
	echo '<td><input name="lnomuk" size="35" maxlength="50" value="';
	if (isset($_POST['lnomuk'])) {
		echo $_POST['lnomuk'];
	} else {
		echo $v_EventNomUK;
	}
	echo "\" /></td></tr>\n";
	
	//date
	echo '<tr><td class="photo">';
	if ($err[2]) {
		echo '<font color="red">Date :</font>';
	} else {
		echo 'Date :';
	}
	echo "</td>\n";
	echo "<td>\n";
	//jour
	echo '<select name="ljour">';
	echo "\n";
	for ($i=1; $i<=31; $i++) {
		echo '<option value="' . $i . '"';
		if (isset($_POST['ljour'])) {
			if ($_POST['ljour'] == $i) {
				echo ' selected="selected"';
			}
		} elseif ($i == $e_jour) {
			echo ' selected="selected"';
		}
		echo ">$i</option>\n";
	}
	echo "</select>\n ";
	//mois
	echo '<select name="lmois">';
	echo "\n";
	foreach ($mois as $key => $value) {
		echo '<option value="' . $key . '"';
		if (isset($_POST['lmois'])) {
			if ($_POST['lmois'] == $key) {
				echo ' selected="selected"';
			}
		} elseif ($key == $e_mois) {
			echo ' selected="selected"';
		}
		echo ">$value</option>\n";
	}
	echo "</select>\n ";
	// année
	echo '<select name="lannee">';
	echo "\n";
	for ($i=$annee1; $i<=$annee2; $i++) {
		echo '<option value="' . $i . '"';
		if (isset($_POST['lannee'])) {
			if ($_POST['lannee'] == $i) {
				echo ' selected="selected"';
			}
		} elseif ($i == $e_annee) {
			echo ' selected="selected"';
		}
		echo ">$i</option>\n";
	} 
	echo "</select>\n</td></tr>\n";
	
	// heure
	echo '<tr><td class="photo">A partir de :</td>';
	echo "\n";
	echo '<td><select name="lheure">';
	foreach ($heures as $value) {
		echo "<option value=\"$value\"";
		if (isset($_POST['lheure'])) {
			if ($_POST['lheure'] == $value) {
				echo ' selected="selected"';
			}
		} elseif ($v_EventTime == $value) {
			echo ' selected="selected"';
		}
		echo ">$value</option>\n";
	}
	echo "</select>\n</td>\n</tr>\n";
	
	// actif
	echo '<tr><td class="photo">Evénement actif :</td><td><select name="lactif">';
	echo "\n";
	if (isset($_POST['lactif'])) {
		if ($_POST['actif'] == 0) {
			echo '<option value="0" selected="selected">Evénement non actif</option>';
			echo "\n";
			echo '<option value="1">Evénement activé</option>';
			echo "\n";
		} else {
			echo '<option value="0">Evénement non actif</option>';
			echo "\n";
			echo '<option value="1" selected="selected">Evénement activé</option>';
			echo "\n";
		}
	} elseif ($v_EventActif == 0) {
		echo '<option value="0" selected="selected">Evénement non actif</option>';
		echo "\n";
		echo '<option value="1">Evénement activé</option>';
		echo "\n";
	} else {
		echo '<option value="0">Evénement non actif</option>';
		echo "\n";
		echo '<option value="1" selected="selected">Evénement activé</option>';
		echo "\n";
	}
	
	//description
	echo '<tr><td colspan="2" class="photo">';
	if ($err[3]) {
		echo '<font color="red">Description de l\'événement :</font>';
	} else {
		echo 'Description de l\'événement :';
	}
	echo "</td></tr>\n";
	echo '<tr><td colspan="2"><textarea cols="50" rows="5" name="ldescfr">';
	if (isset($_POST['ldescfr'])) {
		echo $_POST['ldescfr'];
	} else {
		echo $v_EventDesc;
	}
	echo "</textarea>\n</td></tr>\n";
	
	//description
	echo '<tr><td colspan="2" class="photo">';
	if ($err[4]) {
		echo '<font color="red">Description de l\'événement en anglais:</font>';
	} else {
		echo 'Description de l\'événement en anglais :';
	}
	echo "</td></tr>\n";
	echo '<tr><td colspan="2"><textarea cols="50" rows="5" name="ldescuk">';
	if (isset($_POST['ldescuk'])) {
		echo $_POST['ldescuk'];
	} else {
		echo $v_EventDescUK;
	}
	echo "</textarea>\n</td></tr>\n";
?>
<input type="hidden" name="soumis" value="TRUE" />
<tr><td colspan="2" align="center">
<input type="submit" name="submit" value="Modifier les détails de l'événement" />
</td></td>
</form>
</table>
</fieldset>
</div>
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
