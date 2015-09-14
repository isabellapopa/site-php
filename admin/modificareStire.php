<?php
require_once('config.php');
require_once('init.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
	
	if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
if(!isset($_GET['actiune'])) $_GET['actiune'] = '';

switch($_GET['actiune'])
	{
		case '':
			echo '<h1>Stiri</h1>
				Apasati <a href="modificareStire.php?actiune=modificareStiri">aici</a> pentru a schimba datele stirilor.<br>
				<a href="pagina.php">Intoarceti-va la pagina principala.</a>';
	break;
	case 'modificareStiri':
			$cerereSQL = 'SELECT * FROM stiri'; 
			$rezultat = mysql_query($cerereSQL);
			while($rand = mysql_fetch_array($rezultat))
				{
					
  echo'<table width="347" border="0" cellpadding="0" cellspacing="0">
	<form name="formular" action="modificareStire.php?actiune=validare&stireId='.$rand['id'].'" method="post">
	<tr>
    <td width="80" height="19">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="214">&nbsp;</td>
    <td width="38">&nbsp;</td>
    </tr>

  <tr>
    <td height="10"></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="22" align="right" valign="top">Stire:</td>
    <td valign="top"></td>
    <td valign="top"><input type="text" name="stire" value="'.$rand['stire'].'"></td>
    <td></td>
    </tr>
  <tr>
    <td height="9"></td>
    <td valign="top"></td>
    <td></td>
    <td></td>
    </tr>
	 <tr>
    <td height="24"></td>
    <td valign="top"></td>
    <td valign="top"><input name="Trimite" type="submit" id="Trimite" value="Modifica Stiri">
    <td></td>
    </tr>
  <tr>
    <td height="19"></td>
    <td valign="top"></td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
  </form>
</table>';
				}
			break;
				
			case 'validare':
				if(!isset($_POST['stire'])) $_SESSION['stire'] = '';
				else $_SESSION['stire'] = $_POST['stire'];
				if(($_POST['Trimite'] == 'Modifica Stiri') && ($_SESSION['stire'] == '')){
					echo 'Completeaza campurile.<br>
						Apasa <a href="modificareStiri.php?actiune=modificareStiri">aici</a> pentru a te intoarce.';
				}
				elseif(($_POST['Trimite'] == 'Modifica Stiri') && ($_SESSION['stire'] != '')){
					echo 'Datele au fost modificate. <br>
						Apasa <a href="pagina.php">aici</a> pentru a te intoarce la pagina principala.';
						if(isset($_GET['stireId']) && (int)$_GET['stireId'] > 0) {
					$cerereSQL = "UPDATE stiri SET stire='".$_SESSION['stire']."' WHERE `id` = ".(int)$_GET['stireId']."";
					mysql_query($cerereSQL);	
						}
				}
					$_SESSION['stire'] = '';
				
				
	break;
	}
	
?>