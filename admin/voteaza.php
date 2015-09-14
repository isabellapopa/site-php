<?php
require_once('config.php');
require_once('init.php');

if(!isset($_SESSION['stireId'])) $_SESSION['stireId'] ='';
if(!isset($_SESSION['id'])) $_SESSION['id']='';
if(!isset($_POST['Voteaza'])) {
	echo 'Pentru a vota trebuie sa selectati o optiune. <br>
		Apasati <a href="vizualizareStiri.php">aici</a> pentru a va intoarce.';
	}else{
		
		$cerereSQL="INSERT into voturi (`stireId`,`utilizatorId`)
				VALUES (".$_SESSION['stireId'].",".$_SESSION['id'].")";
				$rez=mysql_query($cerereSQL);
		
		
		$selectSQL = "SELECT * FROM utilizatori ";
		$rezultat = mysql_query($selectSQL);
			while($rand=mysql_fetch_array($rezultat)){
				$cerereSQL = mysql_query('UPDATE `utilizatori` SET puncte="'.($rand['puncte']+1).'" WHERE id="'.$_SESSION['id'].'"');
				die($cerereSQL);
				}
			}
	$_SESSION['id'] = '';
	$_SESSION['stireId'] = '';
	echo 'Va multumim! 
	<a href="rezultate.php">Vezi rezultate</a></td><br><br>';
	echo'Pentru a te intoarce apasati <a href="vizualizareStiri.php">aici</a></td>';

?>