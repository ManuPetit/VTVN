<?php # script : ad_event2.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des �l�ments de la page
$titre_page='Supprimer tous les �v�nements pass�s.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

date_default_timezone_set("Europe/Paris");
$aujourdhui=getdate();
$today=mktime(0,0,0,$aujourdhui['mon'],$aujourdhui['mday'],$aujourdhui['year']);
$cejour=date('Y-m-d 0:00:01',$today);

$query="DELETE FROM vsysevents WHERE v_EventDate<'$cejour'";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
?>
	<div id="longHaut">
	  <img src="../images/avatar/<?php echo $photo; ?>" height="50" width="50" /><h2><?php echo $prenom; ?></h2>
	</div>
	<div id="longMilieu">
<?php	
	$header='event';
	$lienactif=NULL;
	include('./includes/admin.php'); 
	echo'<div id="mainMemb">';
?><p><span class="sstitre">Supprimer les �v�nements pass�s</span></p><br />
	<p>Les �v�nements ayant d�j� eu lieu ont �t� supprim� de la base de donn�es.</p></div>
	
<?php
	print_ligne(10);
	$menu_choix =NULL;
	include ('./includes/footerUnCol.php');
	exit();
