<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tour Randonne</title>
<?php
//determiner la date pour afficher le css correct
date_default_timezone_set("Europe/Paris");
$ladate=getdate();
$lannee=$ladate['year'];
$dec1=mktime(0,0,0,12,1,$lannee);
$dec2=mktime(23,59,59,12,31,$lannee);
$jan1=mktime(0,0,0,1,1,$lannee);
$jan2=mktime(23,59,59,1,7,$lannee);

// Verification de la date ppour aficher le bon css fichier
if (($ladate[0] >= $dec1) && ($ladate[0] <= $dec2)){ //on utilise le css de noel
	$css="noel";
} elseif (($ladate[0] >= $jan1) && ($ladate[0] <= $jan2)){ //on utilise le css de noel
	$css="noel";
} else {
	$css="css1";
}
echo '<link href="../../' . $css . '/photocss.css" rel="stylesheet" type="text/css" />';
?>
</head>
<body>
<div id="tour"> <img src="../../images/histoire/his_vue006.jpg" alt="dessin de la Tour Randonne" width="376" height="500" />
  <p  class="legende"> Tour et maison de la Randonne.<br />
    Dessin r&eacute;alis&eacute; par Chardon </p>


<table width="100%" border="0">
<tr><td width="100%" align="center">
    <input name="button" type="button" onclick="javascript:self.close();" value="Fermer" />
</td></tr>
</table>
</div>
</body>
</html>
