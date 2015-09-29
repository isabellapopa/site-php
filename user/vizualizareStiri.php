
<?php
require_once "init.php";
error_reporting(0);
$start_record=0;
$endrecord = $_GET['endrecord'];

if(strlen($endrecord) > 0 and (is_numeric($endrecord))) {
	echo 'Data error';
	exit;
}
$limit = 3;
$total_record = $conn->query("SELECT COUNT(id) FROM stiri")->fetchColumn();
if($endrecord < $limit)
{
	$endrecord = 0;
}

switch($_GET['direction']) {
	case "fw" :
		$start_record = $endrecord;
		break;

	case "bk" :
		$start_record = $endrecord - 2 * $limit;
		break;
	default :
		echo "Data Error";
		exit;
		break;

}

if($start_record < 0)
{
	$start_record = 0;

}

$endrecord=$start_record + $limit;

$sql= "SELECT stire FROM stiri LIMIT $start_record , $limit";

$row = $conn->query($sql);
$result = $row->fetchAll(PDO::FETCH_ASSOC);

if($endrecord < $total_record)
{
	$end='yes';
}
else{
	$end='no';

}
$main=array('data' => $result, 'value' => array("endrecord" => "$endrecord", "limit" => "$limit" , "end" => "$end" , "startrecord" => "$start_record" ));
echo json_encode($main);


?>