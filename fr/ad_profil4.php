<?php # script : ad_profil4.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Voir les tables.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');


//on va cherché la liste des tables
//$sql=msql_list_tables('db159679622') 

$sql = "SHOW TABLES FROM $mdata";
$result = mysql_query($sql) or trigger_error("Erreur : \n<br />MySQL Error: " . mysql_error());

if (!$result) {
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
	?><p><span class="sstitre">Voir les Tables</span></p><br />
		<p>Une erreur s'est produite. Impossible de retrouver la liste des tables de la base de données. Si le problème persiste, contacter l'administrateur du site.</p></div>
		
	<?php
		print_ligne(13);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
} else {// on a une résultat
	$table=array();
	while ($row = mysql_fetch_row($result)) {
	   $table[]=$row[0];
	}
}



?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='profils';
	$lienactif='profil4';
 	include('./includes/admin.php'); 
?>
<div id="mainMemb">
<p><span class="sstitre">Voir les Tables</span></p><br /><br />

<?php
	
	if (isset($_POST['soumis'])) {	//on a une submission
		//on retrouve les champs de la table
		$latable=$_POST['tables'];
		$result = mysql_query("SHOW COLUMNS FROM $latable") or trigger_error("Erreur : \n<br />MySQL Error: " . mysql_error());
		if (!$result) {
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
		?><p><span class="sstitre">Voir les Tables</span></p><br />
			<p>Une erreur s'est produite. Impossible de retrouver la liste des champs de table de la base de données. Si le problème persiste, contacter l'administrateur du site.</p></div>
			
		<?php
			print_ligne(13);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
		} // fin de "if (!$result) {"
		if (mysql_num_rows($result) > 0) {
			$champs=array();
		   while ($row = mysql_fetch_assoc($result)) {
			  $champs[]=$row['Field'];
		   }
		}// fin de "if (mysql_num_rows($result) > 0) {"
		
		//construction de la query
		$query="SELECT ";
		$count=count($champs);
		for ($i=0; $i<$count; $i++) {
			$query .= $champs[$i] . ', ';
		}
		$nquery=substr($query,0,-2);
		$nquery .= " FROM $latable";
		//on retrouve les details
		$result = mysql_query($nquery) or trigger_error("Erreur : \n<br />MySQL Error: " . mysql_error());
		
		if (!$result){
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
		?><p><span class="sstitre">Voir les Tables</span></p><br />
			<p>Une erreur s'est produite. Impossible de retrouver les données de cette table. Si le problème persiste, contacter l'administrateur du site.</p></div>
			
		<?php
			print_ligne(13);
			$menu_choix =NULL;
			include ('./includes/footerUnCol.php');
			exit();
		} // fin de "if (!$result){
		
		// on retrouve les résultats et fait le tableau qui va bien sur déborder de la page
		if (mysql_num_rows($result) > 0) {
			echo '<table class="view" border="1" cellpadding="5"><tr>';
			$count=count($champs);
			for ($i=0; $i<$count; $i++) {
				echo '<td class="miniphoto">' . $champs[$i] . '</td>';
				echo "\n";
			}
			echo '</tr>';
			$col="#FFCCFF";
			$ncol="#CCFFFF";
			while ($row = mysql_fetch_assoc($result)) {
				if ($col == $ncol) {
					$ncol = "#CCFFFF";
				} else {
					$ncol = "#FFCCFF";
				}
				echo '<tr style="background-color:' . $ncol . '">';
				for ($i=0; $i<$count; $i++) {
					echo '<td class="miniphoto">' . $row[$champs[$i]] . '</td>';
					echo "\n";
				}
				echo "</tr>\n";
		   }
		    echo '</table><p><br /></p>';
		}// fin de "if (mysql_num_rows($result) > 0) {"
	} // fin de "if (isset($_POST['soumis'])) {"
?>
<p>Choisissez la table dont vous souhaiter voir les détails dans la liste ci-dessous :<br /><br /></p>
<form action="ad_profil4.php" method="post">
<select name="tables">
<?php
	$count=count($table); 
	for ($i=0; $i<$count; $i++) {
		echo '<option value="' . $table[$i] . '">' . $table[$i] . '</option>';
		echo "\n";
	}
?>
</select>
<input type="submit" value="Selectionner cette table" name="submit" />
<input type="hidden" name="soumis" value="TRUE" />
</form>

</div>

<?php

print_ligne(14);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>
