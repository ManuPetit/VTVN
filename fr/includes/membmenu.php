<?php //script membmenu.php
//fait apparaitre le menu contextuelle

//on crée la table des menus
echo '<table id="membMenu" border="0"><tr>';

if ($header == 'profil') {// on a le profil selectionner donc on fait apparaitre les sous menu    
    echo '<td width="32"><img src="../images/menu/profil.gif" height="32" width="32" /></td><td class="HeadT"><a class="LeChoix">Mon profil</a></td></tr>';
	echo "\n";
	if ($lienactif == 'profil1') {//editer mon profil est actif
		echo '<tr><td class="MenuL" colspan="2"><a class="LeChoix">Editer mon profil</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a href="profil1.php">Editer mon profil</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'profil2') {//Changer mot de passe est actif
		echo '<tr><td class="MenuL" colspan="2"><a class="LeChoix">Changer de mot de passe</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a href="profil2.php">Changer de mot de passe</a></td></tr>';
	echo "\n";
	}	
	if ($lienactif == 'profil3') {//Changer image est actif
		echo '<tr><td class="MenuL" colspan="2"><a class="LeChoix">Changer mon image</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a href="profil3.php">Changer mon image</a></td></tr>';
	echo "\n";
	}
} else {
	echo '<td width="32"><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="profil.php">Mon profil</a></td></tr>';
} //fin de "if ($header == 'profil')"

echo "\n<tr>";

if ($header == 'etab') {//on etablissement selectionner
	echo '<td><img src="../images/menu/etablissement.gif" height="32" width="32" /></td><td class="HeadT"><a  class="LeChoix">Mon &eacute;tablissement</a></td></tr>';
	if ($lienactif == 'etab1') {//editer mes details est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Editer mes d&eacute;tails</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="etab1.php">Editer mes d&eacute;tails</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'etab2') {//changer mes descriptions est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Changer mes descriptions</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="etab2.php">Changer mes descriptions</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'etab3') {//changer mes photos est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Changer mes photos</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="etab3.php">Changer mes photos</a></td></tr>';
	echo "\n";
	}
} else {
	echo '<td><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="etab.php">Mon &eacute;tablissement</a></td></tr>';
} //fin de "if ($header == 'etab')"
	
echo "\n<tr>";

if ($header == 'event') {//mes evenements selectionne
	echo '<td><img src="../images/menu/evenements.gif" height="32" width="32" /></td><td class="HeadT"><a  class="LeChoix">Mes &eacute;v&eacute;nements</a></td></tr>';
	if ($lienactif == 'event1') {//creer un evenement est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Cr&eacute;er un &eacute;v&eacute;nement</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="event1.php">Cr&eacute;er un &eacute;v&eacute;nement</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'event2') {//changer un evenement est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Modifier un &eacute;v&eacute;nement</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="event2.php">Modifier un &eacute;v&eacute;nement</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'event3') {//annuler un evenement est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Annuler un &eacute;v&eacute;nement</a></td>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="event3.php">Annuler un &eacute;v&eacute;nement</a></td></tr>';
	echo "\n";
	}
} else {
	echo '<td><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="event.php">Mes &eacute;v&eacute;nements</a></td></tr>';
} //fin de "if ($header == 'event')"

//LA SECTION SUIVANTE N'EST PAS ENCORE ACTIVEE
/*

echo "\n<tr>";

if ($header == 'blogs') {//mes evenements selectionne
	echo '<td><img src="../images/menu/blogs.gif" height="32" width="32" /></td><td class="HeadT"><a  class="LeChoix">Mes Blogs</a></td></tr>';
	if ($lienactif == 'blogs1') {//creer un article est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Cr&eacute;er un article</a></td></tr>';
		echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="blogs1.php">Cr&eacute;er un article</a></td></tr>';
		echo "\n";
	}
	if ($lienactif == 'blogs2') {//Modifier un article est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Modifier un article</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="blogs2.php">Modifier un article</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'blogs3') {//annuler un article est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Annuler un article</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="blogs3.php">Annuler un article</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'blogs4') {//publier un article est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Publier un article</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="blogs4.php">Publier un article</a></td></tr>';
	echo "\n";
	}
} else {
	echo '<td><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="blogs.php">Mes blogs</a></td></tr>';
} //fin de "if ($header == 'blogs')"
*/

//pour les documents VTVN on retrouve les differenetes section dans la base de données
$query="SELECT v_GroupeID, v_GroupeNomFR FROM vsysdocgroupes ORDER BY v_GroupeID ASC";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$g_id=array();
	$g_nom=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {//on proccess le resultat
		$g_id[]=$row['v_GroupeID'];
		$g_nom[]=$row['v_GroupeNomFR'];
	}
	echo "\n<tr>";
	if ($header == 'docus') {//document VTVN selectionné
		echo '<td><img src="../images/menu/documents.gif" height="32" width="32" /></td><td class="HeadT"><a  class="LeChoix">Documents VTVN</a></td></tr>';
		
		$nb=count($g_id)-1;
		for ($i=0; $i<=$nb; $i++) {
			$lelien='docus' . $g_id[$i];
			if ($lienactif == $lelien ) {//documents  actif
				echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Documents ' . $g_nom[$i] . '</a></td></tr>';
			echo "\n";
			} else {
				echo '<tr><td class="MenuL" colspan="2"><a  href="docus1.php?docid=' . $g_id[$i] . '">Documents ' . $g_nom[$i] . '</a></td></tr>';
			echo "\n";
			}
		}
	} else {
		echo '<td><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="docus.php">Documents VTVN</a></td></tr>';
	} //fin de "if ($header == 'docus')"
} //FIN DE "if (@mysql_num_rows($result) >= 1)"

//même principe pour les photos
$query="SELECT v_GroupeID, v_GroupeNom FROM vsysphotogroupes WHERE v_GroupeActif=1 AND v_GroupePublic=0 ORDER BY v_GroupeID";
$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());

//verifier que l'on a un resultat
if (@mysql_num_rows($result) >= 1) {
	$p_id=array();
	$p_nom=array();
	while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {//on proccess le resultat
		$p_id[]=$row['v_GroupeID'];
		$p_nom[]=$row['v_GroupeNom'];
	}
	echo "\n<tr>";

	if ($header == 'photos') {//photos selectionnée
		echo '<td><img src="../images/menu/photos.gif" height="32" width="32" /></td><td class="HeadT"><a class="LeChoix">Photos</a></td></tr>';
		
		$nb=count($p_id)-1;
		for ($i=0;$i<=$nb;$i++) {
			$plien='photos' . $p_id[$i];
			if ($lienactif == $plien) {//lien actif
				echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">' . $p_nom[$i] . '</a></td></tr>';
				echo "\n";
			} else {
				echo '<tr><td class="MenuL" colspan="2"><a  href="photos1.php?galid=' . $p_id[$i] . '">' . $p_nom[$i] . '</a></td></tr>';
				echo "\n";
			}
		}
	} else {
		echo '<td><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="photos.php">Photos</a></td></tr>';
	} //fin de "if ($header == 'photos')"
} //FIN DE "if (@mysql_num_rows($result) >= 1)

echo "\n<tr>";
echo '<td><img src="../images/menu/deconnexion.gif" height="32" width="32" /></td><td class="HeadT"><a href="logoff.php">D&eacute;connexion</a></td></tr>';
 echo '</table>';
?>