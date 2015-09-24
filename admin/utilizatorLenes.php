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
$cerereSQL= 'SELECT `utilizator`, `vizite` FROM `utilizatori` WHERE `vizite` IS NOT NULL ';
$rezultat=$conn->query($cerereSQL);
$rezultat->setFetchMode(PDO::FETCH_ASSOC);
$min=1000;
while($utilizator=$rezultat->fetch())
{
	if($utilizator['vizite'] < $min)
	{
		$min=$utilizator['vizite'];
	}
}
$cerereSQL= 'SELECT `utilizator`, `vizite` FROM `utilizatori` WHERE `vizite` IS NOT NULL ';
$rezultat=$conn->query($cerereSQL);
$rezultat->setFetchMode(PDO::FETCH_ASSOC);
while($utilizator=$rezultat->fetch())
{
	if($utilizator['vizite'] ==	$min)
	{
		echo 'Utilizatorul cel mai lenes : ';
		echo $utilizator['utilizator'];
		echo ' are : ';
		echo $utilizator['vizite'];
		echo ' vizita';
		echo '<br><br>';
	}
}
	
?>