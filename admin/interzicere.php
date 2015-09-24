<?php
require_once 'config.php';
require_once 'init.php';
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da')
{
	die('Nu aveti permisiune de accesare');
}
if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da')
{
	die('Nu aveti permisiune de accesare');
}

$_SESSION['utilizator'] = 'oriceon';
$adresa_ip = $_SERVER['REMOTE_ADDR'];
$cerereSQL = 'SELECT * FROM `accesInterzis` WHERE interzis="'.$_SESSION['utilizator'].'"';
$rezultat = $conn->query($cerereSQL);
$rezultat->setFetchMode(PDO::FETCH_ASSOC);
$count=$rezultat->rowCount();
if($count > 0)
{
	while($rand = $rezultat->fetch())
	{
		$motiv = $rand['motiv'];
	}
}
if(isset($motiv))
{
	echo 'Acces interzis asupra paginii, motivul: <i>'.$motiv.'</i>';
}
else
{
	echo 'Continutul paginii.<br>
		Apasa <a href="admin.php">aici</a> pentru a interzice acces-ul asupra paginii.';
}
?>