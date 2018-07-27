<?php # script : ad_event1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Créer un événement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$heures =array ('06h00', '06h15', '06h30', '06h45', '07h00', '07h15', '07h30', '07h45', '08h00', '08h15', '08h30', '08h45', '09h00', '09h15', '09h30', '09h45', '10h00', '10h15', '10h30', '10h45', '11h00', '11h15', '11h30', '11h45', '12h00', '12h15', '12h30', '12h45', '13h00', '13h15', '13h30', '13h45', '14h00', '14h15', '14h30', '14h45', '15h00', '15h15', '15h30', '15h45', '16h00', '16h15', '16h30', '16h45', '17h00', '17h15', '17h30', '17h45', '18h00', '18h15', '18h30', '18h45', '19h00', '19h15', '19h30', '19h45', '20h00', '20h15', '20h30', '20h45', '21h00', '21h15', '21h30', '21h45', '22h00', '22h15', '22h30', '22h45', '23h00', '23h15', '23h30', '23h45', '24h00' );

$mois = array(1 => 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

date_default_timezone_set("Europe/Paris");
$aujourdhui=getdate();
$annee1=$aujourdhui['year'];
$annee2= $annee1+2;
$errors = array();
$err=array();
for ($i=0; $i<=4; $i++) {
	$err[$i]=FALSE;
}

if (isset($_POST['soumis'])) {

	if (isset($_POST['lnom'])) {//verification du nom
		if (trim($_POST['lnom'])!='') {//on a un nom
			$nom=escape_data(htmlentities(trim($_POST['lnom'])));//on transforme le nom pour enlever les risques de hacking
		} else {
			$err[0]=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de nommer votre événement.</font></p>';
		}
	} else {
		$err[0]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de nommer votre événement.</font></p>';
	}
	
	if (isset($_POST['lnomuk'])) {//verification du nomuk
		if (trim($_POST['lnomuk'])!='') {//on a un nom
			$nomuk=escape_data(htmlentities(trim($_POST['lnomuk'])));//on transforme le nom pour enlever les risques de hacking
		} else {
			$err[1]=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de nommer votre événement en Anglais.</font></p>';
		}
	} else {
		$err[1]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de nommer votre événement en Anglais.</font></p>';
	}
	
	//verification de la date choisie
	$madate=mktime(0,0,0,$_POST['lmois'],$_POST['ljour'],$_POST['lannee']);
	$today=mktime(0,0,0,$aujourdhui['mon'],$aujourdhui['mday'],$aujourdhui['year']);
	if ($madate < $today) {//mauvaise date
		$err[2]=TRUE;
		$errors[]='<p><font color="red"> - La date que vous avez selectionnée, est antérieure à aujourd\'hui.</font></p>';
	} else {
		$ladate=date('Y-m-d 23:59:59',$madate);
	}

	if (isset($_POST['descfr'])) {//verification de la description
		if (trim($_POST['descfr'])!='') {//on a une description
			$descfr=escape_data(htmlentities(trim($_POST['descfr'])));//on transforme la desc pour enlever les risques de hacking
		} else {
			$err[3]=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de décrire votre événement.</font></p>';
		}
	} else {
		$err[3]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de décrire votre événement.</font></p>';
	}
	
	if (isset($_POST['descuk'])) {//verification de la description anglaise
		if (trim($_POST['descuk'])!='') {//on a une description
			$descuk=escape_data(htmlentities(trim($_POST['descuk'])));//on transforme la desc pour enlever les risques de hacking
		} else {
			$err[4]=TRUE;
			$errors[]='<p><font color="red"> - Vous avez omis de décrire votre événement en Anglais.</font></p>';
		}
	} else {
		$err[4]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis de décrire votre événement en Anglais.</font></p>';
	}
	
	if (empty($errors)) {// on a pas d'erreur
		$heure=$_POST['lheure'];
		$query="INSERT INTO vsysevents ( v_EtabID, v_EventActif, v_EventDate, v_EventTime, v_EventNom, v_EventDesc, v_EventNomUK, v_EventDescUK) VALUES ( 0, 1, '$ladate', '$heure', '$nom', '$descfr', '$nomuk', '$descuk')";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		if (mysql_affected_rows() == 1) {// on a un resultat
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
				<p><span class="sstitre">Créer un événement</span></p><br />
				<p>L'événement a été créer dans la base de données.</p><p><br /></p>
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
				<p><span class="sstitre">Créer un événement</span></p><br />
				<p>L'événement n'a pas pu être créer dans la base de données. Veuillez contacter l'administrateur du site.</p><p><br /></p>
				</div>
			<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');	
				exit();	
		} //FIN DE 3if (mysql_affected_rows() == 1)
		
	} // fin de "if (empty($errors)) {
	
	
} //fin de "if (isset($_POST['soumis'])) {
?>
	<div id="longHaut">
	  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
	</div>
	<div id="longMilieu">
<?php	
	$header='event';
	$lienactif='event1';
	include('./includes/admin.php'); 
	echo'<div id="mainMemb">';
?>
	<p><span class="sstitre">Créer un événement</span></p><br />
	<p>Entrer les détails pour cet événement.</p><p><br /></p>
<?php
//on imprime les erreurs
if (!empty($errors)) {
	report_erreurs($errors);
}
?>
	<fieldset><legend>Détails de l'événement à créer : </legend><br />
	<table width="100%" border="0" cellpadding="5">
	<form action="ad_event1.php" method="post">
		<?php
			//nom de l'événement
			echo '<tr><td width="40%" align="left" class="photo">';
			if ($err[0]) {
				echo '<font color="red">Nom :</font>';
			} else {
				echo 'Nom :';
			}
			echo "</td>\n";
			echo '<td width="60%" align="left"><input type="text" name="lnom" size="35" maxlength="50" value="';
			if (isset($_POST['lnom'])) {
				echo $_POST['lnom'];
			}
			echo "\" /></td></tr>\n";
			
			echo '<tr><td width="40%" align="left" class="photo">';
			if ($err[1]) {
				echo '<font color="red">Nom Anglais :</font>';
			} else {
				echo 'Nom Anglais :';
			}
			echo "</td>\n";
			echo '<td width="60%" align="left"><input type="text" name="lnomuk" size="35" maxlength="50" value="';
			if (isset($_POST['lnomuk'])) {
				echo $_POST['lnomuk'];
			}
			echo "\" /></td></tr>\n";
			
			//la date
			echo '<tr><td class="photo">';
			if ($err[2]) {
				echo '<font color="red">Date :</font>';
			} else {
				echo 'Date :';
			}
			echo '</td><td><select name="ljour">';
			for ($i=1; $i<=31; $i++) {
				echo '<option value="' . $i . '"';
				if (isset($_POST['ljour'])) {
					if ($_POST['ljour'] == $i) {
						echo ' selected="selected"';
					}
				} else {
					if ($i==$aujourdhui['mday']) {//on selectionne aujourd'hui
						echo ' selected="selected"';
					}
				}
				echo ">$i</option>\n";
			}
			echo "</select>\n";
			echo ' <select name="lmois">';
			foreach ($mois as $key => $value) {
				echo '<option value="' . $key . '"';
				if (isset($_POST['lmois'])) {
					if ($_POST['lmois'] == $key ) {
						echo ' selected="selected"';
					}
				} else {
					if ($key==$aujourdhui['mon']) {//on selectionne aujourd'hui
						echo ' selected="selected"';
					}
				}
				echo ">$value</option>\n";
			}
			echo "</select>\n";
			echo ' <select name="lannee">';
			for ($i=$annee1; $i<=$annee2; $i++) {
				echo '<option value="' . $i . '"';
				if (isset($_POST['lannee'])) {
					if ($_POST['lannee'] == $i) {
						echo ' selected="selected"';
					}
				} else {
					if ($i==$aujourdhui['year']) {//on selectionne aujourd'hui
						echo ' selected="selected"';
					}						
				}
				echo ">$i</option>\n";
			}
			echo "</select>\n</td>\n</tr>\n";
			
			//heure
			echo '<tr><td class="photo">A partir de :</td>';
			echo "\n";
			echo '<td><select name="lheure">';
			echo "\n";
			foreach ($heures as $value) {
				echo "<option value=\"$value\"";
				if (isset($_POST['lheure'])) {
					if ($_POST['lheure'] == $value) {
						echo ' selected="selected"';
					}
				}
				echo ">$value</option>\n";
			}
			echo "</select>\n</td>\n</tr>\n";
			
			//description
			echo '<tr><td class="photo" colspan="2">';
			if ($err[3]) {
				echo '<font color="red">Description Française de  l\'événement :</font>';
			} else {
				echo 'Description Française de  l\'événement :';
			}
			echo "</td>\n</tr>\n";
			
			echo '<tr><td colspan="2"><textarea cols="50" rows="5" name="descfr">';
			if (isset($_POST['descfr'])) {
				echo $_POST['descfr'];
			}
			echo "</textarea>\n</td>\n</tr>";
			
			echo '<tr><td class="photo" colspan="2">';
			if ($err[4]) {
				echo '<font color="red">Description Anglaise de  l\'événement :</font>';
			} else {
				echo 'Description Anglaise de  l\'événement :';
			}
			echo "</td>\n</tr>\n";
			
			echo '<tr><td colspan="2"><textarea cols="50" rows="5" name="descuk">';
			if (isset($_POST['descuk'])) {
				echo $_POST['descuk'];
			}
			echo "</textarea>\n</td>\n</tr>";
		?>
		<tr><td colspan="2" align="center">
		<input type="submit" name="submit" value="Créer l'événement" />
		</td></tr>
		<input type="hidden" name="soumis" value="TRUE" />
	</form>
	</table>
	</fieldset>
	</div>
<?php
	print_ligne(0);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
?>