<?php # script : ad_photo3.php
//Mise en place du script de configuration
require_once('./includes/config.inc.php');

//mise en place des éléments de la page
$titre_page='Télécharger des photos.';
$image_entete='enteteMembres';
$menu_item="membres";
include ('./includes/headerUnCol.php');
include ('./includes/headerconexadmin.php');

$err=array();
for ($i=0; $i<=4; $i++) {
	$err=[$i]=FALSE;
}
$badQuery=FALSE;

$query="SELECT v_GroupeID, v_GroupeNom, v_GroupeActif, v_GroupePublic FRM vsysphotogroupes ORDER by v_GroupeNom ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
if (@mysql_num_rows($result) >= 1) {	
	$v_GroupeID=array();
	$v_GroupeNom=array();
	$v_GroupeActif=array();
	$v_GroupePublic=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
		$v_GroupeID[]=$row['v_GroupeID'];
		$v_GroupeNom=stripslashes($row['v_GroupeNom']);
		$v_GroupeActif=$row['v_GroupeActif'];
		$v_GroupePublic=$row['v_GroupePublic'];
	}
} else {
	$badQuery=TRUE;
}
