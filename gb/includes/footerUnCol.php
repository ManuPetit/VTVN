<!-- FIM de la page web-->
<!-- DEBUT Footer-->
<div id="longBas"></div>
  </div>
  <div id="pied">
    <ul id="menubas">
	  	<?php //Verification du menu présent
		
		//Mentions
		if ($menu_choix == 'mentions') {//menu Mentions selectionner
			echo '<li><a class="choisi">Legal Informations</a></li>';
			echo "\n";
		} else {
			echo '<li><a href="../gb/mentions.php">Legal Informations</a></li>';
			echo "\n";
		}
		
		//Contacts
		if ($menu_choix == 'contacts') {//menu Contacts selectionner
			echo '<li><a class="choisi">Contacts</a></li>';
			echo "\n";
		} else {
			echo '<li><a href="../gb/contacts.php">Contacts</a></li>';
			echo "\n";
		}
		
		//Plan
		if ($menu_choix == 'plan') {//menu Plan selectionner
			echo '<li><a class="choisi">Site Map</a></li>';
			echo "\n";
		} else {
			echo '<li><a href="../gb/plan.php">Site Map</a></li>';
			echo "\n";
		}
		?>
      </ul>
  </div>
</div>
</body>
</html>
<?php
//vider le buffer
ob_end_flush();
?>