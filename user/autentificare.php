<?php

require_once('init.php');

if(!isset($_GET['actiune']))
{
	$_GET['actiune'] = '';
}
if(!isset($_SESSION['id']))
{
	$_SESSION['id']='';
}
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
		if(($_POST['user'] == '') || ($_POST['parola'] == ''))
		{
			echo 'Completeaza casutele. <Br>
               	 Apasati <a href="autentificare.php">aici</a> pentru a va intoarce la pagina precedenta.';
		}
		else
		{
			$cerereSQL = "SELECT * FROM utilizatori WHERE utilizator='".$_POST['user']."' AND parola='".md5($_POST['parola'])."'";
			$rezultat = $conn->query($cerereSQL);
			$rezultat->setFetchMode(PDO::FETCH_ASSOC);
			$count = $rezultat->rowCount();
			if($count == 1)
			{
				while($rand=$rezultat->fetch())
				{
					$selectSQL = "SELECT * FROM accesInterzis WHERE interzis ='".$_POST['user']."' ";
					$rez=$conn->query($selectSQL);
					$rez->setFetchMode(PDO::FETCH_ASSOC);
					$count1=$rez->rowCount();
					if($count1 == 1)
					{
						echo 'Cont interzis. <Br>
                              Apasati <a href="autentificare.php">aici</a> pentru a va autentifica cu alt cont.';
					}
					else
					{
						$_SESSION['id'] = $rand['id'];
						$_SESSION['logat'] = 'Da';
						echo'<META HTTP-EQUIV=Refresh CONTENT="0;URL=pagina.php">';
					}
				}
			}
			else
			{
				echo 'Date incorecte. <Br>
                      Apasati <a href="autentificare.php">aici</a> pentru a va intoarce la pagina precedenta.';
			}



			break;
		}
}


?>


