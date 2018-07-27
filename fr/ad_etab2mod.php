<?php # script : ad_etab2mod.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier un établissement.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$badQuery=FALSE;
$errmsg=FALSE;
//on récupère le numéro d'établissement
if ((isset($_GET['etab'])) && (is_numeric($_GET['etab']))) {
	$etab_id=$_GET['etab'];
} elseif ((isset($_POST['etab'])) && (is_numeric($_POST['etab']))) {
	$etab_id=$_POST['etab'];
} else {
	$badQuery=TRUE;
	$errmsg .= "Page accédée par erreur.\n";
}

//creation des variables heures
$heures =array ('rien', 'tôt', '06h00', '06h15', '06h30', '06h45', '07h00', '07h15', '07h30', '07h45', '08h00', '08h15', '08h30', '08h45', '09h00', '09h15', '09h30', '09h45', '10h00', '10h15', '10h30', '10h45', '11h00', '11h15', '11h30', '11h45', '12h00', '12h15', '12h30', '12h45', '13h00', '13h15', '13h30', '13h45', '14h00', '14h15', '14h30', '14h45', '15h00', '15h15', '15h30', '15h45', '16h00', '16h15', '16h30', '16h45', '17h00', '17h15', '17h30', '17h45', '18h00', '18h15', '18h30', '18h45', '19h00', '19h15', '19h30', '19h45', '20h00', '20h15', '20h30', '20h45', '21h00', '21h15', '21h30', '21h45', '22h00', '22h15', '22h30', '22h45', '23h00', '23h15', '23h30', '23h45', '24h00', 'tard' );

//variable d'erreur
$err=array();
for ($i=0; $i<=19; $i++) {
	$err[$i]=FALSE;
}

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

if (isset($etab_id)) {
	//maintenant on récupère toutes les données pour cette établissement
	$query="SELECT v_MembreID, v_EtabNom, v_EtabNumero, v_RueID, v_EtabPhone, v_EtabFax, v_EtabMobile, v_HoraireOnMatin, v_HoraireOffMatin, v_HoraireOnSoir, v_HoraireOffSoir, v_EtabFerme, v_EtabResponsable1, v_EtabResponsable2, v_EtabActivite, v_EtabURL, v_EtabEmail, v_ComTypeID, v_EtabActive, v_EtabFileNom, v_EtabActiviteUK FROM vsyscommerces WHERE v_EtabID=$etab_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_ASSOC);
		$v_MembreID=$row['v_MembreID'];
		$v_EtabNom=$row['v_EtabNom'];
		$v_EtabNumero=$row['v_EtabNumero'];
		$v_RueID=$row['v_RueID'];
		$v_EtabPhone=$row['v_EtabPhone'];
		$v_EtabFax=$row['v_EtabFax'];
		$v_EtabMobile=$row['v_EtabMobile'];
		$v_HoraireOnMatin=$row['v_HoraireOnMatin'];
		$v_HoraireOffMatin=$row['v_HoraireOffMatin'];
		$v_HoraireOnSoir=$row['v_HoraireOnSoir'];
		$v_HoraireOffSoir=$row['v_HoraireOffSoir'];
		$v_EtabFerme=$row['v_EtabFerme'];
		//on assigne la valeur du jour d'ouverture soit a= ouvert, b=fermé am, c= fermé pm, , d=fermé tout le jour
		$v_dimanche=$v_EtabFerme{0};
		$v_lundi=$v_EtabFerme{1};
		$v_mardi=$v_EtabFerme{2};
		$v_mercredi=$v_EtabFerme{3};
		$v_jeudi=$v_EtabFerme{4};
		$v_vendredi=$v_EtabFerme{5};
		$v_samedi=$v_EtabFerme{6};
		$v_EtabResponsable1=$row['v_EtabResponsable1'];
		$v_EtabResponsable2=$row['v_EtabResponsable2'];
		$v_EtabActivite=$row['v_EtabActivite'];
		$v_EtabURL=$row['v_EtabURL'];
		$v_EtabEmail=$row['v_EtabEmail'];
		$v_ComTypeID=$row['v_ComTypeID'];
		$v_EtabActive=$row['v_EtabActive'];
		$v_EtabFileNom=$row['v_EtabFileNom'];
		$v_EtabActiviteUK=$row['v_EtabActiviteUK'];
	} else {
		$badQuery=TRUE;
		$errmsg .= "Impossible de retrouver les détails de l'établissement numéro: $etab_id.\n";
	}// fin de "if (@mysql_num_rows($result) == 1)
		
	//maintenant on va retrouver les photos qui sont dans le dossier de cet établissement
	$query="SELECT v_PictNom, v_PictNomShow FROM vsyscompict WHERE v_EtabID=$etab_id ORDER BY v_PictNomShow";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) >= 1) {
		$v_PictNom=array();
		$v_PictNomShow=array();
		while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
			$v_PictNom[]=$row['v_PictNom'];
			$v_PictNomShow[]=$row['v_PictNomShow'];
		}
	} else {
		$badQuery=TRUE;
		$errmsg .= "Impossible de retrouver les phtographies de l'établissement numéro: $etab_id.\n";
	}
	
	//on retrouve maintenant les infos coresspondantes au description et photos utilisées
	$query="SELECT v_DetailType, v_Details FROM vsyscomdetails WHERE v_EtabID=$etab_id ORDER BY v_DetailType ASC";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) >= 1) {
		$v_DetailType=array();
		$v_Details=array();
		while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
			$v_DetailType[]=$row['v_DetailType'];
			$v_Details[]=$row['v_Details'];
		}
	} else {
		$badQuery=TRUE;
		$errmsg .= "Impossible de retrouver les descriptions de l'établissement numéro: $etab_id.\n";
	}	
		
} //fin de "if (isset($etab_id)) {

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
	<p><span class="sstitre">Modifier un établissement</span></p><br />
		<p>Il est impossible au systeme de récuperer les détails pour modifier un établissement. Veuillez contacter l'administrateur du site.</p><p>Problemes suivants:<?php echo "\n$errmsg"; ?></p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //  FIN DE "if ($badQuery) {

