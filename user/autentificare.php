<?php	

require_once('config.php');
require_once('init.php');

if(!isset($_GET['actiune'])) $_GET['actiune'] = '';
if(!isset($_SESSION['id'])) $_SESSION['id']='';
switch($_GET['actiune'])
{
case '':
echo '<form action="autentificare.php?actiune=validare" method="post">
      Utilizator: <input type="text" name="user" value=""><br>
      Parola: <input type="password" name="parola" value=""><br>
	  <input type="submit" name="Login" value="Login">
	  </form>';
break;

case 'validare':

$_SESSION['user'] = $_POST['user'];

if(($_POST['user'] == '') || ($_POST['parola'] == '')){
	
	echo 'Completeaza casutele. <Br> 
		Apasati <a href="autentificare.php">aici</a> pentru a va intoarce la pagina precedenta.';
	}
	else{
		$selectSQL="SELECT * FROM accesInterzis";
		$rez=mysql_query($selectSQL);
		while($acces=mysql_fetch_array($rez)){
			$cerereSQL = "SELECT * FROM utilizatori WHERE utilizator='".$_POST['user']."' AND parola='".md5($_POST['parola'])."'";
		$rezultat = mysql_query($cerereSQL);
		if(mysql_num_rows($rezultat)==1){
			while($rand=mysql_fetch_array($rezultat)){
				if($acces['interzis'] != $rand['utilizator']){
					$_SESSION['id'] = $rand['id'];
				$_SESSION['logat'] = 'Da';
				echo'<META HTTP-EQUIV=Refresh CONTENT="0;URL=pagina.php">';
				}else{
					echo 'Cont interzis. <Br> 
				Apasati <a href="autentificare.php">aici</a> pentru a va autentifica cu alt cont.';
					
				}
				
			}
		}	else{
			echo 'Date incorecte. <Br> 
				Apasati <a href="autentificare.php">aici</a> pentru a va intoarce la pagina precedenta.';
		}
		
 
	}
	break;
}
}


?>