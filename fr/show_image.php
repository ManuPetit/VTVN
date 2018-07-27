<?php # Script 14.8 - show_image.php
// This pages retrieves and shows an image.


// Check for an image name.
if (isset($_GET['image'])) {
	// Full image path:
	$image = "../../vtvnDoc/{$_GET['dir']}/{$_GET['image']}";
echo $image;

	// Check that the image exists and is a file.
	if (file_exists ($image) && (is_file($image))) {
		$name = $_GET['image'];
	} else {
		$image = './images/unavailable.gif';	
		$name = 'unavailable.gif';
	}
	
} else { // No image name.
	$image = './images/unavailable.gif';	
	$name = 'unavailable.gif';
}

// Get the image information.
$ft = mime_content_type($image);
$fs = filesize($image);

// Send the file.
header ("Content-Type: $ft\n");
header ("Content-disposition: inline; filename=\"$name\"\n");
header ("Content-Length: $fs\n");
readfile ($image);
		
?>