if (isset($_POST['soumis'])) {//vérification de la forme
	$errors=array();

	$dbset=FALSE;
	
	//validation du membre
	if (isset($_POST['lmembre'])) {
		$mem=$_POST['lmembre'];
		if ($mem != $v_MembreID) {
			$dbset .= " v_MembreID = $mem,";
		}
	}
	
	//validation du nom
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,50}$', stripslashes(trim($_POST['lnom'])))) {
		$nom=escape_data($_POST['lnom']);
		if ($nom != $v_EtabNom) {
			$dbset .= " v_EtabNom = '$nom',";
		}
	} elseif ((trim($_POST['lnom'])) == '') {
		$err[0]=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez le nom d\'établissement que vous avez saisi.</font></p>';
	} else {
		$err[0]=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez le nom d\'établissement que vous avez saisi.</font></p>';
	}

	//validation de l'adresse
	if (isset($_POST['lrue'])) {
		$rue=$_POST['lrue'];
		if ($rue != $v_EtabNumero) {
			$dbset .= " v_EtabNumero = $rue,";
		}
	}
	if (isset($_POST['ladresse'])) {
		$adresse=$_POST['ladresse'];
		if ($adresse != $v_RueID) {
			$dbset .= " v_RueID = $adresse,";
		}
	}
	
	//validation du telephone
	if (isset($_POST['lphone'])) {//on a un numéro de téléphone
		if (eregi ('^[[:digit:] ]{10,14}$',stripslashes(trim($_POST['lphone'])))) {
			$phone=escape_data($_POST['lphone']);
		} elseif (trim($_POST['lphone']) == '') { //pas de téléphone
			$phone='';
		} else {
			$err[1]=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez le numéro de téléphone que vous avez saisi.</font></p>';
		}
	} else {//pas de telephone
		$phone='';
	}
	if (!$err[1]) {
		if ($phone != $v_EtabPhone) {
			$dbset .= " v_EtabPhone = '$phone',";
		}
	}
	
	//validation du fax
	if (isset($_POST['lfax'])) {//on a un numéro de fax
		if (eregi ('^[[:digit:] ]{10,14}$',stripslashes(trim($_POST['lfax'])))) {
			$fax=escape_data($_POST['lfax']);
		} elseif (trim($_POST['lfax']) == '') { //pas de fax
			$fax='';
		} else {
			$err[2]=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez le numéro de fax que vous avez saisi.</font></p>';
		}
	} else {//pas de fax
		$fax='';
	}
	if (!$err[2]) {
		if ($fax != $v_EtabFax) {
			$dbset .= " v_EtabFax = '$fax',";
		}
	}
	
	//validation du mobile
	if (isset($_POST['lmobile'])) {//on a un numéro de mobile
		if (eregi ('^[[:digit:] ]{10,14}$',stripslashes(trim($_POST['lmobile'])))) {
			$mobile=escape_data($_POST['lmobile']);
		} elseif (trim($_POST['lmobile']) == '') { //pas de mobile
			$mobile='';
		} else {
			$err[3]=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez le numéro de mobile que vous avez saisi.</font></p>';
		}
	} else {//pas de mobile
		$mobile='';
	}
	if (!$err[3]) {
		if ($mobile != $v_EtabMobile) {
			$dbset .= " v_EtabMobile = '$mobile',";
		}
	}
	
	//validation des heures 1ere plage
	if (($_POST['heureOnAM'] == 'rien') OR ($_POST['heureOffAM'] == 'rien')) {
		$err[11]=TRUE;
		$errors[]='<p><font color="red"> - Vous devez choisir au moins une plage horaire. Vérifiez les horaires choisis.</font></p>';
	} elseif ((($_POST['heureOnAM'] != 'tôt') or ($_POST['heureOnAM'] != 'tard')) and (($_POST['heureOffAM'] != 'tôt') or ($_POST['heureOffAM'] != 'tard'))) {// On 'na pas des heures
		if ($_POST['heureOnAM'] < $_POST['heureOffAM']) {//heure d'ouverture valide
			$heureOnAM=$_POST['heureOnAM'];
			$heureOffAM=$_POST['heureOffAM'];
			if ($heureOnAM != $v_HoraireOnMatin) {
				$dbset .= " v_HoraireOnMatin = '$heureOnAM',";
			}
			if ($heureOffAM != $v_HoraireOffMatin) {
				$dbset .= " v_HoraireOffMatin = '$heureOffAM',";
			}
		} else {
			$err[11]=TRUE;
			$errors[]='<p><font color="red"> - Vous ne pouvez pas fermer votre établissement avant son ouverture. Vérifiez les horaires choisis.</font></p>';
		}
	} else {
		$heureOnAM=$_POST['heureOnAM'];
		$heureOffAM=$_POST['heureOffAM'];
		if ($heureOnAM != $v_HoraireOnMatin) {
				$dbset .= " v_HoraireOnMatin = '$heureOnAM',";
			}
			if ($heureOffAM != $v_HoraireOffMatin) {
				$dbset .= " v_HoraireOffMatin = '$heureOffAM',";
			}
	}
	
	//validation des heures 2ème plage
	if (($_POST['heureOnPM'] == 'rien') and ($_POST['heureOffPM'] == 'rien')) {//on n'a pas de plage numero 2
		$heureOnPM='';
		$heureOffPM='';
		$dbset .= " v_HoraireOnSoir = '', v_HoraireOffSoir ='',";
	} elseif (($_POST['heureOnPM'] == 'rien') OR ($_POST['heureOffPM'] == 'rien')) {// on a seulement une heure
		$err[12]=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez les horaires choisis pour la deuxième plage d\'ouverture.</font></p>';
	} elseif ((($_POST['heureOnPM'] != 'tôt') and ($_POST['heureOnPM'] != 'tard')) and (($_POST['heureOffPM'] != 'tôt') and ($_POST['heureOffPM'] != 'tard'))) {// On 'na pas des heures
		if ($_POST['heureOnPM'] < $_POST['heureOffPM']) {//heure d'ouverture valide
			$heureOnPM=$_POST['heureOnPM'];
			$heureOffPM=$_POST['heureOffPM'];
			if ($heureOnPM != $v_HoraireOnSoir) {
				$dbset .= " v_HoraireOnSoir = '$heureOnPM',";
			}
			if ($heureOffPM != $v_HoraireOffSoir) {
				$dbset .= " v_HoraireOffSoir = '$heureOffPM',";
			}
		} else {
			$err[12]=TRUE;
			$errors[]='<p><font color="red"> - Vous ne pouvez pas fermer votre établissement avant son ouverture. Vérifiez les horaires choisis.</font></p>';
		}
	} else {
		$heureOnPM=$_POST['heureOnPM'];
		$heureOffPM=$_POST['heureOffPM'];
		if ($heureOnPM != $v_HoraireOnSoir) {
				$dbset .= " v_HoraireOnSoir = '$heureOnPM',";
			}
			if ($heureOffPM != $v_HoraireOffSoir) {
				$dbset .= " v_HoraireOffSoir = '$heureOffPM',";
			}
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
	$dbset .= " v_EtabFerme = '$ferme',";
	
	//validation du 1er responsable
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,60}$', stripslashes(trim($_POST['lresp1'])))) {
		$respon1=escape_data($_POST['lresp1']);
		if ($respon1 != $v_EtabResponsable1) {
			$dbset .= " v_EtabResponsable1 = '$respon1',";
		}
	} elseif ((trim($_POST['lresp1'])) == '') {		
		$err[6]=TRUE;
		$errors[]='<p><font color="red"> - Veuillez saisir un nom de responsable.</font></p>';
	} else {
		$err[6]=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez l\'ortographe du responsable que vous avez saisi.</font></p>';
	}
	
	//validation du 2ème responsable
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,60}$', stripslashes(trim($_POST['lresp2'])))) {
		$respon2=escape_data($_POST['lresp2']);
		if ($respon2 != $v_EtabResponsable2) {
			$dbset .= " v_EtabResponsable2 = '$respon2',";
		}
	} elseif ((trim($_POST['lresp2'])) == '') {		
		$respon2 ='';
		if ($respon2 != $v_EtabResponsable2) {
			$dbset .= " v_EtabResponsable2 = '$respon2',";
		}
		
	} else {
		$err[7]=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez l\'ortographe du responsable que vous avez saisi.</font></p>';
	}
	
	//validation de l'activité
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,120}$', stripslashes(trim($_POST['lactivite'])))) {
		$activite=escape_data($_POST['lactivite']);
		if ($activite != $v_EtabActivite) {
			$dbset .= " v_EtabActivite = '$activite',";
		}
	} elseif ((trim($_POST['lactivite'])) == '') {
		$err[8]=TRUE;
		$errors[]='<p><font color="red"> - Vous devez saisir une activité.</font></p>';
	
	} else {
		$err[8]=TRUE;
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
			if ($url != $v_EtabURL) {
				$dbset .= " v_EtabURL = '$url',";
			}
		} elseif (eregi('^([[:alnum:]\-\.])+(\.)([[:alnum:]]){2,4}([[:alnum:]/+=%&_\.~?\-]*)$',stripslashes(trim($newurl)))) { 
			$url=escape_data($newurl);
			if ($url != $v_EtabURL) {
				$dbset .= " v_EtabURL = '$url',";
			}
		} else {//mauvaise url
			$err[4]=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez l\'adresse du site internet, que vous avez saisie.</font></p>';
		}
	} else {//pas de site
		$url='';
		if ($url != $v_EtabURL) {
			$dbset .= " v_EtabURL = '$url',";
		}
	}
	
	//validation de l'adresse email
	if (isset($_POST['lemail'])) {
		if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['lemail'])))){		
			$email=escape_data($_POST['lemail']);
			if ($email != $v_EtabEmail) {
				$dbset .= " v_EtabEmail = '$email',";
			}
		} elseif (trim($_POST['lemail']) == '') {
			$email='';
			if ($email != $v_EtabEmail) {
				$dbset .= " v_EtabEmail = '$email',";
			}
		} else {
			$err[5]=TRUE;
			$errors[]='<p><font color="red"> - Vérifiez l\'adresse email, que vous avez saisie.</font></p>';
		}
	} else {//pas d'email
		$email='';
		if ($email != $v_EtabEmail) {
			$dbset .= " v_EtabEmail = '$email',";
		}
	}
	
	//categorie
	if (isset($_POST['ltype'])) {
		$cat=$_POST['ltype'];
		if ($cat != $v_ComTypeID) {
			$dbset .= " v_ComTypeID = $cat,";
		}
	}
	
	if (isset($_POST['lactif'])) {
		$actif=$_POST['lactif'];
		if ($v_EtabActive != $actif) {
			$dbset .= " v_EtabActive = $actif,";
		}
	}
	
	//validation du dossier
	if (isset($_POST['ldossier'])) {
		if (eregi('^[[:alnum:]]{5,8}$',stripslashes(trim($_POST['ldossier'])))) {
			$file=escape_data($_POST['ldossier']);
			if ($file != $v_EtabFileNom) {
				$dbset .= " v_EtabFileNom = '$file',";
				$FileMove=TRUE;//variable pour deplacer tous les documents du dossier utilisateur
			}
		} else {
			$err[10]=TRUE;
			$errors[]='<p><font color="red"> - Veuillez indiquer un dossier pour ce commerce.</font></p>';
		}
	} else {
		$err[10]=TRUE;
		$errors[]='<p><font color="red"> - Veuillez indiquer un dossier pour ce commerce.</font></p>';
	}	
	
	//validation de l'activité
	if (eregi ('^[[:alnum:]àâçéèêëîïôöùû\' \-\.,;:-]{3,120}$', stripslashes(trim($_POST['lactiviteuk'])))) {
		$activiteu=escape_data($_POST['lactiviteuk']);
		if ($activiteu != $v_EtabActiviteUK) {
			$dbset .= " v_EtabActiviteUK = '$activite',";
		}
	} elseif ((trim($_POST['lactiviteuk'])) == '') {
		$err[9]=TRUE;
		$errors[]='<p><font color="red"> - Vous devez saisir une activité en anglais.</font></p>';
	
	} else {
		$err[9]=TRUE;
		$errors[]='<p><font color="red"> - Vérifiez l\'ortographe de l\'activité anglaise que vous avez saisie.</font></p>';
	}
	
	
	//validation description 1
	if ((trim($_POST['ldesc1'])) != '') {//on a une description
		$des1f=escape_data(htmlentities($_POST['ldesc1']));
	} else {
		$err[13]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une première description française.</font></p>';
	}
	if ((trim($_POST['ldesc1u'])) != '') {//on a une description
		$des1u=escape_data(htmlentities($_POST['ldesc1u']));
	} else {
		$err[14]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une première description anglaise.</font></p>';
	}
	
	//validation description 2
	if ((trim($_POST['ldesc2'])) != '') {//on a une description
		$des2f=escape_data(htmlentities($_POST['ldesc2']));
	} else {
		$err[15]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une deuxieme description française.</font></p>';
	}
	if ((trim($_POST['ldesc2u'])) != '') {//on a une description
		$des2u=escape_data(htmlentities($_POST['ldesc2u']));
	} else {
		$err[16]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une deuxieme description anglaise.</font></p>';
	}
	
	//validation description 3
	if ((trim($_POST['ldesc3'])) != '') {//on a une description
		$des3f=escape_data(htmlentities($_POST['ldesc3']));
	} else {
		$err[17]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une troisième description française.</font></p>';
	}
	if ((trim($_POST['ldesc3u'])) != '') {//on a une description
		$des3u=escape_data(htmlentities($_POST['ldesc3u']));
	} else {
		$err[18]=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une troisième description anglaise.</font></p>';
	}
	
	//Les photos
	$nombre=$_POST['checkpic'];
	//on compte le nombre de checkbox choisi
	$total=count($nombre);
	//mise en place d'un flag
	$photok=FALSE;
	//on verifie que l'on a pas plus de 2 photo choisi
	if ($total > 2) {//on ne peut pas avoir plus de deux photos
		$errors[]='<p><font color="red"> - Vous ne pouvez pas choisir plus de deux photographies pour votre page.</font></p>';
	} elseif ($total < 1) {//on a choisi aucune photo 
		$photo1='';
		$photo2='';
		$photok=TRUE;
	} else {
		if (isset($nombre[0])) {
			$photo1=$nombre[0];
		} else {
			$photo2='';
		}
		if (isset($nombre[1])) {
			$photo2=$nombre[1];
		} else {
			$photo2='';
		}
		$photok=TRUE;
	}
	
	if (empty($errors)) {// on a aucune erreur
		//mise à jour de vsyscommerces
		if (!empty($dbset)) { //il y a quelquechose à mettre à jour
			$long=strlen($dbset);
			//on enleve la derniere virgule
			$n_dbset = substr($dbset,0,$long-1);
			$query = "UPDATE vsyscommerces SET $n_dbset WHERE v_EtabID = $etab_id";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (!$result) {
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
				<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
				<p>Impossible d'enregistrer les changements dans la base de données.</p><br />
				</div>
				<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
			}
						
		}// fin de "if (!empty($dbset))
		
		if ($photok) {// on verifie les photos
			//première photo
			if (($photo1 != $v_Details[0]) && ($photo1 != $v_Details[1])) {
				$query="UPDATE vsyscomdetails SET v_Details = '$photo1' WHERE v_EtabID = $etab_id AND v_Detailtype=1";
				$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
				if (!$result) {
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
					<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
					<p>Impossible d'enregistrer la première photo dans la base de données.</p><br />
					</div>
					<?php
					print_ligne(12);
					$menu_choix =NULL;
					include ('./includes/footerUnCol.php');
					exit();
				}
			}
			//deuxième photo
			if (($photo2 != $v_Details[0]) && ($photo2 != $v_Details[1])) {
				$query="UPDATE vsyscomdetails SET v_Details = '$photo2' WHERE v_EtabID = $etab_id AND v_Detailtype=2";
				$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
				if (!$result) {
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
					<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
					<p>Impossible d'enregistrer la deuxième photo dans la base de données.</p><br />
					</div>
					<?php
					print_ligne(12);
					$menu_choix =NULL;
					include ('./includes/footerUnCol.php');
					exit();
				}
			}
		} // fin de "if ($photok) {
		
		// description
		if ($des1f != $v_Details[2]) {
			$query="UPDATE vsyscomdetails SET v_Details = '$des1f' WHERE v_EtabID = $etab_id AND v_Detailtype=3";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (!$result) {
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
				<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
				<p>Impossible d'enregistrer la première description française dans la base de données.</p><br />
				</div>
				<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
			}
		}
		if ($des2f != $v_Details[3]) {
			$query="UPDATE vsyscomdetails SET v_Details = '$des2f' WHERE v_EtabID = $etab_id AND v_Detailtype=4";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (!$result) {
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
				<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
				<p>Impossible d'enregistrer la deuxième description française dans la base de données.</p><br />
				</div>
				<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
			}
		}
		if ($des3f != $v_Details[4]) {
			$query="UPDATE vsyscomdetails SET v_Details = '$des3f' WHERE v_EtabID = $etab_id AND v_Detailtype=5";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (!$result) {
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
				<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
				<p>Impossible d'enregistrer la troisième description française dans la base de données.</p><br />
				</div>
				<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
			}
		}
		if ($des1u != $v_Details[5]) {
			$query="UPDATE vsyscomdetails SET v_Details = '$des1u' WHERE v_EtabID = $etab_id AND v_Detailtype=6";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (!$result) {
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
				<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
				<p>Impossible d'enregistrer la première description anglaise dans la base de données.</p><br />
				</div>
				<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
			}
		}
		if ($des2u != $v_Details[6]) {
			$query="UPDATE vsyscomdetails SET v_Details = '$des2u' WHERE v_EtabID = $etab_id AND v_Detailtype=7";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (!$result) {
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
				<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
				<p>Impossible d'enregistrer la deuxième description anglaise dans la base de données.</p><br />
				</div>
				<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
			}
		}
		if ($des3u != $v_Details[7]) {
			$query="UPDATE vsyscomdetails SET v_Details = '$des3u' WHERE v_EtabID = $etab_id AND v_Detailtype=8";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (!$result) {
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
				<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
				<p>Impossible d'enregistrer la troisième description anglaise dans la base de données.</p><br />
				</div>
				<?php
				print_ligne(12);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
			}
		}
		
		if (isset($FileMove)) {
			//renommer le dossier
			$old="../images/$v_EtabFileNom";
			$new="../images/$file";
			rename($old,$new);
		}
		
		//affichage de fin car tout est okay
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
			<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
			<p>Les détails de l'établissement ont été modifiés avec succès.</p><br />
			</div>
			<?php
			print_ligne(12);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
	} // fin de "if (empty($errors))
	
		
}// fin de "if (isset($_POST['soumis'])) {
?>
	<div id="longHaut">
	  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
	</div>
	<div id="longMilieu">
