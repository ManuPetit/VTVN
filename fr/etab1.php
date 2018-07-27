<?php # script : etab1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Editer mes d&eacute;tails.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

$heures =array ('rien', 'tôt', '06h00', '06h15', '06h30', '06h45', '07h00', '07h15', '07h30', '07h45', '08h00', '08h15', '08h30', '08h45', '09h00', '09h15', '09h30', '09h45', '10h00', '10h15', '10h30', '10h45', '11h00', '11h15', '11h30', '11h45', '12h00', '12h15', '12h30', '12h45', '13h00', '13h15', '13h30', '13h45', '14h00', '14h15', '14h30', '14h45', '15h00', '15h15', '15h30', '15h45', '16h00', '16h15', '16h30', '16h45', '17h00', '17h15', '17h30', '17h45', '18h00', '18h15', '18h30', '18h45', '19h00', '19h15', '19h30', '19h45', '20h00', '20h15', '20h30', '20h45', '21h00', '21h15', '21h30', '21h45', '22h00', '22h15', '22h30', '22h45', '23h00', '23h15', '23h30', '23h45', '24h00', 'tard' );

$errors = array();

//retrieve the data for the etablissement
$query= "SELECT v_EtabID, v_EtabNom, v_EtabNumero, v_RueID, v_EtabPhone, v_EtabFax, v_EtabMobile, v_HoraireOnMatin, v_HoraireOffMatin, v_HoraireOnSoir, v_HoraireOffSoir, v_EtabFerme, v_EtabResponsable1, v_EtabResponsable2, v_EtabActivite, v_EtabURL, v_EtabEmail FROM vsyscommerces WHERE v_MembreID=$u_id AND v_EtabActive=1";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) == 1) {
	$row=mysql_fetch_array($result,MYSQL_NUM);
	$etab_id=$row[0];
	$nom=$row[1];
	$numRue=$row[2];
	$rue_id=$row[3];
	if (is_null($row[4])) {//on a pas de telephone
		$phone="";
	} else {
		$phone=$row[4];
	}	
	if (is_null($row[5])) {//on a pas de fax
		$fax="";
	} else {
		$fax=$row[5];
	}
	if (is_null($row[6])) {//on a pas de mobile
		$mobile="";
	} else {
		$mobile=$row[6];
	}
	$heureOnAM=$row[7];
	$heureOffAM=$row[8];
	if (is_null($row[9])) {// on a pas d'heure dans le soir
		$heureOnPM="";
	} else {
		$heureOnPM=$row[9];
	}
	if (is_null($row[10])) {// on a pas d'heure dans le soir
		$heureOffPM="";
	} else {
		$heureOffPM=$row[10];
	}
	$ferme=$row[11];
	//on assigne la valeur du jour d'ouverture soit a= ouvert, b=fermé am, c= fermé pm, , d=fermé tout le jour
	$dimanche=$ferme{0};
	$lundi=$ferme{1};
	$mardi=$ferme{2};
	$mercredi=$ferme{3};
	$jeudi=$ferme{4};
	$vendredi=$ferme{5};
	$samedi=$ferme{6};
	$respon1=$row[12];
	if (is_null($row[13])) {//on a pas de second responsable
		$respon2="";
	} else {
		$respon2=$row[13];
	}
	$activite=$row[14];
	if (is_null($row[15])) {// on a pas d'url
		$url="";
	} else {
		$url=$row[15];
	}
	if (is_null($row[16])) {// on a pas d'email
		$email="";
	} else {
		$email=$row[16];
	}	
} else {
	$etab_id=FALSE;
}	
 
