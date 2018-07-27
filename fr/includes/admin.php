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
		echo '<tr><td class="MenuL" colspan="2"><a href="ad_monprofil1.php">Editer mon profil</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'profil2') {//Changer mot de passe est actif
		echo '<tr><td class="MenuL" colspan="2"><a class="LeChoix">Changer de mot de passe</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a href="ad_monprofil2.php">Changer de mot de passe</a></td></tr>';
	echo "\n";
	}	
	if ($lienactif == 'profil3') {//Changer image est actif
		echo '<tr><td class="MenuL" colspan="2"><a class="LeChoix">Changer mon image</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a href="ad_monprofil3.php">Changer mon image</a></td></tr>';
	echo "\n";
	}
} else {
	echo '<td width="32"><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="ad_monprofil.php">Mon profil</a></td></tr>';
} //fin de "if ($header == 'profil')"

echo "\n<tr>";

if ($header == 'profils') {// on a le profil selectionner donc on fait apparaitre les sous menu    
    echo '<td width="32"><img src="../images/menu/blogs.gif" height="32" width="32" /></td><td class="HeadT"><a class="LeChoix">Profils</a></td></tr>';
	echo "\n";
	if ($lienactif == 'profil1') {//editer un profil est actif
		echo '<tr><td class="MenuL" colspan="2"><a class="LeChoix">Créer un nouveau profil</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a href="ad_profil1.php">Créer un nouveau profil</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'profil2') {//Changer un profil
		echo '<tr><td class="MenuL" colspan="2"><a class="LeChoix">Modifier un profil</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a href="ad_profil2.php">Modifier un profil</a></td></tr>';
	echo "\n";
	}	
	if ($lienactif == 'profil3') {//Changer un profil
		echo '<tr><td class="MenuL" colspan="2"><a class="LeChoix">Audit des profils</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a href="ad_profil3.php">Audit des profils</a></td></tr>';
	echo "\n";
	}		
	if ($lienactif == 'profil4') {//Changer un profil
		echo '<tr><td class="MenuL" colspan="2"><a class="LeChoix">Voir les tables</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a href="ad_profil4.php">Voir les tables</a></td></tr>';
	echo "\n";
	}	
} else {
	echo '<td width="32"><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="ad_profil.php">Profils</a></td></tr>';
} //fin de "if ($header == 'profil')"

echo "\n<tr>";

if ($header == 'etab') {//on etablissement selectionner
	echo '<td><img src="../images/menu/etablissement.gif" height="32" width="32" /></td><td class="HeadT"><a  class="LeChoix">Etablissements</a></td></tr>';
	if ($lienactif == 'etab3') {//changer mes descriptions est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Créer une catégorie</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_etab3.php">Créer une catégorie</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'etab4') {//changer mes descriptions est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Modifier une catégorie</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_etab4.php">Modifier une catégorie</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'etab1') {//editer mes details est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Créer un établissement</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_etab1.php">Créer un établissement</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'etab2') {//changer mes descriptions est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Modifier un établissement</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_etab2.php">Modifier un établissement</a></td></tr>';
	echo "\n";
	}
} else {
	echo '<td><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="ad_etab.php">Etablissements</a></td></tr>';
} //fin de "if ($header == 'etab')"
	
echo "\n<tr>";

if ($header == 'event') {//mes evenements selectionne
	echo '<td><img src="../images/menu/evenements.gif" height="32" width="32" /></td><td class="HeadT"><a  class="LeChoix">&eacute;v&eacute;nements</a></td></tr>';
	if ($lienactif == 'event1') {//creer un evenement est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Cr&eacute;er un &eacute;v&eacute;nement</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_event1.php">Cr&eacute;er un &eacute;v&eacute;nement</a></td></tr>';
	echo "\n";
	}
	if ($lienactif == 'event2') {//changer un evenement est actif
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Modifier un &eacute;v&eacute;nement</a></td></tr>';
	echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_event2.php">Modifier un &eacute;v&eacute;nement</a></td></tr>';
	echo "\n";
	}
} else {
	echo '<td><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="ad_event.php">Ev&eacute;nements</a></td></tr>';
} //fin de "if ($header == 'event')"

if ($header =='photo') {//les photos sont selectionnées
	echo '<td><img src="../images/menu/photos.gif" height="32" width="32" /></td><td class="HeadT"><a class="LeChoix">Photos</a></td></tr>';
	if ($lienactif == 'photo1') {
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Cr&eacute;er une galerie photo</a></td></tr>';
		echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_photo1.php">Cr&eacute;er une galerie photo</a></td></tr>';
		echo "\n";
	}
	if ($lienactif == 'photo2') {
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Modifier une galerie photo</a></td></tr>';
		echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_photo2.php">Modifier une galerie photo</a></td></tr>';
		echo "\n";
	}
	/*
	if ($lienactif == 'photo3') {
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Télécharger des photos</a></td></tr>';
		echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_photo3.php">Télécharger des photos</a></td></tr>';
		echo "\n";
	}
	if ($lienactif == 'photo4') {
		echo '<tr><td class="MenuL" colspan="2"><a  class="LeChoix">Modifier des photos</a></td></tr>';
		echo "\n";
	} else {
		echo '<tr><td class="MenuL" colspan="2"><a  href="ad_photo4.php">Modifier des photos</a></td></tr>';
		echo "\n";
	}*/
} else {
	echo '<td><img src="../images/menu/dossier.gif" height="32" width="32" /></td><td class="HeadT"><a href="ad_photo.php">Photos</a></td></tr>';
}
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
$query="SELECT v_GroupeID, v_GroupeNom FROM vsysphotogroupes ORDER BY v_GroupeID";
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

*/
echo "\n<tr>";

echo '<td><img src="../images/menu/deconnexion.gif" height="32" width="32" /></td><td class="HeadT"><a href="logoff.php">D&eacute;connexion</a></td></tr>';
 echo '</table>';
?>