<?php # script : event2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier un &eacute;v&eacute;nement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

//variables
$e1=FALSE;
$e2=FALSE;
$e3=FALSE;
$heures =array ('06h00', '06h15', '06h30', '06h45', '07h00', '07h15', '07h30', '07h45', '08h00', '08h15', '08h30', '08h45', '09h00', '09h15', '09h30', '09h45', '10h00', '10h15', '10h30', '10h45', '11h00', '11h15', '11h30', '11h45', '12h00', '12h15', '12h30', '12h45', '13h00', '13h15', '13h30', '13h45', '14h00', '14h15', '14h30', '14h45', '15h00', '15h15', '15h30', '15h45', '16h00', '16h15', '16h30', '16h45', '17h00', '17h15', '17h30', '17h45', '18h00', '18h15', '18h30', '18h45', '19h00', '19h15', '19h30', '19h45', '20h00', '20h15', '20h30', '20h45', '21h00', '21h15', '21h30', '21h45', '22h00', '22h15', '22h30', '22h45', '23h00', '23h15', '23h30', '23h45', '24h00' );

$mois = array(1 => 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

date_default_timezone_set("Europe/Paris");
$aujourdhui=getdate();
$annee1=$aujourdhui['year'];
$annee2= $annee1+2;
$errors = array();
//on retrouve le ID de l'etablissement
$query="SELECT v_EtabID FROM vsyscommerces WHERE v_MembreID=$u_id";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) == 1) {
	$row=mysql_fetch_array($result,MYSQL_NUM);
	//on retrouve notre dossier
	$etab_id=$row[0];
} else {
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='event';
		$lienactif=NULL;
		include('./includes/membmenu.php'); 
		echo'<div id="mainMemb">';
	?><p><span class="sstitre">Modifier un &eacute;v&eacute;nement</span></p><br />
		<p>Une erreur s'est produite, et vos données ne peuvent pas être rappatriées. Si le problème persiste, contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(13);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
}

//maintenant on va récuperer les details de l'evenement à modifier
if ((isset($_POST['eveid'])) && (is_numeric($_POST['eveid']))) {//on a une id event de retour de cette forme
	$eve_id=$_POST['eveid'];
} elseif ((isset($_GET['eveid'])) && (is_numeric($_GET['eveid']))) {//on a une id event passée par event2.php
	$eve_id=$_GET['eveid'];
} else { // pas d'id
	$eve_id=FALSE;
	$errors[]='<p><font color="red"> - Aucun événement soumis. Si ce problème persite, veuillez contacter votre admisnistrateur.</font></p>';
} // fin de "if ((isset($_POST['eveid'])) && (is_numeric($_POST['eveid'])))

if (isset($_POST['soumis'])) {//forme soumise 
	if (isset($_POST['nom'])) {//verification du nom
		if (trim($_POST['nom'])!='') {//on a un nom
			$nom=escape_data(htmlentities(trim($_POST['nom'])));//on transforme le nom pour enlever les risques de hacking
		} else {
			$e1=TRUE;
			$nom=FALSE;
			$errors[]='<p><font color="red"> - Vous avez omis de nommer votre événement.</font></p>';
		}
	}
	
	if (isset($_POST['desc'])) {//verification de la description
		if (trim($_POST['desc'])!='') {//on a une description
			$desc=escape_data(htmlentities(trim($_POST['desc'])));//on transforme la description pour enlever les risques de hacking
		} else {
			$e2=TRUE;
			$desc=FALSE;
			$errors[]='<p><font color="red"> - Vous avez omis de décrire votre événement.</font></p>';
		}
	}
	
	//verification de la date choisie
	$madate=mktime(0,0,0,$_POST['mois'],$_POST['jour'],$_POST['annee']);
	$today=mktime(0,0,0,$aujourdhui['mon'],$aujourdhui['mday'],$aujourdhui['year']);
	if ($madate < $today) {//mauvaise date
		$e3=TRUE;
		$ladate=date('Y-m-d 23:59:59',$madate);
		$jour=date("j", strtotime($ladate));
		$lemois=date("n", strtotime($ladate));
		$annee=date("Y", strtotime($ladate));
		$ladate=FALSE;
		$errors[]='<p><font color="red"> - La date que vous avez selectionnée, est antérieure à aujourd\'hui.</font></p>';
	} else {
		$ladate=date('Y-m-d 23:59:59',$madate);
	}
	
	if ($nom && $desc && $ladate) {//on a tous les éléments
		$heure=$_POST['heure'];
		$query="UPDATE vsysevents SET v_EventNom='$nom', v_EventDate='$ladate', v_EventTime='$heure', v_EventDesc='$desc' WHERE v_EventID=$eve_id";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		$body = "Etablissement numéro $etab_id a modifié l'événement: $nom pour le $ladate. Il est nécessaire de changer les descriptions anglaises.";				
				
		mail('webmaster@vieuxnyons.com', 'Nouvel événement',$body, 'From: administration@vieuxnyons.com');
		?>
			<div id="longHaut">
			  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
			</div>
			<div id="longMilieu">
		<?php	
			$header='event';
			$lienactif=NULL;
			include('./includes/membmenu.php'); 
			echo'<div id="mainMemb">';
		?>
			<p><span class="sstitre">Modifier un &eacute;v&eacute;nement</span></p><br />
			<p>Votre événement a été modifié dans la base de données.</p>
		</div>

		<?php
			print_ligne(13);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
	}
} else {//forme non sousmise on retrouve les détails
	//on fait la requete si on a une id
	if ($eve_id && $etab_id) {
		$query="SELECT v_EventNom, v_EventDate, v_EventTime, v_EventDesc FROM vsysevents WHERE v_EventID=$eve_id";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		//verifier que l'on a un resultat
		if (@mysql_num_rows($result) == 1) { //on retrouve les details
			$row=mysql_fetch_array($result,MYSQL_ASSOC);
			$nom=stripslashes($row['v_EventNom']);
			$date=$row['v_EventDate'];
			$time=$row['v_EventTime'];
			$desc=stripslashes($row['v_EventDesc']);
			$jour=date("j", strtotime($date));
			$lemois=date("n", strtotime($date));
			$annee=date("Y", strtotime($date));
		} else {//pas de detail
			$errors[]='<p><font color="red"> - Aucun événement retrouvé. Si ce problème persite, veuillez contacter votre admisnistrateur.</font></p>';
		}
		
	}// fin de "if ($eve_id && $etab_id) {
	
}// fin de "if (isset($_POST['soumis'])) {//forme soumise