if (isset($_POST['submitted'])) {// validation de la forme 
	
	//creation duu flag valid
	$valid=TRUE;
	
	//validation du nom
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,50}$', stripslashes(trim($_POST['lenom'])))) {
		$nom=escape_data($_POST['lenom']);
	} else {
		$valid=FALSE;
		$e1=TRUE;
		$nom=$_POST['lenom'];
		$errors[]='<p><font color="red"> - Vérifiez le nom d\'établissement que vous avez saisi.</font></p>';
	}
	
	//création des autres variables pour l'adresse
	$numRue=$_POST['lenumero'];
	$rue_id=$_POST['larue'];
	
	//validation de l'activité
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,120}$', stripslashes(trim($_POST['lactivite'])))) {
		$activite=escape_data($_POST['lactivite']);
	} else {
		$valid=FALSE;
		$e2=TRUE;
		$activite=$_POST['lactivite'];
		$errors[]='<p><font color="red"> - Vérifiez l\'ortographe de l\'activité que vous avez saisie.</font></p>';
	}
	
	//validation du 1er responsable
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,60}$', stripslashes(trim($_POST['lerespon1'])))) {
		$respon1=escape_data($_POST['lerespon1']);
	} else {
		$valid=FALSE;
		$e3=TRUE;
		$respon1=$_POST['lerespon1'];
		$errors[]='<p><font color="red"> - Vérifiez l\'ortographe du responsable que vous avez saisi.</font></p>';
	}
	
	//validation du 2eme responsable
	if (isset($_POST['lerespon2'])) {//on verifie d'abord que l'on a une entrée car optionnel	
		if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,60}$', stripslashes(trim($_POST['lerespon2'])))) {
			$respon2=escape_data($_POST['lerespon2']);
		} elseif (trim($_POST['lerespon2']) =='') {//on a pas d'entrée
			$respon2='';
		} else {
			$valid=FALSE;
			$e4=TRUE;
			$respon2=$_POST['lerespon2'];
			$errors[]='<p><font color="red"> - Vérifiez l\'ortographe du deuxième responsable que vous avez saisi.</font></p>';
		}
	} else {//on a pas d'entrée
		$respon2='';
	}
	
	//validation du telephone
	if (isset($_POST['lephone'])) {//on a un numéro de téléphone
		if (eregi ('^[[:digit:] ]{10,14}$',stripslashes(trim($_POST['lephone'])))) {
			$phone=escape_data($_POST['lephone']);
		} elseif (trim($_POST['lephone']) == '') { //pas de téléphone
			$phone='';
		} else {
			$valid=FALSE;
			$e5=TRUE;
			$phone=$_POST['lephone'];
			$errors[]='<p><font color="red"> - Vérifiez le numéro de téléphone que vous avez saisi.</font></p>';
		}
	} else {//pas de telephone
		$phone='';
	}
	
	//validation du fax
	if (isset($_POST['lefax'])) {//on a un numéro de téléphone
		if (eregi ('^[[:digit:] ]{10,14}$',stripslashes(trim($_POST['lefax'])))) {
			$fax=escape_data($_POST['lefax']);
		} elseif (trim($_POST['lefax']) == '') { //pas de fax
			$fax='';
		} else {
			$valid=FALSE;
			$e6=TRUE;
			$fax=$_POST['lefax'];
			$errors[]='<p><font color="red"> - Vérifiez le numéro de fax que vous avez saisi.</font></p>';
		}
	} else {//pas de fax
		$fax='';
	}
			
	
	//validation du portable
	if (isset($_POST['leportable'])) {//on a un numéro de téléphone
		if (eregi ('^[[:digit:] ]{10,14}$',stripslashes(trim($_POST['leportable'])))) {
			$portable=escape_data($_POST['leportable']);
		} elseif (trim($_POST['leportable']) == '') {//pas de portable
			$portable='';
		} else {
			$valid=FALSE;
			$e7=TRUE;
			$portable=$_POST['leportable'];
			$errors[]='<p><font color="red"> - Vérifiez le numéro de portable que vous avez saisi.</font></p>';
		}
	} else { //pas de portable
		$portable='';
	}
	
	//validation de l'adresse internet
	if (isset($_POST['lurl'])) {
		$tmpurl=strtolower(escape_data($_POST['lurl']));//on met la valeur dans une variable temporaire et on met en mininuscule
		if ((substr($tmpurl,0,7)) == 'http://') {//on enleve le http au cas ou il est mis
			$newurl=str_replace('http://', '',$tmpurl);
		} else {
			$newurl=$tmpurl;
		}
		//finalement on véréfie l'url
		if (trim($newurl) =='') {// pas d'url
			$url='';
		} elseif (eregi('^([[:alnum:]\-\.])+(\.)([[:alnum:]]){2,4}([[:alnum:]/+=%&_\.~?\-]*)$',stripslashes(trim($newurl)))) { 
			$url=escape_data($newurl);
		} else {//mauvaise url
			$valid=FALSE;
			$e8=TRUE;
			$url=$_POST['lurl'];
			$errors[]='<p><font color="red"> - Vérifiez l\'adresse de votre site internet, que vous avez saisie.</font></p>';
		}
	} else {//pas de site
		$url='';
	}
	
	//validation de l'adresse email
	if (isset($_POST['lemail'])) {
		if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['lemail'])))){		
			$email=escape_data($_POST['lemail']);
		} elseif (trim($_POST['lemail']) == '') {
			$email='';
		} else {
			$valid=FALSE;
			$e9=TRUE;
			$email=$_POST['lemail'];
			$errors[]='<p><font color="red"> - Vérifiez l\'adresse email, que vous avez saisie.</font></p>';
		}
	} else {//pas d'email
		$email='';
	}
	
	//validation des heures
	if (($_POST['heureOnA'] == 'rien') OR ($_POST['heureOffA'] == 'rien')) {
		$valid=FALSE;
		$e10=TRUE;
		$heureOnAM=$_POST['heureOnA'];
		$heureOffAM=$_POST['heureOffA'];
		$errors[]='<p><font color="red"> - Vous devez choisir au moins une plage horaire. Vérifiez les horaires choisis.</font></p>';
	} elseif ((($_POST['heureOnA'] != 'tôt') or ($_POST['heureOnA'] != 'tard')) and (($_POST['heureOffA'] != 'tôt') or ($_POST['heureOffA'] != 'tard'))) {// On 'na pas des heures
		if ($_POST['heureOnA'] < $_POST['heureOffA']) {//heure d'ouverture valide
			$heureOnAM=$_POST['heureOnA'];
			$heureOffAm=$_POST['heureOffA'];
		} else {
			$valid=FALSE;
			$e10=TRUE;
			$heureOnAM=$_POST['heureOnA'];
			$heureOffAM=$_POST['heureOffA'];
			$errors[]='<p><font color="red"> - Vous ne pouvez pas fermer votre établissement avant son ouverture. Vérifiez les horaires choisis.</font></p>';
		}
	} else {
		$heureOnAM=$_POST['heureOnA'];
		$heureOffAm=$_POST['heureOffA'];
	}
	
	//validation des heures 2ème plage
	if (($_POST['heureOnP'] == 'rien') and ($_POST['heureOffP'] == 'rien')) {//on n'a pas de plage numero 2
		$heureOnPM='';
		$heureOffPM='';
	} elseif (($_POST['heureOnP'] == 'rien') OR ($_POST['heureOffP'] == 'rien')) {// on a seulement une heure
		$valid=FALSE;
		$e11=TRUE;
		$heureOnPM=$_POST['heureOnP'];
		$heureOffPM=$_POST['heureOffP'];
		$errors[]='<p><font color="red"> - Vérifiez les horaires choisis pour la deuxième plage d\'ouverture.</font></p>';
	} elseif ((($_POST['heureOnP'] != 'tôt') and ($_POST['heureOnP'] != 'tard')) and (($_POST['heureOffP'] != 'tôt') and ($_POST['heureOffP'] != 'tard'))) {// On 'na pas des heures
		if ($_POST['heureOnP'] < $_POST['heureOffP']) {//heure d'ouverture valide
			$heureOnPM=$_POST['heureOnP'];
			$heureOffPM=$_POST['heureOffP'];
		} else {
			$valid=FALSE;
			$e11=TRUE;
			$heureOnPM=$_POST['heureOnP'];
			$heureOffPM=$_POST['heureOffP'];
			$errors[]='<p><font color="red"> - Vous ne pouvez pas fermer votre établissement avant son ouverture. Vérifiez les horaires choisis.</font></p>';
		}
	} else {
		$heureOnPM=$_POST['heureOnP'];
		$heureOffPM=$_POST['heureOffP'];
	}
		
	//Verification des jours d'ouverture
	$dimanche=$_POST['leDimanche'];
	$lundi=$_POST['leLundi'];
	$mardi=$_POST['leMardi'];
	$mercredi=$_POST['leMercredi'];
	$jeudi=$_POST['leJeudi'];
	$vendredi=$_POST['leVendredi'];
	$samedi=$_POST['leSamedi'];
	$ferme=$dimanche . 	$lundi . $mardi . $mercredi . $jeudi . $vendredi .$samedi;
	
	if ($valid) {
		//tout est valide donc on peut faire l'enregistrement des details
		//creation de la requete
		$query = "UPDATE vsyscommerces SET v_EtabNom = '$nom', v_EtabNumero = $numRue, v_RueID = $rue_id, ";
		if ($phone == '') {//on a pas de phone
			$query .=  " v_EtabPhone = NULL,";
		} else {
			$query .=" v_EtabPhone = '$phone',";
		}
		if ($fax == '') {//on a pas de fax
			$query .= " v_EtabFax = NULL,";
		} else {
			$query .= " v_EtabFax = '$fax',";
		}
		if ($portable == '') {//pas de portable
			$query .= " v_EtabMobile = NULL,";
		} else {
			$query .= " v_EtabMobile = '$portable',";
		}
		$query .= " v_HoraireOnMatin = '$heureOnAM', v_HoraireOffMatin = '$heureOffAM',";
		if ($heureOnPM == '') { //pas de deuxieme palge horaire
			$query .= "v_HoraireOnSoir = NULL, v_HoraireOffSoir = NULL,";
		} else {
			$query .= " v_HoraireOnSoir = '$heureOnPM', v_HoraireOffSoir = '$heureOffPM',";
		}
		$query .= " v_EtabFerme = '$ferme', v_EtabResponsable1 = '$respon1',";
		if ($respon2 == '') {//pas de 2ème responsable
			$query .= " v_EtabResponsable2 = NULL,";
		} else {
			$query .= " v_EtabResponsable2 = '$respon2',";
		}
		$query .= " v_EtabActivite = '$activite',";
		if ($url == '') {//pas d'url
			$query .= " v_EtabURL = NULL,";
		} else {
			$query .= " v_EtabURL = '$url',";
		}
		if ($email == '') {//pas d'email
			$query .= " v_EtabEmail = NULL ";
		} else {
			$query .= " v_EtabEmail = '$email' ";
		}
		$query .= "WHERE v_EtabID = $etab_id";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		if (mysql_affected_rows() == 1) {// on a un resultat
			?>
			<div id="longHaut">
			<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
			</div>
			<div id="longMilieu">
			<?php
			$header='etab';
			$lienactif=NULL;
			include('./includes/membmenu.php'); 
			echo'<div id="mainMemb">';
			echo '<p><span class="sstitre">Editer mes d&eacute;tails</span></p><br />';
			echo "<p>Vos changements de détails ont été enregistrés dans la base de données de l'association VTVN avec succès.</p></div>";
			print_ligne(13);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
		} elseif (mysql_affected_rows() == 0) {// on a un resultat {// erreur d'enregistrement
			?>
			<div id="longHaut">
			<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
			</div>
			<div id="longMilieu">
			<?php
			$header='etab';
			$lienactif=NULL;
			include('./includes/membmenu.php'); 
			echo'<div id="mainMemb">';
			echo '<p><span class="sstitre">Editer mes d&eacute;tails</span></p><br />';
			echo 'Aucun changement n\'a été fait dans la base de données.</div>';
			print_ligne(13);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
		} else { //on a une erreur
			?>
			<div id="longHaut">
			<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
			</div>
			<div id="longMilieu">
			<?php
			$header='etab';
			$lienactif=NULL;
			include('./includes/membmenu.php'); 
			echo'<div id="mainMemb">';
			echo '<p><span class="sstitre">Editer mes d&eacute;tails</span></p><br />';
			echo '<p><font color="red"> L\'erreur v009 s\'est produite. Si cette erreur persiste, veuillez contacter votre administrateur.</font></p></div>';
			print_ligne(13);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
		}// fin de "if (mysql_affected_rows() == 1) "
		
	}//fin de "if ($valid)"
			
}// Fin de "if (isset($_POST['submitted']))"

