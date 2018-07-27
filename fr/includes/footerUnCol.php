<!-- FIN de la page web-->
<!-- DEBUT Footer-->
<div id="longBas"></div>
  <div id="pied">
    <ul id="menubas">
	  	<?php //Verification du menu présent
		
		//Mentions
		if ($menu_choix == 'mentions') {//menu Mentions selectionner
			echo '<li><a class="choisi">Mentions</a></li>';
			echo "\n";
		} else {
			echo '<li><a href="../fr/mentions.php">Mentions</a></li>';
			echo "\n";
		}
		
		//Contacts
		if ($menu_choix == 'contacts') {//menu Contacts selectionner
			echo '<li><a class="choisi">Contacts</a></li>';
			echo "\n";
		} else {
			echo '<li><a href="../fr/contacts.php">Contacts</a></li>';
			echo "\n";
		}
		
		//Plan
		if ($menu_choix == 'plan') {//menu Plan selectionner
			echo '<li><a class="choisi">Plan du site</a></li>';
			echo "\n";
		} else {
			echo '<li><a href="../fr/plan.php">Plan du site</a></li>';
			echo "\n";
		}
		?>
      </ul>
  </div>
</div>
<div align="center" id="iiidees">
      <br />Site cr&eacute;&eacute; par <a href="http://www.iiidees.com" title="Lien vers le cr&eacute;ateur de ce site internet" target="_new" class="lid">iiidees.com</a>.<br /><br />
      </div>
</div>
</body>
</html>
<?php
//vider le buffer
ob_end_flush();
?>