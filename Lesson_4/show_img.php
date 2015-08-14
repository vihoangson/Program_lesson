<?php 
	$case				= "show_img";//show_img, save_img
	$cropThumbnailImage	= true;
	$filename			= "img/".$_GET["file"] ;

	if(class_exists("imagick")){
		$im = new imagick($filename);

		/* create the thumbnail */
		if($cropThumbnailImage){
			$im->cropThumbnailImage( 80, 80 );
		}

		/* Write to a file */
		if($resizeImage){
			$im->resizeImage(900,80,1,0.5);
		}

		switch($case){
			case "write_img":
				$im->writeImage( "img/".$_GET["file"] );
			break;
			case "show_img":
				header("Content-Type: image/jpg");
				echo $im->getImageBlob();
			break;
		}
	}else{
		cropImage_common($filename,80,80);
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
 