// on a pas d'etablissement
if (!$etab_id) {?>
	<div id="longHaut">
	<img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
	</div>
	<div id="longMilieu">
	<?php
	$header='etab';
	$lienactif=NULL;
	include('./includes/membmenu.php'); 
	echo'<div id="mainMemb">';
	echo '<p><span class="sstitre">Editer mes d&eacute;tails</span></p><br />';
	echo '<p><font color="red">Le système ne peut pas retrouver les détails de votre établissement. Veuillez contacter l\'administrateur du site.</font></p></div>';
	print_ligne(13);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
	exit();
}

?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='etab';
	$lienactif='etab1';
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
	echo '<p><span class="sstitre">Editer mes d&eacute;tails</span></p><br />';
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	} else { //premier passage
	 	echo '<p>Les changements que vous allez effectuer, mettrons à jour d&egrave;s leurs validations et en temps réel, la base de données de l\'association VTVN .</p>';
	}
?>


<p><br /></p>
<form action="etab1.php" method="post">
<fieldset><legend>Mon &eacute;tablissement : </legend>
	<table border="0" cellpadding="5" width="100%">
		<tr>
			<td align="left" width="25%" class="photo">
			<?php 
				if (isset($e1)) {
					echo '<font color="red">Nom :</font>';
				} else {
					echo 'Nom :';
				}
			?>
			</td>
			<td align="left" width="75%"><input type="text" size="20" maxlength="50" name="lenom" value="<?php if (isset($nom)) echo $nom; ?>" /></td>
		</tr>
		<tr>
			<td class="photo">Adresse :</td>
			<td class="photo">N° <select name="lenumero">
			<?php //creation des numero de rue et address
			for ($num=1; $num<=100; $num++) {
				if ($num == $numRue) {//c'est le numero de rue donc on le selecte
					echo '<option value="' . $num . '" selected="selected">' . $num . '</option>'; 
				} else { // ce n'est pas le numéro selectionné
					echo '<option value="' . $num . '">' . $num . '</option>'; 
				}
				echo "\n";
			}
			echo '</select> <select name="larue">';
			//maintenant on retrouve les rues
			$query="SELECT v_RueID, v_RueNom FROM vsysrues ORDER BY v_RueNom";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			
			//on retourne les resultats
			while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {	
				if ($row['v_RueID'] == $rue_id) { //c'est la rue de l'etab dont on selectionne
					echo '<option value="' . $row['v_RueID'] . '" selected="selected">' . $row['v_RueNom'] . '</option>';
				}else { //ce n'est pas la rue selectionnée
					echo '<option value="' . $row['v_RueID'] . '">' . $row['v_RueNom'] . '</option>';
				}
				echo "\n";
			}
			?>
			</select></td>
		</tr>
		<tr>
			<td class="photo">
			<?php
				if (isset($e2)) {
					echo '<font color="red">Activit&eacute; :';
				} else {
					echo 'Activit&eacute; :';
				}
			?>
			</td>
			<td><input type="text" size="30" maxlength="120" name="lactivite" value="<?php if (isset($activite)) echo $activite; ?>" /></td>
		</tr>
	</table>
