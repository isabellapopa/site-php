<?php
require_once('config.php');
require_once('init.php');

if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
	
	if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
if(!isset($_SESSION['logat'])) $_SESSION['logat'] = 'Nu';
if($_SESSION['logat'] != 'Da') 
	{
		echo 'Pentru a accesa aceasta pagina, trebuie sa va autentificati. <br>
			Pentru a va autentifica, apasati <a href="autentificare.php">aici</a><br>
			Pentru a va inregistra, apasati <a href="inregistrare.php">aici</a>';
			
	}
	else
	{
		echo 'Bine ai venit, <b><i>'.$_SESSION['user'].'</b></i>!';
		echo'<br><br>';
		echo'<a href="profil.php">Schimba date personale</a><br><br> 
			<a href= "ultimulUtilizator.php"> Ultimul utilizator inregistrat</a><br><br>
			<a href= "utilizatorLenes.php"> Cel mai lenes utilizator</a><br><br>
			<a href= "interzicere.php"> Interzicere user</a><br><br>
			<a href= "vizualizareStiri.php"> Vizualizeaza Stiri</a><br><br>
			<a href= "statistici.php"> Statistici asupra site-ului</a><br><br>
			<a href= "aprobare.php"> Aprobarea unei stiri</a><br><br>
			<a href= "arhivare.php"> Arhivarea unei stiri</a><br><br>
			<a href= "aprobaModerator.php"> Aprobarea moderatorilor</a><br><br>
			<a href= "modificareStire.php"> Modificarea unei stiri</a><br><br>
			
			
			<a href="iesire.php">Iesire</a>';
	}

?>