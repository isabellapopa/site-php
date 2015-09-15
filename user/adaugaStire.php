<?php
require_once('config.php');
require_once('init.php');

if(!isset($_SESSION['stire'])) $_SESSION['stire'] = '';
if(!isset($_GET['actiune'])) $_GET['actiune'] = '';

switch($_GET['actiune']){
	
	case '':
	
	echo '<table width="310" border = "0" cellpadding="0"cellspacing ="0">
<form name="stire" action="adaugaStire.php" method="post">
 <tr>
  <td height="19" align="right" valign="top">Stire:</td>
  <td rowspan="2" valign="top"><textarea name="stire" cols="30" rows="5"
   value="'.$_SESSION['stire'].'">'.$_SESSION['stire'].'</textarea></td>
   <td></td>
 </tr>
 <tr>
   <td height="24" valign="top"><input name="Trimite" type="submit" id="Trimite"
   value="Trimite">
   </td>
  </tr>
  </tr>
</form>
</table>';

	
	case 'validare':

	$_SESSION['stire'] = $_POST['stire'];

	if($_SESSION['stire'] == '')echo 'Pentru a va intoarce apasati <a href="pagina.php">aici</a>.';
	else{
		echo 'Va multumim. <br> 	
			Stirea a fost preluata. <br>
			Pentru a va intoarce apasati <a href="pagina.php">aici</a>.';
		$cerereSQL= "INSERT INTO stiri (`stire` , `utilizatorId`,`status`)
					VALUES ('".$_SESSION['stire']."' ,".$_SESSION['id']." , 'draft') ";
		mysql_query($cerereSQL);			
		$_SESSION['stire'] ='';	
		}
		
	mysql_query("UPDATE utilizatori SET `puncte` =`puncte`+1  WHERE `id` = ".$_SESSION['id']."");
		
	break;
}





?>