</fieldset>	
<br  />
<fieldset><legend>Responsables de mon &eacute;tablissement : </legend>
	<table border="0" cellpadding="5" width="100%">
		<tr>
			<td align="left" width="38%" class="photo">
			<?php
				if (isset($e3)) {
					echo '<font color="red">Responsable :</font>';
				} else {
					echo 'Responsable :';
				}
			?>
			</td>
			<td align="left" width="62%"><input type="text" size="30" maxlength="60" name="lerespon1" value="<?php if (isset($respon1)) echo $respon1; ?>" /></td>
		</tr>
		<tr>
			<td class="photo">
			<?php 
				if (isset($e4)) {
					echo '<font color="red">2&egrave;me responsable :</font>';
				} else {
					echo '2&egrave;me responsable :';
				}
			?>
			</td>
			<td class="option"><input type="text" size="30" maxlength="60" name="lerespon2" value="<?php if (isset($respon2)) echo $respon2; ?>" /> optionnel</td>
		</tr>
	</table>
</fieldset>
<br  />	 
<fieldset><legend>Contacts de mon &eacute;tablissement : </legend>
	<table border="0" cellpadding="5" width="100%">
		<tr>
			<td align="left" width="25%" class="photo">
			<?php
				if (isset($e5)) {
					echo '<font color="red">T&eacute;l&eacute;phone :</font>';
				} else {
					echo 'T&eacute;l&eacute;phone :';
				}
			?>
			</td>
			<td align="left" width="75%" class="option"><input type="text" size="20" maxlength="14" name="lephone" value="<?php if (isset($phone)) echo $phone; ?>" /> optionnel</td>
		</tr>
		<tr>
			<td class="photo">
			<?php
				if (isset($e6)) {
					echo '<font color="red">Fax :</font>';
				} else {
					echo 'Fax :';
				}
			?>
			</td>
			<td class="option"><input type="text" size="20" maxlength="14" name="lefax" value="<?php if (isset($fax)) echo $fax; ?>" /> optionnel</td>
		</tr>
		<tr>
			<td class="photo">
			<?php
				if (isset($e7)) {
					echo '<font color="red">Portable :</font>';
				} else {
					echo 'Portable :';
				}
			?>
			</td>
			<td class="option"><input type="text" size="20" maxlength="14" name="leportable" value="<?php if (isset($portable)) echo $portable; ?>" /> optionnel</td>
		</tr>
		<tr>
			<td class="photo">
			<?php
				if (isset($e8)) {
					echo '<font color="red">Internet :</font>';
				} else {
					echo 'Internet :';
				}
			?>
			</td>
			<td class="option"><span class="entd">http://</span><input type="text" size="32" maxlength="120" name="lurl" value="<?php if (isset($url)) echo $url; ?>" /> optionnel</td>
		</tr>
		<tr>
			<td class="photo">
			<?php 
				if (isset($e9)) {
					echo '<font color="red">Email :</font>';
				} else {
					echo 'Email :';
				}
			?>
			</td>
			<td class="option"><input type="text" size="40" maxlength="120" name="lemail" value="<?php if (isset($email)) echo $email; ?>" /> optionnel</td>
		</tr>
