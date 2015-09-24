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
$cerereSQL="SELECT * FROM utilizatori WHERE `puncte`>=4 ";
$rezultat=$conn->query($cerereSQL);
$rezultat->setFetchMode(PDO::FETCH_ASSOC);
while($utilizator=$rezultat->fetch())
{
	echo $utilizator['utilizator'];
	echo '<br>';
	if($utilizator['rol'] == 'moderator')
	{
		die('Utilizatorul este deja moderator ');
	}
	else
	{
		echo '<a href="aprobaModeratorValid.php?utilizatorId='.$utilizator['id'].'"> Aproba</a><br><br>';
	}
}
		

	