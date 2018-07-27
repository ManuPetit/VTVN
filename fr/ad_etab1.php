<?php # script : ad_etab1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Créer un établissement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

//creation des variables
$badQuery=FALSE;
$e1=FALSE;//lnom
$e2=FALSE;//lmem
$e3=FALSE;//lnumrue ou lrue
$e4=FALSE;//lphone
$e5=FALSE;//lfax
$e6=FALSE;//lmob
$e7=FALSE;//lurl
$e8=FALSE;//lemail
$e9=FALSE;//lcat
$e10=FALSE;//lresp1
$e11=FALSE;//lresp2
$e12=FALSE;//lfile
$e13=FALSE;//ltype
$e14=FALSE;//lham
$e15=FALSE;//lpm
$e16=FALSE;//ltypeuk

//creation des variables heures
$heures =array ('rien', 'tôt', '06h00', '06h15', '06h30', '06h45', '07h00', '07h15', '07h30', '07h45', '08h00', '08h15', '08h30', '08h45', '09h00', '09h15', '09h30', '09h45', '10h00', '10h15', '10h30', '10h45', '11h00', '11h15', '11h30', '11h45', '12h00', '12h15', '12h30', '12h45', '13h00', '13h15', '13h30', '13h45', '14h00', '14h15', '14h30', '14h45', '15h00', '15h15', '15h30', '15h45', '16h00', '16h15', '16h30', '16h45', '17h00', '17h15', '17h30', '17h45', '18h00', '18h15', '18h30', '18h45', '19h00', '19h15', '19h30', '19h45', '20h00', '20h15', '20h30', '20h45', '21h00', '21h15', '21h30', '21h45', '22h00', '22h15', '22h30', '22h45', '23h00', '23h15', '23h30', '23h45', '24h00', 'tard' );

$errmsg=FALSE;
$errors=array();

//creation des rues
$query="SELECT v_RueID, v_RueNom FROM vsysrues ORDER BY v_RueNom ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$rue_id=array();
	$rue_nom=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$rue_id[]=$row['v_RueID'];
		$rue_nom[]=$row['v_RueNom'];
	}
} else {
	$badQuery=TRUE;
	$errmsg .="Impossible de retrouver les Rues.\n";
}

//creation des categories
$query="SELECT v_ComTypeID, v_ComNom FROM vsyscommercetype WHERE v_ComActive=1";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$cat_id=array();
	$cat_nom=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$cat_id[]=$row['v_ComTypeID'];
		$cat_nom[]=$row['v_ComNom'];
	}
} else {
	$badQuery=TRUE;
	$errmsg .= "Impossible de retrouver les catégories\n";
}

//creation des membres
$query="SELECT v_MembreID, v_MembreIdentite FROM vsysmembres WHERE v_MembreLive=1 AND v_GroupeID=2 ORDER BY v_MembreIdentite ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$mem_id=array();
	$mem_nom=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$mem_id[]=$row['v_MembreID'];
		$mem_nom[]=$row['v_MembreIdentite'];
	}
} else {
	$badQuery=TRUE;
	$errmsg .= "Impossible de retrouver les membres\n";
}		

