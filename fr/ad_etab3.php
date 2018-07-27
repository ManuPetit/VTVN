<?php # script : ad_etab3.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des �l�ments de la page
$titre_page='Cr�er une cat�gorie.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$e1=FALSE;
$e2=FALSE;
$errors=array();
//on retrouve les cat�gories existantes
$query="SELECT v_ComNom FROM vsyscommercetype ORDER BY v_ComNom ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$categ=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$categ[]=$row['v_ComNom'];
	}
}

if (isset($_POST['soumis'])) {

	//verifier pour un nom (3 � 20 lettres)
	if (eregi ('^[[:alpha:]������������� ]{3,20}$', stripslashes(trim($_POST['nom'])))) {
		$n_nom = escape_data($_POST['nom']);		
	} else {
		$n_nom = FALSE;
		$e1=TRUE;
		$errors[] = '<p><font color="red"> - Le nom de cat�gorie que vous avez saisi n\'est pas correct..</font></p>';
	}// fin de "if (eregi ('^[[:alpha:]]{3,20}$', stripslashes(trim($_POST['nom']))))"
	
	//verifier pour un nom anglais (3 � 20 lettres)
	if (eregi ('^[[:alpha:]������������� ]{3,20}$', stripslashes(trim($_POST['nomuk'])))) {
		$n_nomuk = escape_data($_POST['nomuk']);		
	} else {
		$n_nomuk = FALSE;
		$e2=TRUE;
		$errors[] = '<p><font color="red"> - Le nom de cat�gorie que vous avez saisi n\'est pas correct..</font></p>';
	}// fin de "if (eregi ('^[[:alpha:]]{3,20}$', stripslashes(trim($_POST['nom']))))"
	
	if ($n_nom) {
		$actif=$_POST['active'];
		$query="INSERT INTO vsyscommercetype (v_ComNom, v_ComActive, v_ComNomUK) VALUES ('$n_nom', $actif, '$n_nomuk')";	
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

				<p><span class="sstitre">Cr�er une cat�gorie</span></p><br />
				<p>La cat�gorie a �t� cr��e dans la base de donn�es.</p></div>
			<?php
				print_ligne(14);
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

				<p><span class="sstitre">Cr�er une cat�gorie</span></p><br />
				<p>La cat�gorie n'a pas �t� cr��e dans la base de donn�es. Veuillez contacter l'administrateur si ce probl�me persiste.</p></div>
			<?php
				print_ligne(14);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		}// FIN DE "if ($result)
		
	}//fin de "if ($n_nom)

} // FIN DE "if (isset($_POST['soumis']))


?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='etab';
	$lienactif='etab3';
 	include('./includes/admin.php'); 
 	echo'<div id="mainMemb">';
?>

<p><span class="sstitre">Cr�er une cat�gorie</span></p><br />
<p>Cr�ez une nouvelle cat�gorie d'�tablissement.</p><br  />
<?php
	//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	} 
	
	if (isset($categ)) {//on a des categories existantes
		echo '<fieldset><legend>';
		$count=count($categ)-1;
		if ($count>0) {
			echo 'Cat�gories existantes :';
		} else {
			echo 'Cat�gorie existante :';
		}
		echo '<legend><br /><p>';
		for ($i=0; $i<=$count; $i++) {
			echo " - $categ[$i]<br />";
		}
		echo '</p></fieldset><br />';
		$ligne=0;
	} else {
		$ligne=2;
	}
?>
<fieldset><legend>Nouvelle cat�gorie :</legend><br />
<table width="100%" border="0" cellpadding="5">
	<form action="ad_etab3.php" method="post">
	<tr>
		<td width="45%" align="left" class="photo">
		<?
			if ($e1==TRUE) {
				echo '<font color="red">Nom de cat�gorie :</font>';
			} else {
				echo 'Nom de cat�gorie :';
			}
		?>
		</td>
		<td width="55%" align="left"><input type="text" name="nom" size="25" maxlength="20" value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>" /></td>
	</tr>
	<tr>
		<td width="45%" align="left" class="photo">
		<?
			if ($e2==TRUE) {
				echo '<font color="red">Nom en Anglais :</font>';
			} else {
				echo 'Nom en Anglais :';
			}
		?>
		</td>
		<td width="55%" align="left"><input type="text" name="nomuk" size="25" maxlength="20" value="<?php if (isset($_POST['nomuk'])) echo $_POST['nomuk']; ?>" /></td>
	</tr>
	<tr>
		<td class="photo">Cat�gorie activ�e :</td>
		<td><select name="active">
			<option value="0">Non</option>
			<option value="1" selected="selected">Oui</option>
		</select></td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="submit" name="submit" value="Cr�er la cat�gorie" /></td>
	</tr>
	<input type="hidden" name="soumis" value="TRUE" />
	</form>
</table>
</fieldset>	
</div>
	
<?php
print_ligne($ligne);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>