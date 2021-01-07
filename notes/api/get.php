<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once "../config/Database.php";
include_once "../list/items.php";

$db = new Database();
$items = new Items($db->getMYSQLI());
$rows;
if(isset($_GET['id']))
$rows = $items->getItemById($_GET['id']);
else
$rows = $items->getItems();

$results = array();
$number_of_rows = mysqli_num_rows($rows);
echo "travaersed";
if($number_of_rows > 0)
{
	
	while( $row = $rows->fetch_assoc())
	{
		$item = array('id'=>$row['id'],'username'=>$row['username'],
			'description'=>$row['description'],
			'created_at'=>$row['created_at']);
		array_push($results[],$item);
	}

	echo json_encode($results);
}
else
{
   echo json_encode(array('message'=> 'no results found'));
}


?>