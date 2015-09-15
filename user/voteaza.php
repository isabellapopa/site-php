<?php
require_once('config.php');
require_once('init.php');
$cerereSQL="SELECT * FROM stiri ";
$rezultat=mysql_query($cerereSQL);
while($stire=mysql_fetch_array($rezultat)){
	echo $stire['stire'];
	echo '<br>';
	echo '<a href="votareValida.php?stireId='.$stire['id'].'"> Votati stirea</a><br><br>';
	}
		

?>