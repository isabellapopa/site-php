<?php
require_once('config.php');
require_once('init.php');
if(!isset($_SESSION['stireId'])) $_SESSION['stireId']='';

$cuvinteInterzise = array("test");
$inlocuiesteCu = "<span style=\"color:red; font-style: italic;\">××× </span>";
function cenzura($continut) {
	global $cuvinteInterzise, $inlocuiesteCu;
	foreach($cuvinteInterzise as $cuvinte) {
		$continut = eregi_replace($cuvinte, $inlocuiesteCu, $continut);
		}
		return $continut;
		}
$rezultateLinie = 1;
$rezultateColoane = 1;
$totale = mysql_result(mysql_query('SELECT COUNT(*) AS Nr FROM `stiri`'),0);

if($totale ==0) echo 'Nu exista stiri
					Pentru a va intoarce apasati <a href="pagina.php">aici</a>.';
else {

	if(!isset($_GET['pagina'])) $pagina=1;
	else{
		$pagina = $_GET['pagina'];
	}
}
	
	$cerereSQL=mysql_query('SELECT * FROM `stiri` WHERE `vizibil` =1 AND `status` ="published" ORDER by `id` ASC LIMIT '.(($pagina * ($rezultateColoane*$rezultateLinie)) - ($rezultateColoane*$rezultateLinie)).', '.($rezultateColoane*$rezultateLinie).' ');
	$paginiTotale = ceil( $totale/($rezultateLinie * $rezultateColoane));
	if($pagina > $paginiTotale) echo 'Pagina nu a fost gasita';
	elseif($paginiTotale>0){
		echo '<b>Stiri</b><br><br>';
		$seteaza = 0;
		$numar = ($pagina - 1) * ($rezultateColoane*$rezultateLinie);
		$culoare_celula = '#FFE0B3';
		echo "<table border=\"0\"><tr>\n";
		while($rand = mysql_fetch_array($cerereSQL)){
			$_SESSION['stireId']=$rand['id'];
			$nr++;
			if($seteaza == $rezultateLinie){
				echo "</tr><tr>\n";
				$seteaza=1;
				if($culoareCelula == "#FFE0B3") $culoareCelula = "#FFFFFF";
				else $culoareCelula = "#FFE0B3"; 
			
		}else $seteaza ++;
		if($rand['vizibil'] ==1){
			$rand['stire']= cenzura($rand['stire']);
			echo "<td bgcolor=".$culoare_celula."> ".$rand['stire']."</td>\n";	
			echo '<a href="pagina.php"> Intoarce-te la pagina principala</a><br><br>';
		}
		
		
		}
		
		echo "</tr></table>";
		if($paginiTotale == 1) echo '';
		else{
			echo '<div align="left">';
			if($pagina > 1) {
				$inapoi=($pagina-1);
				echo '<a href="'.$_SERVER['PHP_SELF'].'?pagina='.$inapoi.'">&laquo;</a>&nbsp;';
			}
			for($pagini = 1; $pagini <= $paginiTotale; $pagini++){
				if(($pagina) == $pagini) echo '<b>'.$pagini.'</b>&nbsp;';
				else echo '<a href="'.$_SERVER['PHP_SELF'].'?pagina='.$pagini.'">'.$pagini.'</a>&nbsp;';
			
				}
			if($pagina < $paginiTotale) {
				$inainte = ($pagina + 1);
				echo '<a href=" '.$_SERVER['PHP_SELF'].'?pagina='.$inainte.'">&raquo;</a>&nbsp;';				
				}
				echo '</div>';
		}
	}


		
?>