<?php	
	$header='etab';
	$lienactif='etab2';
	include('./includes/admin.php'); 
	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Modifier "<?php echo $v_EtabNom; ?>"</span></p><br />
<p>Changez les détails de l'établissement.</p><br />
<?php
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	}
?>
<form action="ad_etab2mod.php" method="post">
<input type="hidden" name="etab" value="<?php echo $etab_id; ?>" />
<fieldset><legend>Modifier l'identité :</legend><br />
<table width="100%" border="0" cellpadding="5">
	<tr>
	<?php
	//nom de l'etablissement
	echo '<td width="40%" align="left" class="photo">';
	if ($err[0]) {
		echo '<font color="red">Nom :</font>';
	} else {
		echo 'Nom :';
	}
	echo "</td>\n";
	echo '<td width="60%" align="left"><input type="text" name="lnom" size="25" maxlength="50" value="';
	if (isset($_POST['lnom'])) {
		echo $_POST['lnom'];
	} else {
		echo $v_EtabNom;
	}
	echo "\" /></td>\n</tr>\n";
	
	//membre relié
	echo '<tr><td class="photo">Membre :</td>';
	echo '<td><select name="lmembre">';
	$count=count($mem_id)-1;
	for ($i=0; $i<=$count; $i++) {
		echo '<option value="' . $mem_id[$i] . '"';
		if (isset($_POST['lmembre'])) {
			if ($_POST['lmembre'] == $mem_id[$i]) {
				echo ' selected="selected"';
			}
		} elseif ($v_MembreID == $mem_id[$i]) {
			echo ' selected="selected"';
		}
		echo ">{$mem_nom[$i]}</option>\n";
	}
	echo "</select>\n</td>\n</tr>\n";
	
	//adresse
	echo '<tr><td class="photo">Adresse :</td>';
	echo '<td><select name="lrue">';
	for ($i=1; $i<=100; $i++) {
		echo '<option value="' . $i . '"';
		if (isset($_POST['lrue'])) {
			if ($_POST['lrue'] == $i) {
				echo ' selected="selected"';
			}
		} elseif ($v_EtabNumero == $i) {
			echo ' selected="selected"';
		}
		echo ">$i</option>\n";
	}
	echo "</select>\n <select name=\"ladresse\">\n";
	$count=count($rue_id)-1;
	for ($i=0; $i<=$count; $i++) {
		echo '<option value="' . $rue_id[$i] . '"';
		if (isset($_POST['ladresse'])) {
			if ($_POST['ladresse'] == $rue_id[$i]) {
				echo ' selected="selected"';
			}
		} elseif ($v_RueID == $rue_id[$i]) {
			echo ' selected="selected"';
		}
		echo ">{$rue_nom[$i]}</option>\n";
	}
	echo "</select>\n</td>\n</tr>\n";
	
	//telephone
	echo '<tr><td class="photo">';
	if ($err[1]) {
		echo '<font color="red">Téléphone :</font>';
	} else {
		echo 'Téléphone';
	}
	echo "</td>\n";
	echo "\n";
	echo '<td class="option"><input type="text" name="lphone" size="20" maxlength="14" value="';
	if (isset($_POST['lphone'])) {
		echo $_POST['lphone'];
	} else {
		echo $v_EtabPhone;
	}
	echo "\" /> optionnel</td>\n</tr>\n";
	
	//fax
	echo '<tr><td class="photo">';
	if ($err[2]) {
		echo '<font color="red">Fax :</font>';
	} else {
		echo 'Fax';
	}
	echo "</td>\n";
	echo "\n";
	echo '<td class="option"><input type="text" name="lfax" size="20" maxlength="14" value="';
	if (isset($_POST['lfax'])) {
		echo $_POST['lfax'];
	} else {
		echo $v_EtabFax;
	}
	echo "\" /> optionnel</td>\n</tr>\n";
	
	//Mobile
	echo '<tr><td class="photo">';
	if ($err[3]) {
		echo '<font color="red">Mobile :</font>';
	} else {
		echo 'Mobile';
	}
	echo "</td>\n";
	echo "\n";
	echo '<td class="option"><input type="text" name="lmobile" size="20" maxlength="14" value="';
	if (isset($_POST['lmobile'])) {
		echo $_POST['lmobile'];
	} else {
		echo $v_EtabMobile;
	}
	echo "\" /> optionnel</td>\n</tr>\n";
	
	//Internet
	echo '<tr><td class="photo">';
	if ($err[4]) {
		echo '<font color="red">URL :</font>';
	} else {
		echo 'URL';
	}
	echo "</td>\n";
	echo "\n";
	echo '<td class="option"><input type="text" name="lurl" size="25" maxlength="120" value="';
	if (isset($_POST['lurl'])) {
		echo $_POST['lurl'];
	} else {
		echo $v_EtabURL;
	}
	echo "\" /> optionnel</td>\n</tr>\n";
	
	//Email
	echo '<tr><td class="photo">';
	if ($err[5]) {
		echo '<font color="red">Email :</font>';
	} else {
		echo 'Email';
	}
	echo "</td>\n";
	echo "\n";
	echo '<td class="option"><input type="text" name="lemail" size="25" maxlength="120" value="';
	if (isset($_POST['lemail'])) {
		echo $_POST['lemail'];
	} else {
		echo $v_EtabEmail;
	}
	echo "\" /> optionnel</td>\n</tr></table>\n</fieldset>\n<br />\n<fieldset><legend>Modifier les détails : </legend>";
	
	echo '<br /><table width="100%" border="0" cellpadding="5">';
	
	//nom des responsables
	echo '<tr><td width="35%" align="left" class="photo">';
	if ($err[6]) {
		echo '<font color="red">Responsable 1 :</font>';
	} else { 
		echo 'Responsable 1 :';
	}
	echo "</td>\n";
	echo '<td width="65%" align="left"><input type="text" name="lresp1" size="30" maxlength="60" value="';
	if (isset($_POST['lresp1'])) {
		echo $_POST['lresp1'];
	} else {
		echo $v_EtabResponsable1;
	}
	echo "\" /></td>\n</tr>\n";
	
	//nom des responsables
	echo '<tr><td class="photo">';
	if ($err[7]) {
		echo '<font color="red">Responsable 2 :</font>';
	} else { 
		echo 'Responsable 2 :';
	}
	echo "</td>\n";
	echo '<td class="option"><input type="text" name="lresp2" size="30" maxlength="60" value="';
	if (isset($_POST['lresp2'])) {
		echo $_POST['lresp2'];
	} else {
		echo $v_EtabResponsable2;
	}
	echo "\" /> optionnel</td>\n</tr>\n";
	
	//catégorie
	echo '<tr><td class="photo">Catégorie :</td>';
	echo '<td><select name="ltype">';
	$count=count($cat_id)-1;
	for ($i=0; $i<=$count; $i++) {
		echo '<option value="' . $cat_id[$i] . '"';
		if (isset($_POST['ltype'])) {
			if ($_POST['ltype'] == $cat_id[$i]) {
				echo ' selected="selected"';
			}
		} elseif ($v_ComTypeID == $cat_id[$i])  {
			echo ' selected="selected"';
		}
		echo "\">{$cat_nom[$i]}</option>\n";
	}
	echo "</select>\n</td>\n</tr>\n";
	
	//activité
	echo '<tr><td class="photo">';
	if ($err[8]) {
		echo '<font color="red">Activité :</font>';
	} else {
		echo 'Activité :';
	}
	echo "</td>\n";
	echo '<td><input type="text" name="lactivite" size="35" maxlength="120" value="';
	if (isset($_POST['lactivite'])) {
		echo $_POST['lactivite'];
	} else {
		echo $v_EtabActivite;
	}
	echo "\" /></td>\n</tr>\n";
	
	//activité en anglais
	echo '<tr><td class="photo">';
	if ($err[9]) {
		echo '<font color="red">Activité (Anglais):</font>';
	} else {
		echo 'Activité (Anglais):';
	}
	echo "</td>\n";
	echo '<td><input type="text" name="lactiviteuk" size="35" maxlength="120" value="';
	if (isset($_POST['lactiviteuk'])) {
		echo $_POST['lactiviteuk'];
	} else {
		echo $v_EtabActiviteUK;
	}
	echo "\" /></td>\n</tr>\n";
	
	//dossier du commerce
	echo '<tr><td class="photo">';
	if ($err[10]) {
		echo '<font color="red">Dossier :</font>';
	} else {
		echo 'Dossier :';
	}
	echo "</td>\n";
	echo '<td><input type="text" name="ldossier" size="35" maxlength="8" value="';
	if (isset($_POST['ldossier'])) {
		echo $_POST['ldossier'];
	} else {
		echo $v_EtabFileNom;
	}
	echo "\" /></td>\n</tr>\n";
	
	//actif
	echo '<tr><td class="photo">Commerce Actif :</td>';
	echo "\n<td>";
	echo '<select name="lactif">';
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
	echo "\n</select>\n</td>\n</tr>\n</table>\n</fieldset>\n<br />\n<fieldset><legend>Modifier les Horaires d'ouverture : </legend>";
	
	echo '<br /><table width="100%" border="0" cellpadding="5">';
	
	//premiere plage horaire
	echo "<tr>\n";
	//Heure d'ouverture matin
	echo '<td align="left" width="30%" class="photo">';
	if ($err[11]) {
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
			if ($_POST['heureOnAM'] == $value ) {
				echo ' selected="selected"';
			}
		} elseif ($v_HoraireOnMatin == $value) {
			echo ' selected="selected"';
		}
		echo ">$value</option>\n";
	}
	echo "</select>\n à <select name=\"heureOffAM\">";
	foreach ($heures as $value) {
		echo '<option value="' . $value . '"';
		if (isset($_POST['heureOffAM'])) {
			if ($_POST['heureOffAM'] == $value ) {
				echo ' selected="selected"';
			}
		} elseif ($v_HoraireOffMatin == $value) {
			echo ' selected="selected"';
		}
		echo ">$value</option>\n";
	}
	echo "</select>\n</td>\n</tr>\n";
	
	//Heure d'ouverture Soir
	echo '<td align="left" width="30%" class="photo">';
	if ($err[12]) {
		echo '<font color="red">2ème Plage :</font>';
	} else {
		echo '1ère Plage :';
	}
	echo "</td>\n";
	echo '<td align="left" width="70%" class="photo">De ';
	echo '<select name="heureOnPM">';
	foreach ($heures as $value) {
		echo '<option value="' . $value . '"';
		if (isset($_POST['heureOnPM'])) {
			if ($_POST['heureOnPM'] == $value ) {
				echo ' selected="selected"';
			}
		} elseif ($v_HoraireOnSoir == $value) {
			echo ' selected="selected"';
		}
		echo ">$value</option>\n";
	}
	echo "</select>\n à <select name=\"heureOffPM\">";
	foreach ($heures as $value) {
		echo '<option value="' . $value . '"';
		if (isset($_POST['heureOffPM'])) {
			if ($_POST['heureOffPM'] == $value ) {
				echo ' selected="selected"';
			}
		} elseif ($v_HoraireOffSoir == $value) {
			echo ' selected="selected"';
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
	//on remplit la grille avec les données
	if (isset($_POST['leDimanche'])) {
		$dimanche=$_POST['leDimanche'];
	} else {
		$dimanche=$v_dimanche;
	}
	if (isset($_POST['leLundi'])) {
		$lundi=$_POST['leLundi'];
	} else {
		$lundi=$v_lundi;
	}
	if (isset($_POST['leMardi'])) {
		$mardi=$_POST['leMardi'];
	} else {
		$mardi=$v_mardi;
	}
	if (isset($_POST['leMercredi'])) {
		$mercredi=$_POST['leMercredi'];
	} else {
		$mercredi=$v_mercredi;
	}
	if (isset($_POST['leJeudi'])) {
		$jeudi=$_POST['leJeudi'];
	} else {
		$jeudi=$v_jeudi;
	}
	if (isset($_POST['leVendredi'])) {
		$vendredi=$_POST['leVendredi'];
	} else {
		$vendredi=$v_vendredi;
	}
	if (isset($_POST['leSamedi'])) {
		$samedi=$_POST['leSamedi'];
	} else {
		$samedi=$v_samedi;
	}
	
	fill_closed_day ('Dimanche', $dimanche);
	fill_closed_day ('Lundi', $lundi);
	fill_closed_day ('Mardi', $mardi);
	fill_closed_day ('Mercredi', $mercredi);
	fill_closed_day ('Jeudi', $jeudi);
	fill_closed_day ('Vendredi', $vendredi);
	fill_closed_day ('Samedi', $samedi);
	echo "</table>\n</td>\n</tr>\n</table>\n</fieldset>\n<br />\n<fieldset><legend>Descriptions : </legend>";
	
	echo '<br /><table width="100%" border="0" cellpadding="5">';
	//description 1
	echo '<tr><td width="100%" align="left" class="photo">';
	if ($err[13]) {
		echo '<font color="red">Première description Française :</font>';
	} else {
		echo 'Première description Française :';
	}
	echo "</td></tr>\n<tr>";
	echo '<td width="100%"><textarea name="ldesc1" cols="55" rows="4">';
	if (isset($_POST['ldesc1'])) {
		echo $_POST['ldesc1'];
	} else {
		echo stripslashes($v_Details[2]);
	}
	echo "</textarea></td>\n</tr>";
	echo '<tr><td width="100%" align="left" class="photo">';
	if ($err[14]) {
		echo '<font color="red">Première description Anglaise :</font>';
	} else {
		echo 'Première description Anglaise :';
	}
	echo "</td></tr>\n<tr>";
	echo '<td width="100%"><textarea name="ldesc1u" cols="55" rows="4">';
	if (isset($_POST['ldesc1u'])) {
		echo $_POST['ldesc1u'];
	} else {
		echo stripslashes($v_Details[5]);
	}
	echo "</textarea></td>\n</tr>";
	
	//description 2
	echo '<tr><td width="100%" align="left" class="photo">';
	if ($err[15]) {
		echo '<font color="red">Deuxième description Française :</font>';
	} else {
		echo 'Deuxième description Française :';
	}
	echo "</td></tr>\n<tr>";
	echo '<td width="100%"><textarea name="ldesc2" cols="55" rows="4">';
	if (isset($_POST['ldesc2'])) {
		echo $_POST['ldesc2'];
	} else {
		echo stripslashes($v_Details[3]);
	}
	echo "</textarea></td>\n</tr>";
	echo '<tr><td width="100%" align="left" class="photo">';
	if ($err[16]) {
		echo '<font color="red">Deuxième description Anglaise :</font>';
	} else {
		echo 'Deuxième description Anglaise :';
	}
	echo "</td></tr>\n<tr>";
	echo '<td width="100%"><textarea name="ldesc2u" cols="55" rows="4">';
	if (isset($_POST['ldesc2u'])) {
		echo $_POST['ldesc2u'];
	} else {
		echo stripslashes($v_Details[6]);
	}
	echo "</textarea></td>\n</tr>";
	
	//description 3
	echo '<tr><td width="100%" align="left" class="photo">';
	if ($err[17]) {
		echo '<font color="red">Troisième description Française :</font>';
	} else {
		echo 'Troisième description Française :';
	}
	echo "</td></tr>\n<tr>";
	echo '<td width="100%"><textarea name="ldesc3" cols="55" rows="4">';
	if (isset($_POST['ldesc3'])) {
		echo $_POST['ldesc3'];
	} else {
		echo stripslashes($v_Details[4]);
	}
	echo "</textarea></td>\n</tr>";
	echo '<tr><td width="100%" align="left" class="photo">';
	if ($err[18]) {
		echo '<font color="red">Troisième description Anglaise :</font>';
	} else {
		echo 'Troisième description Anglaise :';
	}
	echo "</td></tr>\n<tr>";
	echo '<td width="100%"><textarea name="ldesc3u" cols="55" rows="4">';
	if (isset($_POST['ldesc3u'])) {
		echo $_POST['ldesc3u'];
	} else {
		echo stripslashes($v_Details[7]);
	}
	echo "</textarea></td>\n</tr>\n</table>\n</fieldset>\n<br />\n<fieldset><legend>Photos : </legend>";
	
	echo '<br /><table width="100%" border="0" cellpadding="5">';
	
	//on met en place les images thumbnails
	$counter=0;
	//creation du nombre de photo
	$nbimg=count($v_PictNom)-1;
	for ($i=0; $i<=$nbimg; $i++) {
		$counter++;
		echo '<td width="33%" align="center" class="miniphoto">';				
		//creation des nom d'images
		$picture = '../images/' . $v_EtabFileNom . '/' . $v_PictNom[$i];
		//creation du nom de la vignette
		$newvalue= str_replace('.', '_th.', $v_PictNom[$i]);
		$thumb = '../images/' . $v_EtabFileNom . '/' . $newvalue;
		//on verifie que la vignette n'existe pas
		if (!file_exists($thumb)) {//on la construit
			$thumb = createthumb ($picture, 100, 100);
		}
		if ($la_photo= @getimagesize($thumb)) {
			$w=(int)($la_photo[0]/2);
			$h=(int)($la_photo[1]/2);
			echo '<img src="' . $thumb . '" alt="' . $v_PictNomShow[$i] . '" width="' . $w . '" height="' . $h . '" title="' . $v_PictNomShow[$i] . '" />';
		}
		if (($v_PictNom[$i] == $v_Details[0]) or ($v_PictNom[$i] == $v_Details[1])) {//l'image match la photo de l'établissement
			echo '<br /><input type="checkbox" name="checkpic[]" value="' . $v_PictNom[$i] . '" checked="checked" /><font color="blue">' . $v_PictNomShow[$i]. '</font></td>';
		} else {
			echo '<br /><input type="checkbox" name="checkpic[]" value="' . $v_PictNom[$i] . '" />' . $v_PictNomShow[$i] . '</td>';
		}
		if ( ($counter / 3) == ((int)($counter / 3))) {	// nouveau row
			echo "</tr><tr>\n";
			$flag=FALSE;
		} else {
			$flag=TRUE;
		}
	}// FIN de "foreach ($images as $value )"
	if (!$flag) {
		echo "</tr>\n";
	}
	
	
	?>
</table>
</fieldset>
<input type="hidden" name="soumis" value="TRUE"/>
<br /><table width="100%" border="0" cellpadding="5"><tr><td align="center" width="100%"><input type="submit" name="submit" value="Modifier l'établissement &quot;<?php echo $v_EtabNom; ?>&quot;" /></td></tr></table>
</form>
</div>
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
