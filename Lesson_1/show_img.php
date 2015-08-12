<?php
	$im = new imagick( "store/".$_GET["file"] );
	$im->cropThumbnailImage( 80, 80 );
	header("Content-Type: image/jpg");
	echo $im->getImageBlob();
?>
