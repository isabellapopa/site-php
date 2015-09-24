<?php
require_once('config.php');
require_once('init.php');

if(isset($_GET['stireId']) && (int)$_GET['stireId'] > 0)
{
	if(!isset($_SESSION['id']))
	{
		$_SESSION['id'] = '';
	}

	$insertSQL= "INSERT INTO voturi (`stireId`,`utilizatorId`) VALUES (".(int)$_GET['stireId'].", ".$_SESSION['id'].")";
	$rezulat=$conn->prepare($insertSQL);
	$rezultat->execute();
	$updateSQL=$conn->prepare("UPDATE stiri SET `nrVoturi` = 'nrVoturi'+1 WHERE `id` = ".(int)$_GET['stireId']."");
	$updateSQL->execute();
	
}

echo 'Va multumim!Stirea a fost votata';

?>