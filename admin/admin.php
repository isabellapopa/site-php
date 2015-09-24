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
if(!isset($_GET['pag']))
{
	$_GET['pag'] = '';
}
switch($_GET['pag'])
{
	case '':
		echo '<form name="adauga" action="admin.php?pag=verifica" method="post">
Utilizator sau Adresa IP <br> <input type="text" name="interzis"><br><br>
Motiv <br> <input type="text" name="motiv"><br><br>
<input type="submit" name="Adauga" value="Adauga">
</form>';
		break;
	case 'verifica':

		if(($_POST['interzis'] == '')  || (strlen($_POST['interzis']) < 2) ||
(strlen($_POST['interzis']) > 255) || ($_POST['motiv'] == '') || (strlen($_POST['motiv'])
< 2) || (strlen($_POST['motiv']) > 255))
		{
			echo 'Completeaza corect campurile. <br>
Vezi daca: ai completat campurile, daca ai scris mai mult de 2 caractere si mai
putin de 255<br><br>
Apasa <a href="admin.php">aici</a> pentru a te intoarce.';
		}
		else
		{
			$cerereSQL = "INSERT INTO accesInterzis (`interzis`, `motiv`) VALUES ('".$_POST['interzis']."','".$_POST['motiv']."');";
			$q=$conn->prepare($cerereSQL);
			$q->execute();
			echo 'Am introdus datele in baza de date. <br>
Apasa <a href="pagina.php">aici</a> pentru a te intoarce la pagina principala.';
			break;
		}
}

?>