<?php
require_once('config.php');
require_once('init.php');


if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
	
	if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}

 $cerereSQL="SELECT * FROM utilizatori ORDER by id DESC LIMIT 1";
 $rezultat=mysql_query($cerereSQL);

while($utilizator = mysql_fetch_array($rezultat)){
	
	echo $utilizator['utilizator'];
	break;
	
}
?>