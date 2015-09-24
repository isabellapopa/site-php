<?php

require_once('init.php');

$selectSQL="SELECT * FROM stiri";
$rezultat=$conn->query($selectSQL);
$rezultat->setFetchMode(PDO::FETCH_ASSOC);
while($stire = $rezultat->fetch())
{
	if($stire['status'] == 'published') $totalpublished ++;
	if($stire['status'] == 'archive')  $totalarchive ++;
	if($stire['draft'] == 'draft' ) $totaldraft++;
	
}

echo 'Nr de stiri in draft :';
echo $totaldraft;
echo'<br>';
echo 'Nr de stiri in archive :';
echo $totalarchive;
echo'<br>';
echo 'Nr de stiri in published :';
echo $totalpublished;

?>