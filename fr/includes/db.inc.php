<?php # script db.inc.php
// toutes les functions pour retrouver les éléments de la base


//function pour retrouver la photo du système ou utiliser celle par default
function get_image($uid) {
	
	//image par default
	$image='av_000.jpg';
	//construction de la requete
	$query="SELECT v_MembreImage FROM vsysmembres WHERE v_MembreID = $uid";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	if (mysql_affected_rows() == 1) {//on a un match
		$row=mysql_fetch_array($result,MYSQL_NUM);
		if (!is_null($row[0])) {
			$image=$row[0];
		}
	} 
	return $image;
} //fin de get_image

//function pour retourner le dernier login
function get_dernier_login($uid) {

	//phrase par default
	$phrase = "Ceci est votre première connexion<br />";
	//construction de la requete
	$query="SELECT v_MembreDernierLogin FROM vsysmembres WHERE v_MembreID=$uid";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	if (mysql_affected_rows() == 1) {//on a un match
		$row=mysql_fetch_array($result,MYSQL_NUM);
		$dateLog=$row[0];
		if (!is_null($dateLog)) {
			$ladate=my_date_handler($dateLog,3);
			$phrase = "Votre dernière connexion : <b>$ladate</b><br />";
		}
	} elseif (mysql_affected_rows() >1) {
		$phrase=" ";
	}	
	
	//maintenant on met à la date de dernière connexion car cette fonction n'est acceder qu'une seule fois
	$query="UPDATE vsysmembres SET v_MembreDernierLogin = NOW() WHERE v_MembreID=$uid";
	$result=mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
	
	//on ne vérifie pas l'update
	
	//on retourne le phrase
	return $phrase;
} //FIN de get_dernier_login

//function pour remplir les jours de fermeture
function fill_closed_day($lejour, $lalettre) {
	//on commence avec le row et le jour
	echo '<tr>';
	echo '<td class="photo">' . $lejour . '</td>';
	$lejourf= 'le' . $lejour;
	//ensuite on process la lettre
	if ($lalettre == 'a') {
		echo '<td align="center"><input type="radio" name="' . $lejourf . '" value="a" checked="checked" /></td>';
	} else {
		echo '<td align="center"><input type="radio" name="' . $lejourf . '" value="a" /></td>';
	}
	if ($lalettre == 'b') {
		echo '<td align="center"><input type="radio" name="' . $lejourf . '" value="b" checked="checked" /></td>';
	} else {
		echo '<td align="center"><input type="radio" name="' . $lejourf . '" value="b" /></td>';
	}
	if ($lalettre == 'c') {
		echo '<td align="center"><input type="radio" name="' . $lejourf . '" value="c" checked="checked" /></td>';
	} else {
		echo '<td align="center"><input type="radio" name="' . $lejourf . '" value="c" /></td>';
	}
	if ($lalettre == 'd') {
		echo '<td align="center"><input type="radio" name="' . $lejourf . '" value="d" checked="checked" /></td>';
	} else {
		echo '<td align="center"><input type="radio" name="' . $lejourf . '" value="d" /></td>';
	}
	echo "</tr>\n";	
}

//This function takes in the current width and height of an image
//and also the max width and height desired.
//It then returns an array with the desired dimensions.
function setWidthHeight($width, $height, $maxwidth, $maxheight){
	if ($width > $height){
		if ($width > $maxwidth){
			//Then you have to resize it.
			//Then you have to resize the height to correspond to the change in width.
			$difinwidth = $width / $maxwidth;
			$height = intval($height / $difinwidth);
			//Then default the width to the maxwidth;
			$width = $maxwidth;
			//Now, you check if the height is still too big in case it was to begin with.
			if ($height > $maxheight){
				//Rescale it.
				$difinheight = $height / $maxheight;
				$width = intval($width / $difinheight);
				//Then default the height to the maxheight;
				$height = $maxheight;
			}
		} else {
			if ($height > $maxheight){
				//Rescale it.
				$difinheight = $height / $maxheight;
				$width = intval($width / $difinheight);
				//Then default the height to the maxheight;
				$height = $maxheight;
			}
		}
	} else {
		if ($height > $maxheight){
			//Then you have to resize it.
			//You have to resize the width to correspond to the change in width.
			$difinheight = $height / $maxheight;
			$width = intval($width / $difinheight);
			//Then default the height to the maxheight;
			$height = $maxheight;
			//Now, you check if the width is still too big in case it was to begin with.
			if ($width > $maxwidth){
				//Rescale it.
				$difinwidth = $width / $maxwidth;
				$height = intval($height / $difinwidth);
				//Then default the width to the maxwidth;
				$width = $maxwidth;
			}
		} else {
			if ($width > $maxwidth){
				//Rescale it.
				$difinwidth = $width / $maxwidth;
				$height = intval($height / $difinwidth);
				//Then default the width to the maxwidth;
				$width = $maxwidth;
			}
		}
	}
	$widthheightarr = array ("$width","$height");
	return $widthheightarr;
}