</table>
</fieldset>
<br  />	 
<fieldset><legend>Horaire d'ouverture : </legend>
	<table border="0" cellpadding="5" width="100%">
		<tr>
			<td align="left" width="45%" class="photo">
			<?php
				if (isset($e10)) {
					echo '<font color="red">Premi&egrave;re plage :</font>';
				} else {
					echo 'Premi&egrave;re plage :';
				}
			?>
			</td>	
			<td align="left" width="55%" class="photo">De 
			<?php //on fait la forme avec les heures
			echo '<select name="heureOnA">';
			foreach ($heures as $value) {
				if ($value == $heureOnAM) {//c'est l'heure d'ouverture
					echo "<option value=\"$value\" selected=\"selected\">$value</option>\n";
				} else {
					echo "<option value=\"$value\" >$value</option>\n";
				}
			}
			echo '</select> &agrave; <select name="heureOffA">';
			foreach ($heures as $value) {
				if ($value == $heureOffAM) {//c'est l'heure de fermeture
					echo "<option value=\"$value\" selected=\"selected\">$value</option>\n";
				} else {
					echo "<option value=\"$value\" >$value</option>\n";
				}
			}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td class="photo">
			<?php
				if (isset($e11)) {
					echo '<font color="red">Deuxième plage :</font>';
				} else {
					echo 'Deuxième plage :';
				}
			?>
			</td>	
			<td align="left" width="55%" class="photo">De 
			<?php //on fait la forme avec les heures
			echo '<select name="heureOnP">';
			foreach ($heures as $value) {
				if ($value == $heureOnPM) {//c'est l'heure d'ouverture
					echo "<option value=\"$value\" selected=\"selected\">$value</option>\n";
				} else {
					echo "<option value=\"$value\" >$value</option>\n";
				}
			}
			echo '</select> &agrave; <select name="heureOffP">';
			foreach ($heures as $value) {
				if ($value == $heureOffPM) {//c'est l'heure de fermeture
					echo "<option value=\"$value\" selected=\"selected\">$value</option>\n";
				} else {
					echo "<option value=\"$value\" >$value</option>\n";
				}
			}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="option">Cette deuxième plage est optionnelle. Si vous ne souhaitez pas l'utiliser, choisissez &quot;rien&quot; pour chacune des heures.</td>
		</tr>			
	</table>
