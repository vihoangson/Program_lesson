<?php
$type_image	= "common"; //(common || imagemagick)
$url		= "store/".$_GET["file"];
$width		= 80;
$height		= 80;

switch($type_image){
	case "imagemagick":
		$im = new imagick($url);
		$im->cropThumbnailImage( 80, 80 );
		header("Content-Type: image/jpg");
		echo $im->getImageBlob();
	break;
	case "common":
		// Le fichier
		$filename	= $url;
		// Définition de la largeur et de la hauteur maximale
		$width		= 80;
		$height		= 80;
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
	break;
}


?>