?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='event';
	$lienactif='event2';
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Modifier un &eacute;v&eacute;nement</span></p><br />
<?php
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	}
?>
<form action="eventmod.php" method="post">
	<fieldset><legend>Les détails de votre &eacute;v&eacute;nement :</legend>
	<br  />
	<table border="0" cellpadding="5" width="100%">
		<tr>
			<td align="left" width="30%" class="photo">
				<?php
					if (isset($e1)) {
						if ($e1==TRUE) {
							echo '<font color="red">Son nom :</font></td>';
						} else {
							echo 'Son nom:</td>';
						}
					}
				?>
			<td align="left" width="70%"><input type="text" name="nom" value="<?php if (isset($nom)) echo $nom; ?>" size="35" maxlength="50" /></td>
		</tr>
		<tr>
			<td align="left" class="photo">
			<?php
				if (isset($e3)) {
					if ($e3==TRUE) {
						echo '<font color="red">Sa date :</font></td>';
					} else {
						echo 'Sa date :</td>';
					}
				}
			?>
			<td>
				<select name="jour">
				<?php
					//creation des jours
					for ($day=1; $day<=31; $day++) {
						echo "<option value=\"$day\"";
						if (isset($jour)) {//jour selectionné
							if ($jour==$day) {
								echo ' selected="selected"';
							}
						} else {
							if ($day==$aujourdhui['mday']) {//on selectionne aujourd'hui
								echo ' selected="selected"';
							}
						}
						echo ">$day</option>\n";
					}
				echo "</select>&nbsp;\n";
				echo '<select name="mois">';
					//creation des mois
					foreach ($mois as $key => $value) {
						echo "<option value=\"$key\"";
						if (isset($lemois)) {//on a déja un mois
							if ($lemois == $key) {
								echo ' selected="selected"';
							}
						} else {
							if ($key==$aujourdhui['mon']) {//on selectionne aujourd'hui
								echo ' selected="selected"';
							}
						}
						echo ">$value</option>\n";
					}
				echo "</select>&nbsp;\n";
				echo '<select name="annee">';
					//creation des années
					for ($an=$annee1; $an<=$annee2; $an++) {
						echo "<option value=\"$an\"";
						if (isset($annee)) {//on a une année
							if ($annee == $an) {
								echo ' selected="selected"';
							}
						} else {
							if ($an==$aujourdhui['year']) {//on selectionne aujourd'hui
								echo ' selected="selected"';
							}
						}
						echo ">$an</option>\n";
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="left" class="photo">A partir de :</td>
			<td><select name="heure">
			<?php
				foreach ($heures as $value) {
					echo "<option value=\"$value\"";
					if (isset($time)) {
						if ($time == $value) {
							echo ' selected="selected"';
						}
					}
					echo ">$value</option>\n";
				}
			?>
			</select></td>
		</tr>
		<tr>
			<td class="photo" align="left">
			<?php
				if (isset($e2)) {
					if ($e2==TRUE) {
						echo '<font color="red">Sa description :</font></td>';
					} else {
						echo 'Sa description :</td>';
					}
				}
			?>
			<td >
			<?php
				echo '<textarea cols="30" rows="5" name="desc">';
				if (isset($desc)) {
					echo $desc;
				}
				echo '</textarea>';
			?>
			
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="Appliquer les modifications" />
			</td>
		</tr>
	</table>
	</fieldset>
	<input type="hidden" name="soumis" value="TRUE" />
	<input type="hidden" name="eveid" value="<?php echo $eve_id; ?>" />
</form>
</fieldset>
</div>

<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
