<?php
require_once('config.php');
require_once('init.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
	
	if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
if(isset($_GET['stireId']) && (int)$_GET['stireId'] > 0) {
	
	$updateSQL= mysql_query("UPDATE stiri SET `status`='archive' WHERE `id` = ".(int)$_GET['stireId']."");
	
}

echo 'Va multumim!Stirea a fost aprobata';

?>