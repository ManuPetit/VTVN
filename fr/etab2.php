<?php # script : etab2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Changer mes descriptions.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconex.php');

$errors=array();

// requête pour trouver les descriptions 
$query="SELECT v_DetailType, v_Details, vd.v_EtabID AS EtabID FROM vsyscomdetails as vd INNER JOIN vsyscommerces as vc WHERE vd.v_EtabID=vc.v_EtabID AND vc.v_MembreID=$u_id AND ((vd.v_DetailType=3) OR (vd.v_DetailType=4) OR (vd.v_DetailType=5)) ORDER BY vd.v_DetailType ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//creation de la collection pour l'array
$desc=array();
//flag de requete
$requete=TRUE;
//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {//on proccess le resultat
		if ($row['v_DetailType'] == 3){//premiere description
			$desc[0]=stripslashes($row['v_Details']);
		}elseif ($row['v_DetailType'] == 4){//deuxième description
			$desc[1]=stripslashes($row['v_Details']);
		}elseif ($row['v_DetailType'] == 5){//troisième description
			$desc[2]=stripslashes($row['v_Details']);
		} else {
			$requete=FALSE;
			$errors[]='<p><font color="red"> - Erreur v010. Veuillez contacter votre administrateur..</font></p>';
		}
		$etab_id=$row['EtabID'];
	}// fin de "while ($row=mysql_fetch_array($result,MYSQL_ASSOC))"
	
}//fin de "if (@mysql_num_rows($result) >= 1)"

if (!$requete) {//on a des erreurs
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2>Bienvenue, <?php echo $prenom; ?> !</h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='etab';
		$lienactif=NULL;
		include('./includes/membmenu.php'); 
		echo'<div id="mainMemb">';
	?>
		<p><span class="sstitre">Changer mes descriptions</span></p><br />
		<p>Une erreur s'est produite, et vos données ne peuvent pas être rappatriées. Si le problème persiste, contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(13);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
}// fin de "if (!$requete)

