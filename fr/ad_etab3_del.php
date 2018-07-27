<?php # script : ad_etab3_del.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des �l�ments de la page
$titre_page='Supprimer une cat�gorie.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

if ((isset($_GET['catid'])) && (is_numeric($_GET['catid']))) {//on verifie que l'on a bien une id et qu'elle est numeric
	$mem_id=$_GET['catid'];
	
	//on fait la requete de verification qu'il n'y a aucun commerce de ce type avant supprimer
	$query="SELECT v_EtabID, v_EtabNom FROM vsyscommerces WHERE v_ComTypeID=$mem_id";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	//verifier que l'on a un resultat
	if (@mysql_num_rows($result) >= 1) {
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
			<p><span class="sstitre">Supprimer une cat�gorie</span></p><br />
			<p>Il est impossible de supprimer la cat�gorie choisie, car il y a le ou les commerces suivants, font toujours partis de cette cat�gorie :<br /><br />
			<?php
				while ($row=mysql_fetch_array($result,MYSQL_NUM)) {
					echo ' - ' . $row[1] . '</br>';
				}
			echo '</p></div>';
			print_ligne(10);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
	} else { //on peut le supprimer
		$query="DELETE FROM vsyscommercetype WHERE v_ComTypeID=$mem_id";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		if ($result) {// �a a march�
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
				<p><span class="sstitre">Supprimer une cat�gorie</span></p><br />
				<p>La cat�gorie a �t� supprimer de la base de donn�es.</p></div>'
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
				$header='etab';
				$lienactif=NULL;
				include('./includes/admin.php'); 
				echo'<div id="mainMemb">';
			?>
				<p><span class="sstitre">Supprimer une cat�gorie</span></p><br />
				<p>La cat�gorie n'a pas �t� supprimer de la base de donn�es. Si cel� persiste, veuillez contacter l'administrateur du site.</p></div>'
			<?php
				print_ligne(10);
				$menu_choix =NULL;
				include ('./includes/footerUnCol.php');
				exit();
		} // fin de "if ($result)
	}// fin de "if (@mysql_num_rows($result) >= 1)

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
		<p><span class="sstitre">Supprimer une cat�gorie</span></p><br />
		<p>Aucune cat�gorie choisie.</p></div>'
	<?php
		print_ligne(10);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} //fin de "if ((isset($_GET['catid'])) && (is_numeric($_GET['catid'])))
