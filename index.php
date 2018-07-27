<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="SHORTCUT ICON" href="http://www.vieuxnyons.com/images/favicon.ico" />
<title>Bienvenue sur VieuxNyons.com</title>
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
echo '<link href="' . $css . '/cssPrincipal.css" rel="stylesheet" type="text/css" />';
?>
</head>

<body>
<table width="800" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="350" align="center"><img src="images/vnLogo.jpg" alt="Logo assoication" width="300" height="100" /></td>
        <td><p class="intro">Le site internet de l'association &quot;Vie et travail dans le Vieux Nyons&quot;</p></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><img src="images/intro.jpg" alt="Image intro" width="714" height="521" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><table width="60%" border="0" cellpadding="5">
      <tr>
        <td align="center"><a href="fr/accueil.php"><img src="images/flags_of_France.gif" title="Version Fran&ccedil;aise du site" alt="Version Fran&ccedil;aise du site" width="60" height="40" border="0" /></a></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>



</body>
</html>
