<?php # script  config.inc.php

//This script determine how errors are handled
//and has the function to return a date

//Flag variable for site status;
$live=FALSE;

//error log email address
$email="webmaster@vieuxnyons.com";

//create the error hadnler
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	global $live, $email;
	
	//build the error message
	$message = "An error occured in script '$e_file' on line $e_line : \n<br />$e_message\n<br />";
	
	//add the date and time
	$message .= "Date/time: " . date('j-n-Y H:i:s') . "\n<br />";
	
	//append $e-vars to $e_message
	$message .= "<pre>" . print_r ($e_vars,1) . "</pre>\n<br />";
	
	if ($live) {//don't show the specific error
	
		error_log($message,1,$email);//send email
	
		//only print an error message if the error is not a notice
		if ($e_number != E_NOTICE) {
			echo '<div id="Error">A system error occurred. We apologize for the inconvenience</div><br />';
		}
		
	} else { //development stage show the error
		echo '<div id="Error">' . $message . '</div><br />';
	}
	
}// end of my_error_handler function

//Create function to return a date
function my_date_handler ($date, $type) {

	//setlocale (LC_ALL, 'fr_FR');
	date_default_timezone_set("Europe/Paris");
	$jour = array('dimanche', 'lundi', 'mardi', 'mercredi','jeudi', 'vendredi', 'samedi');
	$mois = array(1=> 'janvier', 'f&eacute;vrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'ao&ucirc;t', 'septembre', 'octobre', 'novembre', 'd&eacute;cembre');
	 
	//preparation des variables
	$leJour = $jour[date("w", strtotime($date))];	
	$chiffre = date("j", strtotime($date));
	$leMois = $mois[date("n", strtotime($date))];
	$lAnnee = date("Y", strtotime($date));
	
	if ($type == 1) {//date avec "Le"
		$ma_date = "Le $leJour $chiffre $leMois $lAnnee";
	} elseif ($type == 2) {//date avec "le"
		$ma_date = "le $leJour $chiffre $leMois $lAnnee";
	} elseif ($type == 3) {// date sans "le"  et on ne met pas une majuscule au jour
		$ma_date = "$leJour $chiffre $leMois $lAnnee";
	} else { //date sans "le" et on met une majuscule au jour
		$leJour = ucfirst($leJour);
		$ma_date = "$leJour $chiffre $leMois $lAnnee";
	}
	
	return $ma_date;
}	//fin de my_date_handler

//create function to write errors
function report_erreurs($errors) {
	//on compte le nombre d'entrée
	$entrees=count($errors);
	if ($entrees == 1) { //1 seule erreur
		echo '<p><font color="red" size="+1">L&acute;erreur suivante s&acute;est produite :</font></p><br />';
	} else { //plusieurs erreurs
		echo '<p><font color="red" size="+1">Les erreurs suivantes se sont produites :</font></p><br />';
	}//fin de "if ($entrees == 1)"
	foreach ($errors as $msg) {
		// détails des erreurs
		echo "$msg<br />\n";
	}
	
}// fin de report_erreurs

//create function pour faire un mot de passe
function make_password($length) {
  $vowels = 'aeiouyAEIUY0123456789';
  $consonants = 'bdghjlmnpqrstvwxzBDGHJLMNPQRSTVWXZ';
  $password = '';
  $alt = time() % 2;
  srand(time());
  for ($i = 0; $i < $length; $i++) {
    if ($alt == 1) {
      $password .= $consonants[(rand() % strlen($consonants))];
      $alt = 0;
    } else {
        $password .= $vowels[(rand() % strlen($vowels))];
      $alt = 1;
    }
  }
  return $password;
}// fin de make_password

//create function pour imprimer des lignes blanche
function print_ligne($nombre) {
	for ( $i=0;  $i<= $nombre; $i++) {
		echo "<p><br /></p>\n";
	}
}// fin de "print_ligne"

//use my error handler
set_error_handler ('my_error_handler');

?>