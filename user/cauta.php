<?php
require_once 'config.php';

if(!isset($_GET['pag'])) $_GET['pag'] = '';
switch($_GET['pag']) {

case '':
echo '<form name="cauta" action="cauta.php?pag=cauta" method="post">
      Titlu: <input type="text" name="cauta" value=""> <input type="submit" name="Cauta" value="Cauta"> <br>
	  <a href="cauta.php?pag=cautare-avansata">Cautare avansata</a>
	  </form>';
break;

case 'cauta':

if($_POST['cauta'] == '') {
echo 'Introdu un cuvant pentru a cauta in baza de date. <br>
      Apasa <a href="cauta.php">aici</a> pentru a te intoarce.';
} elseif(strlen($_POST['cauta']) < 3) {
echo 'Cuvantul trebuie sa contina cel putin 3 caractere. <br>
      Apasa <a href="cauta.php">aici</a> pentru a te intoarce.';
} else {
$cerereSQL = 'SELECT * FROM `stiri` WHERE `stire` LIKE "%'.$_POST['cauta'].'%"'; 
$rezultat = mysql_query($cerereSQL);
if(mysql_num_rows($rezultat) > 0) {
	while($rand = mysql_fetch_array($rezultat))	{
    echo $rand['stire'];
	echo '<br>';
	}   
} else {
echo 'Nu au fost gasite rezultate pentru cautarea: <font color="red"><b><i>'.$_POST['cauta'].'</i></b></font> <br>
	  Apasati <a href="cauta.php">aici</a> pentru a va intoarce';
}

}

break;
case 'cautare-avansata':

echo '<form name="cauta" action="cauta.php?pag=cautare-avansata2" method="post">
      Cauta: <input type="text" name="cauta" value=""> <br><br>
	  in <input type="checkbox" name="in1" value="stire" id="stire"> <label for="stire">Stire</label> 
	  <input type="submit" name="Cauta" value="Cauta"> <br>
	  </form>';
	  
	  case 'cautare-avansata2':

if(!isset($_POST['in1'])) $_POST['in1'] = '';
	
if($_POST['cauta'] == '') {
echo 'Introdu un cuvant pentru a cauta in baza de date. <br>
      Apasa <a href="cauta.php">aici</a> pentru a te intoarce.';
} elseif(strlen($_POST['cauta']) < 3) {

echo 'Cuvantul trebuie sa contina cel putin 3 caractere. <br>
      Apasa <a href="cauta.php">aici</a> pentru a te intoarce.';
} else {


if($_POST['in1'] != '') {
$cerereSQL = 'SELECT * FROM `stiri` WHERE `stire` LIKE "%'.$_POST['cauta'].'%"';
$in = '';
$rezultat = mysql_query($cerereSQL);
	if(mysql_num_rows($rezultat) > 0) {
		echo 'Cautati in: <font color="red">'.$in.'</font> dupa: <font color="red"><b>'.$_POST['cauta'].'</b></font><br><br>';
		while($rand = mysql_fetch_array($rezultat))	{
	    echo $rand['stire'];
		echo '<br>';
		}   
	} else {
	echo 'Nu au fost gasite rezultate pentru cautarea: <font color="red"><b><i>'.$_POST['cauta'].'</i></b></font> in <font color="red">'.$in.'</font><br>
		  Apasati <a href="cauta.php?pag=cautare-avansata">aici</a> pentru a va intoarce';
	}
}

break;

}  

}

?>