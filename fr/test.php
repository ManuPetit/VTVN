<html>
<body>
<table border="1" width="80%" cellpadding="5">
<?php
	$deb=9000;
	for ($x=1; $x<=365; $x++) {
		echo '<tr><td width="40%">';
		echo "Jour $x</td>";
		$deb = ($deb * 0.0129) + $deb;
		echo '<td width="30%">';
		echo $deb .' €';
		$deb -=1.5;
		echo '</td><td width="30%">';
		echo "$deb €</td>";
		echo "</tr>";
	}
?>
</table>
</body>
</html>