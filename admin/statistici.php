<?php
require_once('config.php');
require_once('init.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
	
	if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da') {
		die('Nu aveti permisiune de accesare');
	}
$rezultat=mysql_query("SELECT * FROM stiri");
$total=0;
$totalarchive=0;
$totaldraft=0;
$totalpublished=0;
while($stire = mysql_fetch_array($rezultat)){
	$total++;
	if($stire['status'] == 'published') $totalpublished ++;
	if($stire['status'] == 'archive')  $totalarchive ++;
	if($stire['draft'] == 'draft' ) $totaldraft++;
	
}
echo 'Nr de stiri in total :';
echo $total;
echo'<br>';
echo 'Nr de stiri in draft :';
echo $totaldraft;
echo'<br>';
echo 'Nr de stiri in archive :';
echo $totalarchive;
echo'<br>';
echo 'Nr de stiri in published :';
echo $totalpublished;


?>