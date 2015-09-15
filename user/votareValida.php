<?php
require_once('config.php');
require_once('init.php');

if(isset($_GET['stireId']) && (int)$_GET['stireId'] > 0) {
if(!isset($_SESSION['id'])) $_SESSION['id']='';
	$insertSQL= "INSERT INTO voturi (`stireId`,`utilizatorId`) VALUES (".(int)$_GET['stireId'].", ".$_SESSION['id'].")";
	$rezulat=mysql_query($insertSQL);
	$updateSQL=mysql_query("UPDATE stiri SET `nrVoturi` = 'nrVoturi'+1 WHERE `id` = ".(int)$_GET['stireId']."");
	
	}

echo 'Va multumim!Stirea a fost votata';

?>