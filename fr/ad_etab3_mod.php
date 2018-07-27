<?php # script : ad_etab3_mod.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Modifier une catégorie.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');


$e1=FALSE;
$e2=FALSE;
$badQuery=FALSE;
if ((isset($_GET['catid'])) && (is_numeric($_GET['catid']))) {
	$cat_id=$_GET['catid'];
} elseif ((isset($_POST['catid'])) && (is_numeric($_POST['catid']))) {
	$cat_id=$_POST['catid'];
} else {
	$badQuery=TRUE;
}

if (! $badQuery) {
	$query="SELECT v_ComNom, v_ComActive, v_ComNomUK FROM vsyscommercetype WHERE v_ComTypeID=$cat_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) == 1) {
		$row=mysql_fetch_array($result,MYSQL_ASSOC);
		$cat_nom=$row['v_ComNom'];
		$cat_active=$row['v_ComActive'];
		$cat_uk=$row['v_ComNomUK'];
	} else {
		$badQuery=TRUE;
	}
}

if ($badQuery) {//on a un probleme
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
	<p><span class="sstitre">Modifier une catégorie</span></p><br />
		<p>Il est impossible au systeme de récuperer les détails de la catégorie à modifier. Veuillez contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //  FIN DE "if ($badQuery) {

if (isset($_POST['soumis'])) {

	//verifier pour un nom  (3 à 20 lettres)
	if (eregi ('^[[:alpha:]àâçéèêëîïôöùû ]{3,20}$', stripslashes(trim($_POST['nom'])))) {
		$n_nom = escape_data($_POST['nom']);		
	} else {
		$n_nom = FALSE;
		$e1=TRUE;
		$errors[] = '<p><font color="red"> - Le nom de catégorie que vous avez saisi n\'est pas correct..</font></p>';
	}// fin de "if (eregi ('^[[:alpha:]]{3,20}$', stripslashes(trim($_POST['nom']))))"
	
	//verifier pour un nom anglais (3 à 20 lettres)
	if (eregi ('^[[:alpha:]àâçéèêëîïôöùû ]{3,20}$', stripslashes(trim($_POST['nomuk'])))) {
		$n_nomuk = escape_data($_POST['nomuk']);		
	} else {
		$n_nomuk = FALSE;
		$e2=TRUE;
		$errors[] = '<p><font color="red"> - Le nom Anglais de catégorie que vous avez saisi n\'est pas correct..</font></p>';
	}// fin de "if (eregi ('^[[:alpha:]]{3,20}$', stripslashes(trim($_POST['nom']))))"
	
	if ($n_nom && $n_nomuk) {//on a un nom valide
		$message=FALSE;
		
		if ($n_nom != $cat_nom) {
			$message .= " v_ComNom = '$n_nom',";
		}
		
		$n_actif=$_POST['actif'];
		if ($n_actif != $cat_active) {
			$message .= " v_ComActive = $n_actif,";
		}
		
		if ($n_nomuk != $cat_uk) {
			$message .= " v_ComNomUK = '$n_nomuk',";
		}
		
		if ($message) { // on a des changements
			$long=strlen($message);
			//on enleve la derniere virgule
			$n_message = substr($message,0,$long-1);
			$query="UPDATE vsyscommercetype SET $n_message WHERE v_ComTypeID=$cat_id";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if ($result) {
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
					<p><span class="sstitre">Modifier une catégorie</span></p><br />
					<p>La base de données a été modifiée.</p>
				</div>
				<?php
				print_ligne(13);
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
					$header='etab';
					$lienactif=NULL;
					include('./includes/admin.php'); 
					echo'<div id="mainMemb">';
				?>
					<p><span class="sstitre">Modifier une catégorie</span></p><br />
					<p>La base de données n'a pas été modifiée. Si cette erreur persiste, contacter votre administrateur.</p>
				</div>
				<?php
				print_ligne(13);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();	
			} //FIN de "if ($result) {
		
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
				<p><span class="sstitre">Modifier une catégorie</span></p><br />
				<p>Aucun changement n'a été effectué dans la base de données.</p>
			</div>
			<?php
			print_ligne(13);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();	
		} // fin de "if ($message) { 
	
	}// fin de "if ($n_nom)	
	
} //fin de "if (isset($_POST['soumis'])) {
?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='etab';
	$lienactif='etab4';
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Modifier une catégorie</span></p><br />
<?php 
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	} 
?>
<fieldset><legend>Modifier une catégorie :</legend>
<br />
<table width="100%" border="0" cellpadding="5">
	<form action="ad_etab3_mod.php" method="post">
	<tr>
		<td width="45%" align="left" class="photo">
		<?php
			if ($e1==TRUE) {
				echo '<font color="red">Nom de catégorie :</font>';
			} else {
				echo 'Nom de catégorie :';
			}
		?>
		</td>
		<td width="55%" align="left"><input type="text" name="nom" size="25" maxlength="20" value="<?php
		if (isset($_POST['nom'])) {
			echo $_POST['nom'];
		} else {
			echo $cat_nom;
		}
		?>" /></td>
	</tr>
	<tr>
		<td width="45%" align="left" class="photo">
		<?php
			if ($e2==TRUE) {
				echo '<font color="red">Nom en Anglais :</font>';
			} else {
				echo 'Nom en Anglais :';
			}
		?>
		</td>
		<td width="55%" align="left"><input type="text" name="nomuk" size="25" maxlength="20" value="<?php
		if (isset($_POST['nomuk'])) {
			echo $_POST['nomuk'];
		} else {
			echo $cat_uk;
		}
		?>" /></td>
	</tr>
	<tr>
		<td class="photo">Catégorie activée :</td>
		<td><select name="actif">
		<?php
			if (isset($_POST['actif'])) {
				$act=$_POST['actif'];
			} else {
				$act=$cat_active;
			}
			echo '<option value="0"';
			if ($act==0) {
				echo ' selected="selected"';
			}
			echo '>Non Activée</option><option value="1"';
			if ($act==1) {
				echo ' selected="selected"';
			}
			echo '>Activée</option>';
		?>
		</select></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Modifier la catégorie" /></td>
	</tr>
	<input type="hidden" name="soumis" value="TRUE" />
  	<input type="hidden" name="catid" value="<?php echo $cat_id; ?>" />
	</form>
</table>
</fieldset>
</div>
<?php
print_ligne(4);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>	
			
		
