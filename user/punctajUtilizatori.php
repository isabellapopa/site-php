<?php
require_once('config.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
	
	if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
 $cerereSQL="SELECT * FROM utilizatori ORDER by puncte DESC";
 $rezultat=mysql_query($cerereSQL);
 $count=0;
 while($utilizator=mysql_fetch_array($rezultat)){
	 if($count<10){
		 echo $utilizator['utilizator'];
		 echo "<br>";
		 $count ++;
	 }
 }
?> 