</fieldset>
<br  />
<fieldset><legend>Fermeture hebdomadaire :</legend>
	<p><br  />Utilisez la grille pour selectionner votre fermeture hebdomadaire.</p><br  />
	<table border="1" width="100%">
		<tr>
			<td align="left" width="28%" class="ferme">Jour</td>
			<td align="center" width="18%" class="ferme">Ouvert tout le jour</td>
			<td align="center" width="18%" class="ferme">Ferm&eacute; le matin</td>
			<td align="center" width="18%" class="ferme">Ferm&eacute; l&acute;apr&egrave;s midi</td>
			<td align="center" width="18%" class="ferme">Ferm&eacute; tout le jour</td>
		</tr>
			<?php //on remplit la grille avec les données
			fill_closed_day ('Dimanche', $dimanche);
			fill_closed_day ('Lundi', $lundi);
			fill_closed_day ('Mardi', $mardi);
			fill_closed_day ('Mercredi', $mercredi);
			fill_closed_day ('Jeudi', $jeudi);
			fill_closed_day ('Vendredi', $vendredi);
			fill_closed_day ('Samedi', $samedi);
			?>
	</table>
</fieldset>	
<br  />
<table border="0" cellpadding="5" width="100%">
	<tr>
		<td align="center" width="100%"><input type="submit" name="submit" value="Valider mes détails" /></td>
	</tr>
</table>
<input type="hidden" name="submitted" value="TRUE" />
</form>		
</div>
	
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>