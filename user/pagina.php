<?php
require_once('init.php');

function formatare($txt)
{
	$deInloc = $cuInloc = array();
	$deInloc[] = ":))";
	$cuInloc[] = "<img src=\"zambaret_1.gif\" align=\"middle\" alt=\"&#058;&#041;&#041;\" title=\"&#058;&#041;&#041;\" border=\"0\">";
	foreach($deInloc as $nume => $valoare)
	{
		$txt = eregi_replace($valoare, $cuInloc[$nume], $txt);
	}
	$txt = nl2br($txt);
	return $txt;
}
if(!isset($_SESSION['logat']))
{
	$_SESSION['logat'] = 'Nu';
}
if($_SESSION['logat'] != 'Da') 
	{
		echo 'Pentru a accesa aceasta pagina, trebuie sa va autentificati. <br>
			Pentru a va autentifica, apasati <a href="autentificare.php">aici</a><br>
			Pentru a va inregistra, apasati <a href="inregistrare.php">aici</a>';
			
	}
	else
	{
		echo 'Bine ai venit, <b><i>'.$_SESSION['user'].'</b></i>!';
		echo formatare(":))");
		echo'<br><br>';
		echo'<a href="profil.php">Schimba date personale</a><br><br> 
			<a href= "adaugaStire.php"> Adauga o stire</a><br><br>
			<a href= "vizualizareStiri.php"> Vizualizeaza Stiri</a><br><br>
			<a href= "punctajUtilizatori.php"> Top 10 utilizatori</a><br><br>
			<a href= "cauta.php">Cauta Stire</a><br><br>
			<a href= "voteaza.php">Voteaza stirile</a><br><br>
			<a href="iesire.php">Iesire</a>';
	}

?>