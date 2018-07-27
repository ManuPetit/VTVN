<?php # script : ad_profil_mod.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier un profil.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

//preparation des variables
$e1=FALSE;
$e2=FALSE;
$e3=FALSE;
$e4=FALSE;
$badQuery=FALSE;
if ((isset($_GET['memid'])) && (is_numeric($_GET['memid']))) {
	$mem_id=$_GET['memid'];
} elseif ((isset($_POST['memid'])) && (is_numeric($_POST['memid']))) {
	$mem_id=$_POST['memid'];
} else {
	$badQuery=TRUE;
}

//requete photo
$query="SELECT v_ImageFile, v_ImageNom FROM vsysimages WHERE v_ImageMembreID=0 OR v_ImageMembreID=$mem_id ORDER by v_ImageFile ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$img_file=array();
	$img_nom=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$img_file[]=$row['v_ImageFile'];
		$img_nom[]=$row['v_ImageNom'];
	}
} else {
	$badQuery=TRUE;
}

//requete groupe
$groupe=array();//type de membres
$grp_id=array();
$query="SELECT v_GroupeID, v_GroupeNom FROM vsysgroupe ORDER BY v_GroupeNom DESC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		//on retrouve nos groupes
		$grp_id[]=$row['v_GroupeID'];
		$groupe[]=$row['v_GroupeNom'];
	}
} else {
	$badQuery=TRUE;
}

if (! $badQuery) {
	//faire la requete des détails du membre
	$query="SELECT v_MembreIdentite, v_MembreLive, v_MembreActive, v_MembrePrenom, v_MembreNom, v_GroupeID, v_MembreImage, v_MembreEmail FROM vsysmembres WHERE v_MembreID=$mem_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_ASSOC);
		$mem_ident=$row['v_MembreIdentite'];
		$mem_live=$row['v_MembreLive'];
		$mem_active=$row['v_MembreActive'];
		$mem_prenom=$row['v_MembrePrenom'];
		$mem_nom=$row['v_MembreNom'];
		$mem_groupe=$row['v_GroupeID'];
		$mem_image=$row['v_MembreImage'];
		$mem_email=$row['v_MembreEmail'];
	} else {
		$badQuery=TRUE;
	}
}