if ($badQuery) {// on a eu un probleme
?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='etab';
		$lienactif=NULL;
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?>
	<p><span class="sstitre">Créer un établissement</span></p><br />
		<p>Il est impossible au systeme de récuperer les détails pour créer un nouvel établissement. Veuillez contacter l'administrateur du site.</p><p>Problemes suivants:<?php echo $errmsg; ?></p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //  FIN DE "if ($badQuery) {

if (isset($_POST['soumis'])) {// on a soumis la forme
	
	$dbcol='(';
	$dbval='VALUES (';
	
	//validation du membre
	if (isset($_POST['lmem'])) {
		if (!empty($_POST['lmem'])) {
			$mem=$_POST['lmem'];
			$dbcol .= ' v_MembreID,';
			$dbval .= " $mem,";
		} else {
			$e2=TRUE;
			$errors[]='<p><font color="red"> - Veuillez choisir un membre.</font></p>';
		}
	} else {
		$e2=TRUE;
		$errors[]='<p><font color="red"> - Veuillez choisir un membre.</font></p>';
	}
		
	//validation du nom
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,50}$', stripslashes(trim($_POST['lnom'])))) {
		$nom=escape_data($_POST['lnom']);
		$dbcol .= ' v_EtabNom,';
		$dbval .= " '$nom',";
	} elseif ((trim($_POST['lnom'])) == '') {
		$e1=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez le nom d\'établissement que vous avez saisi.</font></p>';
	} else {
		$e1=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez le nom d\'établissement que vous avez saisi.</font></p>';
	}
	
		//validation de l'adresse
	if (isset($_POST['lnumrue'])) {//le numero
		if (!empty($_POST['lnumrue'])) {
			$numrue=$_POST['lnumrue'];
			$dbcol .= ' v_EtabNumero,';
			$dbval .= " $numrue,";
		} else {
			$e3=TRUE;
			$errors[]='<p><font color="red"> - Veuillez choisir un numéro de rue.</font></p>';
		}
	} else {
		$e3=TRUE;
		$errors[]='<p><font color="red"> - Veuillez choisir un numéro de rue.</font></p>';
	}
	
	if (isset($_POST['lrue'])) {// la rue
		if (!empty($_POST['lrue'])) {
			$rue=$_POST['lrue'];
			$dbcol .= ' v_RueID,';
			$dbval .= " $rue,";
		} else {
			$e3=TRUE;
			$errors[]='<p><font color="red"> - Veuillez choisir une rue.</font></p>';
		}
	} else {
		$e3=TRUE;
		$errors[]='<p><font color="red"> - Veuillez choisir une rue.</font></p>';
	}
	
	//validation du telephone
	if (isset($_POST['lphone'])) {//on a un numéro de téléphone
		if (eregi ('^[[:digit:] ]{10,14}$',stripslashes(trim($_POST['lphone'])))) {
			$phone=escape_data($_POST['lphone']);
			$dbcol .= ' v_EtabPhone,';
			$dbval .= " '$phone',";
		} elseif (trim($_POST['lphone']) == '') { //pas de téléphone
			$phone='';
		} else {
			$e4=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez le numéro de téléphone que vous avez saisi.</font></p>';
		}
	} else {//pas de telephone
		$phone='';
	}
	
	//validation du fax
	if (isset($_POST['lfax'])) {//on a un numéro de fax
		if (eregi ('^[[:digit:] ]{10,14}$',stripslashes(trim($_POST['lfax'])))) {
			$fax=escape_data($_POST['lfax']);
			$dbcol .= ' v_EtabFax,';
			$dbval .= " '$fax',";
		} elseif (trim($_POST['lfax']) == '') { //pas de fax
			$fax='';
		} else {
			$e5=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez le numéro de fax que vous avez saisi.</font></p>';
		}
	} else {//pas de fax
		$fax='';
	}
	
	//validation du portable
	if (isset($_POST['lmob'])) {//on a un numéro de portable
		if (eregi ('^[[:digit:] ]{10,14}$',stripslashes(trim($_POST['lmob'])))) {
			$mob=escape_data($_POST['lmob']);
			$dbcol .= ' v_EtabMobile,';
			$dbval .= " '$mob',";
		} elseif (trim($_POST['lmob']) == '') { //pas de portable
			$fax='';
		} else {
			$e6=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez le numéro de portable que vous avez saisi.</font></p>';
		}
	} else {//pas de portable
		$fax='';
	}
	
	//validation des heures 1ere plage
	if (($_POST['heureOnAM'] == 'rien') OR ($_POST['heureOffAM'] == 'rien')) {
		$e14=TRUE;
		$errors[]='<p><font color="red"> - Vous devez choisir au moins une plage horaire. Vérifiez les horaires choisis.</font></p>';
	} elseif ((($_POST['heureOnAM'] != 'tôt') or ($_POST['heureOnAM'] != 'tard')) and (($_POST['heureOffAM'] != 'tôt') or ($_POST['heureOffAM'] != 'tard'))) {// On 'na pas des heures
		if ($_POST['heureOnAM'] < $_POST['heureOffAM']) {//heure d'ouverture valide
			$heureOnAM=$_POST['heureOnAM'];
			$heureOffAm=$_POST['heureOffAM'];
			$dbcol .= ' v_HoraireOnMatin, v_HoraireOffMatin,';
			$dbval .= " '$heureOnAM', '$heureOffAm',";
		} else {
			$e14=TRUE;
			$errors[]='<p><font color="red"> - Vous ne pouvez pas fermer votre établissement avant son ouverture. Vérifiez les horaires choisis.</font></p>';
		}
	} else {
		$heureOnAM=$_POST['heureOnAM'];
		$heureOffAm=$_POST['heureOffAM'];
		$dbcol .= ' v_HoraireOnMatin, v_HoraireOffMatin,';
		$dbval .= " '$heureOnAM', '$heureOffAm',";
	}
	
	//validation des heures 2ème plage
	if (($_POST['heureOnPM'] == 'rien') and ($_POST['heureOffPM'] == 'rien')) {//on n'a pas de plage numero 2
		$heureOnPM='';
		$heureOffPM='';
	} elseif (($_POST['heureOnPM'] == 'rien') OR ($_POST['heureOffPM'] == 'rien')) {// on a seulement une heure
		$e15=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez les horaires choisis pour la deuxième plage d\'ouverture.</font></p>';
	} elseif ((($_POST['heureOnPM'] != 'tôt') and ($_POST['heureOnPM'] != 'tard')) and (($_POST['heureOffPM'] != 'tôt') and ($_POST['heureOffPM'] != 'tard'))) {// On 'na pas des heures
		if ($_POST['heureOnPM'] < $_POST['heureOffPM']) {//heure d'ouverture valide
			$heureOnPM=$_POST['heureOnPM'];
			$heureOffPM=$_POST['heureOffPM'];
			$dbcol .= ' v_HoraireOnSoir, v_HoraireOffSoir,';
			$dbval .= " '$heureOnPM', '$heureOffPM',";
		} else {
			$e15=TRUE;
			$errors[]='<p><font color="red"> - Vous ne pouvez pas fermer votre établissement avant son ouverture. Vérifiez les horaires choisis.</font></p>';
		}
	} else {
		$heureOnPM=$_POST['heureOnPM'];
		$heureOffPM=$_POST['heureOffPM'];
		$dbcol .= ' v_HoraireOnSoir, v_HoraireOffSoir,';
		$dbval .= " '$heureOnPM', '$heureOffPM',";
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
	$dbcol .= ' v_EtabFerme,';
	$dbval .= " '$ferme',";
	
	//validation du 1er responsable
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,60}$', stripslashes(trim($_POST['lresp1'])))) {
		$respon1=escape_data($_POST['lresp1']);
		$dbcol .= ' v_EtabResponsable1,';
		$dbval .= " '$respon1',";
	} elseif ((trim($_POST['lresp1'])) == '') {		
		$e10=TRUE;
		$errors[]='<p><font color="red"> - Veuillez saisir un nom de responsable.</font></p>';
	} else {
		$e10=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez l\'ortographe du responsable que vous avez saisi.</font></p>';
	}
		
	//validation du 2eme responsable
	if (isset($_POST['lresp2'])) {//on verifie d'abord que l'on a une entrée car optionnel	
		if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,60}$', stripslashes(trim($_POST['lresp2'])))) {
			$respon2=escape_data($_POST['lresp2']);
			$dbcol .= ' v_EtabResponsable2,';
			$dbval .= " '$respon2',";
		} elseif (trim($_POST['lresp2']) =='') {//on a pas d'entrée
			$respon2='';
		} else {
			$e11=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez l\'ortographe du deuxième responsable que vous avez saisi.</font></p>';
		}
	} else {//on a pas d'entrée
		$respon2='';
	}
	
	//validation de l'activité
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,120}$', stripslashes(trim($_POST['ltype'])))) {
		$activite=escape_data($_POST['ltype']);
		$dbcol .= ' v_EtabActivite,';
		$dbval .= " '$activite',";
	} elseif ((trim($_POST['ltype'])) == '') {
		$e13=TRUE;
		$errors[]='<p><font color="red"> - Vous devez saisir une activité.</font></p>';
	
	} else {
		$e13=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez l\'ortographe de l\'activité que vous avez saisie.</font></p>';
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
			$dbcol .= ' v_EtabURL,';
			$dbval .= " '$url',";
		} else {//mauvaise url
			$e7=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez l\'adresse du site internet, que vous avez saisie.</font></p>';
		}
	} else {//pas de site
		$url='';
	}
	
	//validation de l'adresse email
	if (isset($_POST['lemail'])) {
		if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['lemail'])))){		
			$email=escape_data($_POST['lemail']);
			$dbcol .= ' v_EtabEmail,';
			$dbval .= " '$email',";
		} elseif (trim($_POST['lemail']) == '') {
			$email='';
		} else {
			$e8=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez l\'adresse email, que vous avez saisie.</font></p>';
		}
	} else {//pas d'email
		$email='';
	}
	
	//validation de la categorie
	if (isset($_POST['lcat'])) {
		if (!empty($_POST['lcat'])) {
			$cat=$_POST['lcat'];
			$dbcol .= ' v_ComTypeID,';
			$dbval .= " $cat,";
		} elseif ((trim($_POST['lcat'])) == '') {
			$e9=TRUE;
			$errors[]='<p><font color="red"> - Veuillez choisir une catégorie.</font></p>';
		} else {
			$e9=TRUE;
			$errors[]='<p><font color="red"> - Veuillez choisir une catégorie.</font></p>';
		}
	} else {
		$e9=TRUE;
		$errors[]='<p><font color="red"> - Veuillez choisir une catégorie.</font></p>';
	}
	
	//On ajoute actif
	$actif=$_POST['lactif'];
	$dbcol .= ' v_EtabActive,';
	$dbval .= " $actif,";
	
	//validation du dossier
	if (isset($_POST['lfile'])) {
		if (eregi('^[[:alnum:]]{5,8}$',stripslashes(trim($_POST['lfile'])))) {
			$file=escape_data($_POST['lfile']);
			$dbcol .= ' v_EtabFileNom,';
			$dbval .= " '$file',";
		} else {
			$e12=TRUE;
			$errors[]='<p><font color="red"> - Veuillez indiquer un dossier pour ce commerce.</font></p>';
		}
	} else {
		$e12=TRUE;
		$errors[]='<p><font color="red"> - Veuillez indiquer un dossier pour ce commerce.</font></p>';
	}	
	
	//validation de l'activité
	if (eregi ('^[[:alnum:]\' \-\.]{3,120}$', stripslashes(trim($_POST['ltypeuk'])))) {
		$activiteuk=escape_data($_POST['ltypeuk']);
		$dbcol .= ' v_EtabActiviteUK) ';
		$dbval .= " '$activiteuk') ";
	} elseif ((trim($_POST['ltypeuk'])) == '') {
		$e16=TRUE;
		$errors[]='<p><font color="red"> - Vous devez saisir une activité en Anglais.</font></p>';
	
	} else {
		$e16=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez l\'ortographe de l\'activité en Anglais que vous avez saisie.</font></p>';
	}
	
	if (empty($errors)) {
		$query="INSERT INTO vsyscommerces $dbcol $dbval";	
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		if (mysql_affected_rows() == 1) {// on a un resultat
			//vérifier que le répertoire n'existe pas encore et le créer
			$dossier="../images/$file";
			if (!is_dir($dossier)) {
				mkdir($dossier,0755);
			}
			//on retrouve le numero de l'etablissement
			$query="SELECT v_EtabID FROM vsyscommerces WHERE v_EtabNom='$nom'";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (mysql_affected_rows() == 1) {// on a un resultat
				$row=mysql_fetch_array($result,MYSQL_NUM);
				$etab_id=$row[0];
				//donc on va maintenant entrer les descriptions sur une autre page
				//creation de l'URL de redirection
				$url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);
				//verifier pour le backslash
				if ((substr($url,-1) == '/') OR (substr($url,-1) == '\\')) {
					//enlever le slash
					$url=substr($url,0,-1);
				}
				//ajoute le nom du fichier
				$url .= "/ad_etab1b.php?etab=$etab_id";
				//rediriger
				ob_end_clean();
				header("Location: $url");
				exit();
			} else {
				?>
					<div id="longHaut">
					  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
					</div>
					<div id="longMilieu">
				<?php	
					$header='etab';
					$lienactif=NULL;
					include('./includes/admin.php'); 
					echo'<div id="mainMemb">';
				?>
				<p><span class="sstitre">Créer un établissement</span></p><br />
				<p>Le système n'a pas pu retrouver le numéro d'identité de l'établissement.</p><br />
				</div>
				<?php
					print_ligne(12);
					$menu_choix =NULL;
					include ('./includes/footerUnCol.php');
			} // FIN DE "if (mysql_affected_rows() == 1) 
		
		} else {
			?>
				<div id="longHaut">
				  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
				</div>
				<div id="longMilieu">
			<?php	
				$header='etab';
				$lienactif=NULL;
				include('./includes/admin.php'); 
				echo'<div id="mainMemb">';
			?>
			<p><span class="sstitre">Créer un établissement</span></p><br />
			<p>Le système n'a pas pu écrire les détails de l'établissement dans la base de données.</p><br />
			</div>
			<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');	
		}// FIN DE "if (mysql_affected_rows() == 1)
	
	}// fin de "if (empty($errors))
	
} // fin de "if (isset($_POST['soumis'])) {
	
