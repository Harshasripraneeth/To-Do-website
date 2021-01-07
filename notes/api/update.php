<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-methods,Authorization,X-Requested-With');


include_once '../config/Database.php';
include_once '../list/items.php';

$database = new Database();
$items = new Items($database->getMYSQLI());

$data = json_decode(file_get_contents("php://input"));
 if($items->update($data->id,$data->description))
 {
 	echo json_encode(array("message"=>"updated successful"));
 }
 else
 {
 	echo json_encode(array("message"=>"An error Occured"));
 }


?>
