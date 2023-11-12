<?php 
if (isset($_REQUEST['data'])) {
	# code...
	header('Content-Type:image/png');
	require 'vendor/autoload.php';
	$qr = new Endroid\QrCode\QrCode();
	$data=(isset($_REQUEST['data']))?$_REQUEST['data']:"";
	$size=(isset($_REQUEST['size']))?$_REQUEST['size']:200;
	$padding=(isset($_REQUEST['padding']))?$_REQUEST['padding']:10;
	$qr->setText($data);
	$qr->setSize($size);
	$qr->setPadding($padding);
	$qr->render();
}
 ?>