?>
	<div id="longHaut">
	  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
	</div>
	<div id="longMilieu">
<?php	
	$header='etab';
	$lienactif='etab1';
	include('./includes/admin.php'); 
	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Créer un établissement</span></p><br />
<p>Entrer les détails pour créer un nouvel établissement.</p><br />
<?php
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	}
?>
<fieldset><legend>Créer un établissement :</legend><br />
<form method="post" action="ad_etab1.php">
<table width="100%" border="0" cellpadding="5">
<?php
	//nom
	echo "\n<tr>\n";
	echo '<td width="30%" align="left" class="photo">';
	if ($e1) {
		echo '<font color="red">Nom :</font>';
	} else {
		echo 'Nom :';
	}
	echo "</td>\n";
	echo '<td width="70%" align="left"><input type="text" name="lnom" size="20" maxlength="50" value="';
	if (isset($_POST['lnom'])) {
		echo $_POST['lnom'];
	}
	echo '" /></td></tr>';
	
	//membre
	echo "\n<tr>\n";
	echo '<td class="photo">';
	if ($e2) {
		echo '<font color="red">Membre :</font>';
	} else {
		echo 'Membre :';
	}
	echo "</td>\n";
	echo '<td><select name="lmem">';
	echo "<option value=\"\">Choisissez...</option>\n";
	$count=count($mem_id)-1;
	for ($i=0; $i<=$count; $i++) {
		echo '<option value="' . $mem_id[$i] . '"';
		if (isset($_POST['lmem'])) {
			if ($_POST['lmem'] == $mem_id[$i]) {
				echo ' selected="selected"';
			}
		}
		echo ">" . $mem_nom[$i] . "</option>\n";
	}
	echo "</select></td></tr>\n";
	
	//adresse
	echo "<tr>\n";
	echo '<td class="photo">';
	if ($e3) {
		echo '<font color="red">Adresse :</font>';
	} else {
		echo 'Adresse :';
	}
	echo "</td>\n";
	echo '<td><select name="lnumrue">';
	echo "<option value=\"\">N°</option>\n";
	for ($i=1; $i<=100; $i++) {
		echo '<option value="' . $i . '"';
		if (isset($_POST['lnumrue'])) {
			if ($_POST['lnumrue'] == $i) {
				echo ' selected="selected"';
			}
		}
		echo ">$i</option>\n";
	}
	echo "</select>\n";
	echo '&nbsp;<select name="lrue">';
	echo  "<option value=\"\">adresse...</option>\n";
	$count=count($rue_id)-1;
	for ($i=0; $i<=$count; $i++) {
		echo '<option value="' . $rue_id[$i] . '"';
		if (isset($_POST['lrue'])) {
			if ($_POST['lrue'] == $rue_id[$i]) {
				echo ' selected="selected"';
			}
		}
		echo '>' . $rue_nom[$i];
		echo "</option>\n";
	}
	echo "</select></td>\n</tr>\n";
	
	//telephone
	echo "<tr>\n<td class=\"photo\">";
	if ($e4) {
		echo '<font color="red">Téléphone :</font>';
	} else {
		echo 'Téléphone :';
	}
	echo "</td>\n";
	echo '<td class="option"><input type="text" name="lphone" size="20" maxlength="14" value="';
	if (isset($_POST['lphone'])) {
		echo $_POST['lphone'];
	}
	echo '" /> optionnel</td>';
	echo "\n</tr>\n";
	
	//fax
	echo "<tr>\n<td class=\"photo\">";
	if ($e5) {
		echo '<font color="red">Fax :</font>';
	} else {
		echo 'Fax :';
	}
	echo "</td>\n";
	echo '<td class="option"><input type="text" name="lfax" size="20" maxlength="14" value="';
	if (isset($_POST['lfax'])) {
		echo $_POST['lfax'];
	}
	echo '" /> optionnel</td>';
	echo "\n</tr>\n";
	
	//mobile
	echo "<tr>\n<td class=\"photo\">";
	if ($e6) {
		echo '<font color="red">Portable :</font>';
	} else {
		echo 'Portable :';
	}
	echo "</td>\n";
	echo '<td class="option"><input type="text" name="lmob" size="20" maxlength="14" value="';
	if (isset($_POST['lmob'])) {
		echo $_POST['lmob'];
	}
	echo '" /> optionnel</td>';
	echo "\n</tr>\n";
	
	//url
	echo "<tr>\n<td class=\"photo\">";
	if ($e7) {
		echo '<font color="red">Site internet :</font>';
	} else {
		echo 'Site internet :';
	}
	echo "</td>\n";
	echo'<td class="option"><span class="entd">http://</span><input type="text" size="28" maxlength="120" name="lurl" value="';
	if (isset($_POST['lurl'])) {
		echo $_POST['lurl'];
	}
	echo '" /> optionnel</td>';
	echo "\n</tr>\n";
	
	//email
	echo "<tr>\n<td class=\"photo\">";
	if ($e8) {
		echo '<font color="red">Email :</font>';
	} else {
		echo 'Email :';
	}
	echo "</td>\n";
	echo'<td class="option"><input type="text" size="35" maxlength="120" name="lemail" value="';
	if (isset($_POST['lemail'])) {
		echo $_POST['lemail'];
	}
	echo '" /> optionnel</td>';
	echo "\n</tr>\n";
	
	//catégorie
	echo "<tr>\n<td class=\"photo\">";
	if ($e9) {
		echo '<font color="red">Catégorie :</font>';
	} else {
		echo 'Catégorie :';
	}
	echo "</td>\n<td><select name=\"lcat\">";
	echo '<option value="">Choisissez...</option>';
	$count=count($cat_id)-1;
	for ($i=0; $i<=$count; $i++) {
		echo '<option value="' . $cat_id[$i] . '"';
		if (isset($_POST['lcat'])) {
			if ($_POST['lcat'] == $cat_id[$i]) {
				echo ' selected="selected"';
			}
		}
		echo ">" . $cat_nom[$i] . "</option>\n";
	}
	echo "</select>\n</td>\n</tr>\n";
	
	//actif
	echo "<tr>\n<td class=\"photo\">Activé :";
	echo "</td>\n<td><select name=\"lactif\">";
	echo '<option value="0"';
	if (isset($_POST['lactif'])) {
		if ($_POST['lactif'] == 0)  {
			echo ' selected="selected"';
		}
	}
	echo '>Commerce non activé</option>';
	echo "\n";
	echo '<option value="1"';
	if (!isset($_POST['lactif'])) {
		echo ' selected="selected"';
	} else {
		if ($_POST['lactif'] == 1) {
			echo ' selected="selected"';
		}
	}
	echo '>Commerce activé</option>';
	echo "\n</select>\n</td>\n</tr>\n";
	
	//responsable1
	echo "<tr>\n";
	echo '<td class="photo">';
	if ($e10) {
		echo '<font color="red">Responsable 1:</font>';
	} else {
		echo 'Responsable 1:';
	}
	echo "</td>\n<td>";
	echo '<input type="text" name="lresp1" size="35" maxlength="60" value="';
	if (isset($_POST['lresp1'])) {
		echo $_POST['lresp1'];
	}
	echo '" /></td>';
	echo "\n</tr>\n";
	
	//responsable2
	echo "<tr>\n";
	echo '<td class="photo">';
	if ($e11) {
		echo '<font color="red">Responsable 2:</font>';
	} else {
		echo 'Responsable 2:';
	}
	echo "</td>\n";
	echo '<td class="option"><input type="text" name="lresp2" size="35" maxlength="60" value="';
	if (isset($_POST['lresp2'])) {
		echo $_POST['lresp2'];
	}
	echo '" /> optionnel</td>';
	echo "\n</tr>\n";
	
	//fichier
	echo "<tr>\n";
	echo '<td class="photo">';
	if ($e12) {
		echo '<font color="red">Dossier :</font>';
	} else {
		echo 'Dossier :';
	}
	echo "</td>\n";
	echo '<td class="option"><input type="text" name="lfile" size="20" maxlength="8" value="';
	if (isset($_POST['lfile'])) {
		echo $_POST['lfile'];
	}
	echo '" /></td>';
	echo "\n</tr>\n";
	
	//activité du commerce
	echo "<tr>\n";
	echo '<td class="photo">';
	if ($e13) {
		echo '<font color="red">Activité :</font>';
	} else {
		echo 'Activité :';
	}
	echo "</td>\n";
	echo '<td class="option"><input type="text" name="ltype" size="35" maxlength="120" value="';
	if (isset($_POST['ltype'])) {
		echo $_POST['ltype'];
	}
	echo '" /></td>';
	echo "\n</tr>\n";
	
	//activité du commerce
	echo "<tr>\n";
	echo '<td class="photo">';
	if ($e16) {
		echo '<font color="red">Activité Anglais:</font>';
	} else {
		echo 'Activité Anglais:';
	}
	echo "</td>\n";
	echo '<td class="option"><input type="text" name="ltypeuk" size="35" maxlength="120" value="';
	if (isset($_POST['ltypeuk'])) {
		echo $_POST['ltypeuk'];
	}
	echo '" /></td>';
	echo "\n</tr>\n";
	
	echo '<tr><td colspan="2" align="center">Horaires d\'ouverture</td></tr>';
	echo "\n<tr>\n";
	
	//Heure d'ouverture matin
	echo '<td align="left" width="30%" class="photo">';
	if ($e14) {
		echo '<font color="red">1ère Plage :</font>';
	} else {
		echo '1ère Plage :';
	}
	echo "</td>\n";
	echo '<td align="left" width="70%" class="photo">De ';
	echo '<select name="heureOnAM">';
	foreach ($heures as $value) {
		echo '<option value="' . $value . '"';
		if (isset($_POST['heureOnAM'])) {
			if ($_POST['heureOnAM'] == $value) {
				echo ' selected="selected"';
			}
		}
		echo ">$value</option>\n";
	}
	echo "</select>\n à <select name=\"heureOffAM\">";
	foreach ($heures as $value) {
		echo '<option value="' . $value . '"';
		if (isset($_POST['heureOffAM'])) {
			if ($_POST['heureOffAM'] == $value) {
				echo ' selected="selected"';
			}
		}
		echo ">$value</option>\n";
	}
	echo "</select>\n</td>\n</tr>\n";
	
	//Heure d'ouverture après midi
	echo '<td align="left" width="30%" class="photo">';
	if ($e15) {
		echo '<font color="red">2ème Plage :</font>';
	} else {
		echo '2ème Plage :';
	}
	echo "</td>\n";
	echo '<td align="left" width="70%" class="photo">De ';
	echo '<select name="heureOnPM">';
	foreach ($heures as $value) {
		echo '<option value="' . $value . '"';
		if (isset($_POST['heureOnPM'])) {
			if ($_POST['heureOnPM'] == $value) {
				echo ' selected="selected"';
			}
		}
		echo ">$value</option>\n";
	}
	echo "</select>\n à <select name=\"heureOffPM\">";
	foreach ($heures as $value) {
		echo '<option value="' . $value . '"';
		if (isset($_POST['heureOffPM'])) {
			if ($_POST['heureOffPM'] == $value) {
				echo ' selected="selected"';
			}
		}
		echo ">$value</option>\n";
	}
	echo "</select>\n</td>\n</tr>\n";
	echo '<tr><td colspan="2" align="left" class="option">';
	echo "Cette deuxième plage est optionnelle. Si vous ne souhaitez pas l'utiliser, choisissez &quot;rien&quot; pour chacune des heures.</td></tr>\n";
	
	echo '<tr><td colspan="2" align="center">Jours d\'ouverture</td></tr>';
	
	//jour de fermeture
	echo '<tr><td colspan="2" align="center">';
	echo '<table width="100%" border="1"><tr><td align="left" width="28%" class="ferme">Jour</td>';
	echo "\n";
	echo '<td align="center" width="18%" class="ferme">Ouvert tout le jour</td><td align="center" width="18%" class="ferme">Ferm&eacute; le matin</td><td align="center" width="18%" class="ferme">Ferm&eacute; l&acute;apr&egrave;s midi</td>';
	echo '<td align="center" width="18%" class="ferme">Ferm&eacute; tout le jour</td></tr>';
	echo "\n";
	//on remplit la grille avec les données
	if (isset($_POST['leDimanche'])) {
		$dimanche=$_POST['leDimanche'];
	} else {
		$dimanche='a';
	}
	if (isset($_POST['leLundi'])) {
		$lundi=$_POST['leLundi'];
	} else {
		$lundi='a';
	}
	if (isset($_POST['leMardi'])) {
		$mardi=$_POST['leMardi'];
	} else {
		$mardi='a';
	}
	if (isset($_POST['leMercredi'])) {
		$mercredi=$_POST['leMercredi'];
	} else {
		$mercredi='a';
	}
	if (isset($_POST['leJeudi'])) {
		$jeudi=$_POST['leJeudi'];
	} else {
		$jeudi='a';
	}
	if (isset($_POST['leVendredi'])) {
		$vendredi=$_POST['leVendredi'];
	} else {
		$vendredi='a';
	}
	if (isset($_POST['leSamedi'])) {
		$samedi=$_POST['leSamedi'];
	} else {
		$samedi='a';
	}
	
	fill_closed_day ('Dimanche', $dimanche);
	fill_closed_day ('Lundi', $lundi);
	fill_closed_day ('Mardi', $mardi);
	fill_closed_day ('Mercredi', $mercredi);
	fill_closed_day ('Jeudi', $jeudi);
	fill_closed_day ('Vendredi', $vendredi);
	fill_closed_day ('Samedi', $samedi);
	echo "</table>\n</td>\n</tr>\n";
	
	echo '<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Créer le nouvel établissement" /></td></tr>';
	
?>
	<input type="hidden" name="soumis" value="TRUE" />
</table>
</form>
</fieldset>
</div>
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
	
