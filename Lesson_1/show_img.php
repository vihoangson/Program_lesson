<?php
$type_image	= "common"; //(common || imagemagick)
$filename		= "store/".$_GET["file"];
$width		= 80;
$height		= 80;

switch($type_image){
	case "imagemagick":
		$im = new imagick($filename);
		$im->cropThumbnailImage( $width, $height );
		header("Content-Type: image/jpg");
		echo $im->getImageBlob();
	break;
	case "common":
		cropImage_common($filename,$width,$height);
	break;
}

function cropImage_common($filename,$width,$height){
	// Content type
	header('Content-Type: image/jpeg');
	// Cacul des nouvelles dimensions
	list($width_orig, $height_orig) = getimagesize($filename);
	$ratio_orig = $width_orig/$height_orig;

	if ($width/$height > $ratio_orig) {
		$width = $height*$ratio_orig;
	} else {
		$height = $width/$ratio_orig;
	}
	// Redimensionnement
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

	// Affichage
	imagejpeg($image_p, null, 100);
}

?>
