<?php
require_once('config.php');
require_once('init.php');
$cerereSQL="SELECT * FROM stiri ";
$rezultat= $conn->query($cerereSQL);
$rezultat->setFetchMode(PDO::FETCH_ASSOC);
while($stire=$rezultat->fetch())
{
	echo $stire['stire'];
	echo '<br>';
	echo '<a href="votareValida.php?stireId='.$stire['id'].'"> Votati stirea</a><br><br>';
}


?>