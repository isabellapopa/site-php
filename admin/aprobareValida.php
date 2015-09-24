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
if(isset($_GET['stireId']) && (int)$_GET['stireId'] > 0)
{
	$updateSQL= $conn->prepare("UPDATE stiri SET `vizibil`=1 WHERE `id` = ".(int)$_GET['stireId']."");
	$updateSQL->execute();
	$cerereSQL=$conn->prepare("UPDATE stiri SET `status` = 'published' WHERE`id` = ".(int)$_GET['stireId']." ");
	$cerereSQL->execute();
}

echo 'Va multumim!Stirea a fost aprobata';

?>