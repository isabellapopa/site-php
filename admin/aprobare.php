<?php
require_once('config.php');
require_once('init.php');

if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
	
	if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
$cerereSQL="SELECT * FROM stiri ";
$rezultat=mysql_query($cerereSQL);
while($stire=mysql_fetch_array($rezultat)){
	echo $stire['stire'];
	echo '<br>';
	echo $stire['id'];
	echo '<br>';
	echo '<a href="aprobareValida.php?stireId='.$stire['id'].'"> Aprobati stirea</a><br><br>';
	}
		

	
?>