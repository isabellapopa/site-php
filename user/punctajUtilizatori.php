<?php
require_once('init.php');
$cerereSQL="SELECT * FROM utilizatori ORDER by puncte DESC";
$rezultat=$conn->query($cerereSQL);
$rezultat->setFetchMode(PDO::FETCH_ASSOC);
 $count=0;
 while($utilizator=$rezultat->fetch())
 {
	 if($count<10)
	 {
		 echo $utilizator['utilizator'];
		 echo "<br>";
		 $count ++;
	 }
 }


?>