if (isset($_POST['soumis'])) {//on a soumis la forme
	$errors=array();
	
	//verifier pour un nom d'identifiant (3 à 15 lettres)
	if (eregi ('^[[:alpha:]]{3,15}$', stripslashes(trim($_POST['lident'])))) {
		$n_ident = escape_data($_POST['lident']);
	} else {
		$e1=TRUE;
		$n_ident = FALSE;
		$errors[] = '<p><font color="red"> - Veuillez v&eacute;rifier que vous avez correctement entr&eacute; l\'identifiant.</font></p>';
	}
	
	//verifier pour un prenom d'identifiant (3 à 20 lettres)
	if (eregi ('^[[:alpha:] éèêôùëûçïî]{3,20}$', stripslashes(trim($_POST['lprenom'])))) {
		$n_prenom = escape_data($_POST['lprenom']);		
	} else {
		$n_prenom = FALSE;
		$e2=TRUE;
		$errors[] = '<p><font color="red"> - Le prénom que vous avez saisi n\'est pas correct..</font></p>';
	}// fin de "if (eregi ('^[[:alpha:]]{3,20}$', stripslashes(trim($_POST['prenom']))))"
	
	//verifier pour un prenom d'identifiant (3 à 25 lettres)
	if (eregi ('^[[:alpha:] éèêôùëûçîï]{3,25}$', stripslashes(trim($_POST['lnom'])))) {
		$n_nom = escape_data($_POST['lnom']);		
	} else {
		$n_nom = FALSE;
		$e3=TRUE;
		$errors[] = '<p><font color="red"> - Le nom que vous avez saisi n\'est pas correct.</font></p>';
	}//fin de "if (eregi ('^[[:alpha:]]{3,25}$', stripslashes(trim($_POST['nom']))))"

	//verification de la validité de l'addresse email fournie
	if (trim($_POST['lemail']) != '') {
		if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['lemail'])))){
			$n_email=escape_data($_POST['lemail']);
		} else {
			$e4=TRUE;
			$n_email=FALSE;
			$errors[]='<p><font color="red"> - L\'email que vous avez saisie n\'est pas correcte..</font></p>';
		}// fin de "if (eregi ('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,4}$',stripslashes(trim($_POST['email']))))"
	} else {
		$n_email=TRUE;
	}

	if ($n_ident && $n_prenom && $n_nom && $n_email) {//aucune erreur sur ces entrees
		if (isset($_POST['lpass'])) {//on doit créer un nouveau mot de passe et faire parvenir au webmaster
			$n_pass=make_password(10);
		} else {
			$n_pass=FALSE;
		}
		
		//on verifie qu'il y a des changement  a faire dans la base de donnée
		$message=FALSE;
		
		if ($n_ident != $mem_ident) {
			$message .= " v_MembreIdentite = '$n_ident',";
		}
		
		if ($n_pass) {
			$message .= " v_MembreMotPasse = SHA('$n_pass'),";
		}
		
		if ($_POST['llive'] != $mem_live) {
			$message .= " v_MembreLive = " . $_POST['llive'] . ",";
		}
		
		if ($_POST['lactive'] != $mem_active) {
			$message .= " v_MembreActive = " . $_POST['lactive'] . ",";
		}
		
		if ($n_prenom != $mem_prenom) {
			$message .= " v_MembrePrenom = '$n_prenom',";
		}
		
		if ($n_nom != $mem_nom) {
			$message .= " v_MembreNom = '$n_nom',";
		}
		
		if ($_POST['lgroupe'] != $mem_groupe) {
			$message .= " v_GroupeID = " . $_POST['lgroupe'] . ",";
		}
		
		if ($_POST['limage'] != $mem_image) {
			$message .= " v_MembreImage = '" . $_POST['limage'] . "',";
		}
		
		if (($n_email != $mem_email) && ($n_email != TRUE)){
			$message .= " v_MembreEmail = '$n_email',";
		}
		
		
		if ($message) { // on a des changements
			$long=strlen($message);
			//on enleve la derniere virgule
			$n_message = substr($message,0,$long-1);
			$query="UPDATE vsysmembres SET $n_message WHERE v_MembreID=$mem_id";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if ($n_pass) {//envoi du mail
				$body="Nouveau mot de passe : $n_pass \nà transmettre au membre \nnuméro : $mem_id \nidentifiant : ";
				if ($n_ident != $mem_ident) {
					$body .= '$n_ident\n';
				} else {
					$body .= '$mem_ident\n';
				}
				mail('webmaster@vieuxnyons.com','Nouveau mot de passe',$body,'From : administration@vieuxnyons.com');
			}
			?>
				<div id="longHaut">
				  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
				</div>
				<div id="longMilieu">
			<?php	
				$header='profils';
				$lienactif=NULL;
				include('./includes/admin.php'); 
				echo'<div id="mainMemb">';
			?>
			<p><span class="sstitre">Modifier un profil</span></p><br />
				<p>Le profil selectionné a été modifié.</p></div>
				
			<?php
				print_ligne(10);
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
				$header='profils';
				$lienactif=NULL;
				include('./includes/admin.php'); 
				echo'<div id="mainMemb">';
			?>
			<p><span class="sstitre">Modifier un profil</span></p><br />
				<p>Aucun changement n'a été effectué dans la base de données.</p></div>
				
			<?php
				print_ligne(10);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		} //fin de "if ($message) { 
		
	} // FIN DE "if ($n_iden && $n_prenom && $n_nom && $n_email)
		
}// fin de "if (isset($_POST['soumis']))
if ($badQuery) {
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='profils';
		$lienactif=NULL;
		include('./includes/admin.php'); 
		echo'<div id="mainMemb">';
	?>
	<p><span class="sstitre">Modifier un profil</span></p><br />
		<p>Il est impossible au systeme de récuperer les détails du membre à modifier. Veuillez contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //  FIN DE "if ($badQuery) {

?>
<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='profils';
	$lienactif='profil2';
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Modifier un profil</span></p><br />
<p>Faites les changements nécessaires au profil suivant.</p><br />
<?php 
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	} 
?>
<fieldset><legend>Modifier le profil :</legend>
<br />
<table width="100%" border="0" cellpadding="5">
	<form action="ad_profil_mod.php" method="post">
	<?php
		//affichage identifiant
		echo '<tr><td width="40%" align="left" class="photo">';
		if ($e1==TRUE) {
			echo '<font color="red">Identifiant :</font>';
		} else {
			echo 'Identifiant :';
		}
		echo '</td><td width="60%" align="left"><input type="text" name="lident" size="20" maxlenght="15" value="';
		if (isset($_POST['lident'])) {
			echo $_POST['lident'];
		} else {
			echo $mem_ident;
		}
		echo '" /></td>';		
		echo "</tr>\n";
		
		//affichage mot de passe
		echo '<tr><td class="photo">Mot de passe :</td><td class="photo"><input type="checkbox" name="lpass" value="TRUE" /> Générer mot de passe</td>';
		echo "</tr>\n";
		
		//affichage live
		echo '<tr><td class="photo">Membre live :</td><td><select name="llive">';
		if ($mem_live==0) {//membre n'est pas live
			echo '<option value="0" selected="selected">Non</option><option value="1">Oui</option>';
		} else {
			echo '<option value="0">Non</option><option value="1" selected="selected">Oui</option>';
		}
		echo '</select></td>';
		echo "</tr>\n";
		
		//affichage actif
		echo '<tr><td class="photo">Membre activé :</td><td><select name="lactive">';
		if ($mem_active==0) {//membre n'est pas active
			echo '<option value="0" selected="selected">Non Actif</option><option value="1">Activation en cours</option><option value="2">Activé</option>';
		} elseif ($mem_active==1) {//membre en cours d'activation
			echo '<option value="0">Non Actif</option><option value="1" selected="selected">Activation en cours</option><option value="2">Activé</option>';
		} else { //membre active
			echo '<option value="0">Non Actif</option><option value="1">Activation en cours</option><option value="2" selected="selected">Activé</option>';
		}
		echo '</select></td>';
		echo "</tr>\n";
		
		//affichage prenom
		echo '<tr><td class="photo">';
		if ($e2==TRUE) {
			echo '<font color="red">Prénom :</font>';
		} else {
			echo 'Prénom :';
		}
		echo '</td><td><input type="text" name="lprenom" size="20" maxlenght="20" value="';
		if (isset($_POST['lprenom'])) {
			echo $_POST['lprenom'];
		} else {
			echo $mem_prenom;
		}
		echo '" /></td>';		
		echo "</tr>\n";
		
		//affichage nom
		echo '<tr><td class="photo">';
		if ($e3==TRUE) {
			echo '<font color="red">Nom :</font>';
		} else {
			echo 'Nom :';
		}
		echo '</td><td><input type="text" name="lnom" size="20" maxlenght="20" value="';
		if (isset($_POST['lnom'])) {
			echo $_POST['lnom'];
		} else {
			echo $mem_nom;
		}
		echo '" /></td>';		
		echo "</tr>\n";
		
		//affichage groupe
		echo '<tr><td class="photo">Groupe :</td>';
		echo '<td><select name="lgroupe">';
		$count=count($grp_id)-1;
		for ($i=0; $i<=$count;$i++) {
			echo '<option value="' . $grp_id[$i] . '"';
			if ($grp_id[$i]==$mem_groupe) {
				echo ' selected="selected"';
			}
			echo '>' . $groupe[$i] . '</option>';
		}
		echo "</select></td></tr>\n";
		
		//affichage image
		echo '<tr><td colspan="2" class="photo">Image du membre :</td></tr>';
		echo '<td colspan="2" align="center"><table width="100%" border="1" cellpadding="5"><tr>';
		$count=count($img_file)-1;
		$bas=0;
		for ($i=0; $i<=$count; $i++) {
			$bas++;
			echo '<td width="25%" align="center" class="miniphoto">';
			echo '<img src="../images/avatar/' . $img_file[$i] . '" width="25" height="25" /><br /><input type="radio" name="limage" value="' . $img_file[$i] . '"';
			if (isset($_POST['limage'])) {
				if ($_POST['limage']==$mem_image) {
					echo ' checked';
				}	
			} elseif ($mem_image==$img_file[$i]) {//l'image que l'on a est celle selectionnée
				echo ' checked';
			}
			echo ' />' . $img_nom[$i] . '</td>';
			if (($bas/4)==(int)($bas/4)) {
				$flag=TRUE;
				echo "</tr>\n<tr>";
			} else {
				$flag=FALSE;
			}
		}
		if (!$flag) {
			echo '</tr>';
		}				
		echo "</table></td></tr>\n";
		
		//affichage email
		echo '<tr><td width="40%" align="left" class="photo">';
		if ($e4==TRUE) {
			echo '<font color="red">Email :</font>';
		} else {
			echo 'Email :';
		}
		echo '</td><td width="60%" align="left"><input type="text" name="lemail" size="30" maxlenght="60" value="';
		if (isset($_POST['lemail'])) {
			echo $_POST['lemail'];
		} else {
			echo $mem_email;
		}
		echo '" /></td>';		
		echo "</tr>\n";	
		
	?>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Modifier les données de ce profil" /></td>
	</tr>
	<input type="hidden" name="soumis" value="TRUE" />	
	<input type="hidden" name="memid" value="<?php echo $mem_id; ?>" />
	</form>
</table>
</fieldset>
</div>
<?php
print_ligne(0);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
