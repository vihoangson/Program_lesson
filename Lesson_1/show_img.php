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

	function cropImage_common2($filename,$width,$height){
		// Content type
		header('Content-Type: image/png');
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

	function cropImage_common($filename,$newWidth,$newHeight){
		$originalFile = $filename;
		$info = getimagesize($originalFile);
		$mime = $info['mime'];

		switch ($mime) {
			case 'image/jpeg':
			$image_create_func = 'imagecreatefromjpeg';
			$image_save_func = 'imagejpeg';
			$new_image_ext = 'jpg';
			break;

			case 'image/png':
			$image_create_func = 'imagecreatefrompng';
			$image_save_func = 'imagepng';
			$new_image_ext = 'png';
			break;

			case 'image/gif':
			$image_create_func = 'imagecreatefromgif';
			$image_save_func = 'imagegif';
			$new_image_ext = 'gif';
			break;

			default:
			throw Exception('Unknown image type.');
		}
		header('Content-Type: '.$mime);
		$img = $image_create_func($originalFile);
		list($width, $height) = getimagesize($originalFile);
		$newHeight = ($height / $width) * $newWidth;
		$tmp = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		$image_save_func($tmp, null);
		imagedestroy($tmp);
	}
?>
