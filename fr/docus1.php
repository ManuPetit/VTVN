<?php # script : docus1.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//Output buffering
ob_start();
//debut de session
session_start();

include ('./includes/headerconex.php');

if ((isset($_GET['docid'])) && (is_numeric($_GET['docid']))) {//on a bien une valeur passéela page
	$doc_id=$_GET['docid'];
} else {
	?>
		<div id="longHaut">
		  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
		</div>
		<div id="longMilieu">
	<?php	
		$header='docus';
		$lienactif=NULL;
		include('./includes/membmenu.php'); 
		echo'<div id="mainMemb">';
	?>
	
	<p><span class="sstitre">Documents</span></p><br />
	<p>Une erreur s'est produite. Veuillez le signaler à l'administrateur du site ce problème persiste.</p>
	</div>
	<?php
	print_ligne(12);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
	exit();
}

$query="SELECT v_GroupeNomFR FROM vsysdocgroupes WHERE v_GroupeID=$doc_id";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
//verifier que l'on a un resultat
if (@mysql_num_rows($result) == 1) {
	$row=mysql_fetch_array($result,MYSQL_NUM);
	//on retrouve notre dossier
	$lesdocs=$row[0];
} else {
	?>	
		<p><span class="sstitre">Documents</span></p><br />
		<p>Une erreur s'est produite. Veuillez le signaler à l'administrateur du site ce problème persiste.</p>
		</div>
		<?php
		print_ligne(12);
		$menu_choix =NULL;
		include ('./includes/footerUnCol.php');
		exit();
}

//mise en place des éléments de la page
$titre_page='Documents ' . $lesdocs ;
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnColv2.php');


?>
	<div id="longHaut">
      <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
    </div>
	<div id="longMilieu">
<?php	
	$header='docus';
	$lienactif='docus' . $doc_id;
 	include('./includes/membmenu.php'); 
 	echo'<div id="mainMemb">';
	
	
?>


<p><span class="sstitre">Documents <?php echo $lesdocs; ?></span></p><br />
<p>Sélectionnez le document que vous souhaitez voir, en cliquant soit sur l'icone Word (microsoft Word) ou sur l'icone Pdf (Adobe Reader).</p><br  />
<table width="100%" border="0" cellpadding="5">
	<tr>
		<td width="70%" align="left" class="photo"><b>Fichier</b></td>
		<td width="15%" align="center" class="photo"><b>.doc</b></td>
		<td width="15%" align="center" class="photo"><b>.pdf</b></td>
	</tr>
	<?php
		$query="SELECT v_DocNom, v_NomPDF, v_NomDOC FROM vsysdocs WHERE v_GroupeID=$doc_id and v_DocActif=1 ORDER BY v_NomDOC ASC";
		$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
		
		//verifier que l'on a un resultat
		if (@mysql_num_rows($result) >= 1) {
			$nom=array();
			$pdf=array();
			$doc=array();
			while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {//on proccess le resultat
				$nom[]=$row['v_DocNom'];
				$pdf[]=$row['v_NomPDF'] . '.pdf';
				$doc[]=$row['v_NomDOC'] . '.doc';
			}
			//on affiche le resultat
			$nbre=count($nom)-1;
			for ($i=0; $i<=$nbre; $i++) {
				echo '<tr>';
				echo '<td align="left" class="photo">' . $nom[$i] . '</td>';
				echo '<td align="center"><a target="_new" href="../images/docs/' . $doc[$i] . '"><img src="../images/menu/msword.gif" width="24" height="24" border="0" /></a></td>';
				echo '<td align="center"><a target="_new" href="../images/docs/' . $pdf[$i] . '"><img src="../images/menu/adobepdf.gif" width="24" height="24" border="0" /></a></td>';
				echo "</tr>\n";
			}
		} else {
			$nbre=2;
			echo '<tr><td align="center" colspan="3" class="photo"> il n\'y a aucun document à consulter.</td></tr>';
		}
	?>
	<tr>
		<td align="center" colspan="3" class="photo">Télécharger <a href="http://www.adobe.com/fr/products/acrobat/readstep2.html" class="inLien">Adobe Reader</a>.</td>
	</tr>
</table>
</div>
	
<?php
$nb=4-$nbre;
if ($nb<=0) {
	$nb=0;
}
print_ligne($nb);
$menu_choix =NULL;
include ('./includes/footerUnCol.php');
?>