//This function creates a thumbnail and then saves it.
function createthumb ($img, $constrainw, $constrainh){
	//Find out the old measurements.
	$oldsize = getimagesize ($img);
	//Find an appropriate size.
	$newsize = setWidthHeight ($oldsize[0], $oldsize[1], $constrainw, $constrainh);
	//Create a duped thumbnail.
	$exp = explode (".", $img,4);
	//Check if you need a gif or jpeg.
	if ($exp[3] == "gif"){
		$src = imagecreatefromgif ($img);
	} else {
		$src = imagecreatefromjpeg ($img);
	}
	//Make a true type dupe.
	$dst = imagecreatetruecolor ($newsize[0],$newsize[1]);
	//Resample it.
	imagecopyresampled ($dst,$src,0,0,0,0,$newsize[0],$newsize[1],$oldsize[0],$oldsize[1]);
	//Create a thumbnail.
	$thumbname = '..' . $exp[2] . "_th." . $exp[3];
	if ($exp[3] == "gif"){
		imagejpeg ($dst,$thumbname);
	} else {
		imagejpeg ($dst,$thumbname);
	}
	//And then clean up.
	imagedestroy ($dst);
	imagedestroy ($src);
	return $thumbname;
}

//cette function resize une image pour être sur qu'elle n'est pas supérieur à 400 x 400
function resize_jpg($inputFilename, $name, $direct){
	//creation du path de l'image
	$curimage = $direct . $inputFilename;
	//on retrouve sa taille
	$imagedata = getimagesize($curimage);
	$w = $imagedata[0];
	$h = $imagedata[1];
	//on crée les nouvelles taille en respectant le sens de l'image
	if ($h > $w) {
		$new_w = (400 / $h) * $w;
		$new_h = 400;	
	} else {
		$new_h = (400 / $w) * $h;
		$new_w = 400;
	}
	//s'agit-il d'un gif ou jpeg	
	if ($name == 'image/gif') {
		$im2= imagecreate($new_w, $new_h);
		$image= imagecreatefromgif($curimage);
	} else {
		$im2 = imagecreatetruecolor($new_w, $new_h);
		$image = imagecreatefromjpeg($curimage);
	}	
	//nom du nouveau fichier temporaire qui sera crée sur le serveur
	$newfilename= 'temp_';
    $file = $newfilename . $inputFilename;
    
    //nom du path avec nouveau fichier
    $fullpath = $direct . $file;

    //on retaille l'image
    imagecopyresized($im2,  $image,  0,  0,  0,  0,  $new_w,  $new_h,  $w,  $h);

    //on sauvegarde l'image avec une qualité de 80
    imagejpeg($im2,  $fullpath,  80);
	
	//maintenant on détruit le fichier original
	unlink($curimage);
	
	//finalement on change le nom du fichier
	rename($fullpath,$curimage);
	
    //CREATING FILENAME TO WRITE TO DATABSE
    $filepath = $curimage;
    
    //RETURNS FULL FILEPATH OF IMAGE ENDS FUNCTION
    return $filepath; 
}

//cette function retourne les jours de fermeture selon "aaaaaaa" et "fr ou gb"
function edit_fermeture($input_jour,$input_langue) {
	if ($input_jour == 'aaaaaaa') {//ouvert tous les jours
		if ($input_langue == 'fr') {
			$ferme="Ouvert tous les jours.";
		} elseif ($input_langue == 'gb') {
			$ferme="Opened every day.";
		}
	}
	if (isset($ferme)) {
		return $ferme;
	}
	$ferme='';
	if ($input_langue == 'fr') {
		$jour=array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
		$codefe=array( " matin, ", " après-midi, ", " toute la journée, ");
	} elseif ($input_langue == 'gb') {
		$jour=array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		$codefe=array(" morning, ", " after-noon, "," all day, " );
	}
	for ($i=0; $i<7; $i++) {
		$lettre=$input_jour{$i};
		if ($lettre != 'a') {
			switch ($lettre) {
				case 'b' :
					$l=0;
					break;
				case 'c' :
					$l=1;
					break;
				case 'd' :
					$l=2;
					break;
			}			
			$ferme .= $jour[$i] . $codefe[$l];
		}
	}
	$ferme=ucfirst($ferme);
	$long=strlen($ferme);
	$n_ferme=substr($ferme,0,$long-2);
	$n_ferme .= '.';
	return $n_ferme;
} //fin de "function edit_fermeture"



?>