if (isset($_POST['submitted'])) {//la forme a ete submitted
	$e1=FALSE;
	if (trim($_POST['desc1'])!='') {//on a une premiere description
		$des1=escape_data(htmlentities($_POST['desc1']));//on transforme le data pour enlever les risques de hacking		
	} else {
		$e1=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une première description.</font></p>';
		$des1='';
	}
			
	$e2=FALSE;
	if (trim($_POST['desc2'])!='') {//on a une deuxieme description
		$des2=escape_data(htmlentities($_POST['desc2']));//on transforme le data pour enlever les risques de hacking
	} else {
		$e2=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une deuxième description.</font></p>';
		$des2='';
	}
	
	$e3=FALSE;
	if (trim($_POST['desc3'])!='') {//on a une troisieme description
		$des3=escape_data(htmlentities($_POST['desc3']));//on transforme le data pour enlever les risques de hacking
	} else {
		$e3=TRUE;
		$errors[]='<p><font color="red"> - Vous avez omis d\'entrer une troisième description.</font></p>';
		$des3='';
	}
	
	if (($e1==FALSE) and ($e2==FALSE) and ($e3==FALSE)) {// on a pas d'erreurs mise à jour de la db
		
		$res1=FALSE;
		//creation de la requete
		if  ($des1 != $desc[0]) {//on a change le texte
			$query="UPDATE vsyscomdetails SET v_Details='$des1' WHERE v_EtabID=$etab_id AND v_DetailType=3";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (mysql_affected_rows() == 1) {// on a un resultat
				$res1=TRUE;
			} else {
				$errors[]='<p><font color="red"> - Erreur v011. Veillez contacter votre administrateur.</font></p>';
			}
		} //FIN de "if  ($des1 != $desc[0])"
		
		$res2=FALSE;
		if ($des2 != $desc[1]) {// on a change le texte
			$query="UPDATE vsyscomdetails SET v_Details='$des2' WHERE v_EtabID=$etab_id AND v_DetailType=4";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (mysql_affected_rows() == 1) {// on a un resultat
				$res2=TRUE;
			} else {
				$errors[]='<p><font color="red"> - Erreur v012. Veillez contacter votre administrateur.</font></p>';
			}
		} //FIN de "if  ($des2 != $desc[1])"
		
		$res3=FALSE;
		if ($des3 != $desc[2]) {// on a change le texte
			$query="UPDATE vsyscomdetails SET v_Details='$des3' WHERE v_EtabID=$etab_id AND v_DetailType=5";
			$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
			if (mysql_affected_rows() == 1) {// on a un resultat
				$res3=TRUE;
			} else {				
				$errors[]='<p><font color="red"> - Erreur v013. Veillez contacter votre administrateur.</font></p>';
			}
		} //FIN de "if  ($des3 != $desc[2])"
		
		//creation du mail pour le webmaster
		$body = "L&acute;&eacute;tablissement num&eacute;ro $etab_id a mis ses descriptions &agrave; jour. Il est n&eacute;cessaire de changer les descriptions anglaises.";				
				
		mail('webmaster@vieuxnyons.com', 'changement de descriptions',$body, 'From: administration@vieuxnyons.com');
		
		if ($res1 && $res2 && $res3) {//tout est ok db mise à jour
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
				echo '<p><span class="sstitre">Changer mes descriptions</span></p><br />';
				echo '<p>Vos descriptions ont été mises à jour.</p></div>';
				print_ligne(14);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		} elseif ($res1 or $res2 or $res3) {//seulement certain details ont été mis à jour
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
				echo '<p><span class="sstitre">Changer mes descriptions</span></p><br />';
				echo '<p>Certaines de vos descriptions ont été mises à jour.</p></div>';
				print_ligne(14);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		} elseif (!$res1 && !$res2 && !$res3) {//aucun changement
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
				echo '<p><span class="sstitre">Changer mes descriptions</span></p><br />';
				echo '<p>Aucun changement n\'a été fait sur la base de donnée.</p></div>';
				print_ligne(14);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		}//fin de "if ($res1 && $res2 && $res3) "				
				
	}// fin de "if (($e1==FALSE) and ($e2=FALSE) and ($e3=FALSE))"
	
	$desc[0]=$des1;
	$desc[1]=$des2;
	$desc[2]=$des3;
	
} // fin de "if (isset($_POST['submitted'])) {"
	?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='etab';
	$lienactif='etab2';
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
?>
<p><span class="sstitre">Changer mes descriptions</span></p><br />
<?php
//on imprime les erreurs
	if (!empty($errors)) {
		report_erreurs($errors);
	}
?>
<p>Editez le texte des trois descriptions qui accompagnent la présentation de votre établissement.</p><p><br  /></p>
<form action="etab2.php" method="post">
	<fieldset><legend>Première description : </legend><br />
		<?php
			if (isset($e1)) {
				if ($e1==TRUE) {
					echo '<p><font color="red">Tapez votre texte : </font></p>';
				} else {
					echo '<p>Tapez votre texte : </p>';
				}
			}
			echo '<textarea name="desc1" cols="55" rows="5">';
			if (isset($desc[0])) {
				echo $desc[0];
			}
			echo '</textarea>';
		?>
	</fieldset>
	<br />
	<fieldset><legend>Deuxième description : </legend><br />
		<?php
			if (isset($e2)) {
				if ($e2==TRUE) {
					echo '<p><font color="red">Tapez votre texte : </font></p>';
				} else {
					echo '<p>Tapez votre texte : </p>';
				}
			}
			echo '<textarea name="desc2" cols="55" rows="5">';
			if (isset($desc[1])) {
				echo $desc[1];
			}
			echo '</textarea>';
		?>
	</fieldset>
	<br />
	<fieldset><legend>Troisième description : </legend><br />
		<?php
			if (isset($e3)) {
				if ($e3==TRUE) {
					echo '<p><font color="red">Tapez votre texte : </font></p>';
				} else {
					echo '<p>Tapez votre texte : </p>';
				}
			}
			echo '<textarea name="desc3" cols="55" rows="5">';
			if (isset($desc[2])) {
				echo $desc[2];
			}
			echo '</textarea>';
		?>
	</fieldset>
	<table width="100%" border="0" cellpadding="5">
		<tr>
			<td align="center" width="100%"><input type="submit" name="submit" value="Valider mes descriptions" /></td>
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