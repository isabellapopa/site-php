<?php
require_once('init.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da')
{
	die('Nu aveti permisiune de accesare');
}
if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da')
{
	die('Nu aveti permisiune de accesare');
}
if(isset($_GET['utilizatorId']) && (int)$_GET['utilizatorId'] > 0)
{
	$updateSQL= $conn->prepare("UPDATE utilizatori SET `rol`='moderator' WHERE `id` = ".(int)$_GET['utilizatorId']."");
	$updateSQL->execute();
	
}

echo 'Va multumim! Aprobarea a fost facuta ';

?>
