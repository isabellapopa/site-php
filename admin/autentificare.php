<?php	

require_once('config.php');
require_once('init.php');

if(!isset($_GET['actiune'])) $_GET['actiune'] = '';
if(!isset($_SESSION['id'])) $_SESSION['id']='';
if(!isset($_SESSION['vizite'])) $_SESSION['']='';
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
$update1SQL=mysql_query("UPDATE `utilizatori` SET `rol`= 'admin' WHERE `utilizator`='admin'");
$update1SQL=mysql_query("UPDATE `utilizatori` SET `rol`= 'editor' WHERE `utilizator`='editor'");

if(($_POST['user'] == '') || ($_POST['parola'] == '')){
	
	echo 'Completeaza casutele. <Br> 
		Apasati <a href="autentificare.php">aici</a> pentru a va intoarce la pagina precedenta.';
	}
	else{
		
		$cerereSQL = "SELECT * FROM utilizatori WHERE utilizator='".$_POST['user']."' AND parola='".md5($_POST['parola'])."'";
		$rezultat = mysql_query($cerereSQL);
		if(mysql_num_rows($rezultat)==1 ){
			while($rand=mysql_fetch_array($rezultat)){
				$cerereSQL = 'UPDATE `utilizatori` SET vizite="'.($rand['vizite']+1).'" WHERE id="'.$rand['id'].'"';
				$rezultat = mysql_query($cerereSQL);
				if($rand['rol']=='admin'){
					$_SESSION['logat'] = 'Da';
					$_SESSION['admin'] = 'Da';
					$_SESSION['editor'] = 'Da';
					echo'<META HTTP-EQUIV=Refresh CONTENT="0;URL=pagina.php">';
				} elseif($rand['rol']=='editor') {
					$_SESSION['logat'] = 'Da';
					$_SESSION['editor'] = 'Da';
					echo'<META HTTP-EQUIV=Refresh CONTENT="0;URL=pagina.php">';
				} else {
					$_SESSION['logat'] = 'Da'; 
					echo'<META HTTP-EQUIV=Refresh CONTENT="0;URL=pagina.php">';
				}
			}
				
		}
		else{
			echo 'Date incorecte. <Br> 
				Apasati <a href="autentificare.php">aici</a> pentru a va intoarce la pagina precedenta.';
		}
 
	}
	break;
}
				


?>