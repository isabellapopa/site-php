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
$cerereSQL="SELECT * FROM stiri ";
$rezultat=$conn->query($cerereSQL);
$rezultat->setFetchMode(PDO::FETCH_ASSOC);
while($stire=$rezultat->fetch())
{
	echo $stire['stire'];
	echo '<br>';
	echo $stire['status'];
	echo '<br>';
	echo '<a href="arhivareValida.php?stireId='.$stire['id'].'"> Arhivati stirea</a><br><br>';
}
		
?>