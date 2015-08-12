<?php 
	$case				= "show_img";//show_img, save_img
	$cropThumbnailImage	= true;

	$im = new imagick( "img/".$_GET["file"] );

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
 ?>
 