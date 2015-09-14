<?php
require_once('config.php');
require_once('init.php');

$rezultat=mysql_query("SELECT * FROM stiri");

while($stire = mysql_fetch_array($rezultat)){
	if($stire['status'] == 'published') $totalpublished ++;
	if($stire['status'] == 'archive')  $totalarchive ++;
	if($stire['draft'] == 'draft' ) $totaldraft++;
	
}

echo 'Nr de stiri in draft :';
echo $totaldraf;
echo'<br>';
echo 'Nr de stiri in archive :';
echo $totalarchive;
echo'<br>';
echo 'Nr de stiri in published :';
echo $totalpublished;
?>