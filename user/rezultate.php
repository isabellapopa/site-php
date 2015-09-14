<?php
require_once('config.php');


$cerereSQL = 'SELECT * FROM `stiri`';
$rezultat1 = mysql_query($cerereSQL);
while($stire = mysql_fetch_array($rezultat1)) {
	echo '<table width="537" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td height="28" colspan="3" valign="top"><p>'.$stire['stire'].'</p></td>
	</tr>';
	$cerereSQL=mysql_query('UPDATE `voturi` SET `vot`="1" ');
	}
	
	/*while($rand = mysql_fetch_array($rezultat2)) {
		
		if($stire['id']==$rand['stireId']){
			$rand['vot']=$rand['vot']+1;
			$total=mysql_result(mysql_query('SELECT SUM(vot) FROM `voturi`'),0);
		echo '<tr>
		<td width="113" height="19" valign="top"> '.$total.' </td>

		</tr>';
		}
	  }
	} */
		echo '<tr>
		<td height="14"></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td height="24" colspan="3" valign="top"><a href="vizualizareStiri.php">Inapoi la stiri</a> </td>
		</tr>
		</table>';

?>