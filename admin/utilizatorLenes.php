<?php
require_once('config.php');
require_once('init.php');
	
	if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
	
	if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
	$cerereSQL= 'SELECT `utilizator`, `vizite` FROM `utilizatori` WHERE `vizite` IS NOT NULL ';
	$rezultat=mysql_query($cerereSQL);    
	$min=1000;
	while($utilizator=mysql_fetch_array($rezultat)){
			if($utilizator['vizite'] < $min) $min=$utilizator['vizite'];
		}
	$cerereSQL= 'SELECT `utilizator`, `vizite` FROM `utilizatori` WHERE `vizite` IS NOT NULL ';
	$rezultat=mysql_query($cerereSQL);
	while($utilizator=mysql_fetch_array($rezultat)){
		if($utilizator['vizite'] ==	$min) {
			echo 'Utilizatorul cel mai lenes : ';
			echo $utilizator['utilizator'];
			echo ' are : ';
			echo $utilizator['vizite'];
			echo ' vizita';
			echo '<br><br>';
		}
	}
	
	


?>