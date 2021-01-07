<?php
session_start();
define("PATH_ROOT", dirname(__FILE__));
include_once PATH_ROOT . "/config/Database.php";
include_once PATH_ROOT . "/list/Items.php";

$db = new Database();
$items = new Items($db->getMYSQLI());
$rows = $items->getItemByUserName($_SESSION['username']);

$results = array();
$number_of_rows = mysqli_num_rows($rows);
if($number_of_rows > 0)
{
	
	$results = array();
	while( $row = $rows->fetch_assoc())
	{
		$item = array('id'=>$row['id'],
			'description'=>$row['description'],
			'created_at'=>$row['created_at']);
		array_push($results,$item);
	}

	echo json_encode($results);
}
?>