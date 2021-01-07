<?php

session_start();
define("PATH_ROOT", dirname(__FILE__));
include_once PATH_ROOT . "/config/Database.php";
include_once PATH_ROOT . "/list/Items.php";
$db = (new Database())->getMYSQLI();
$items = new Items($db);
if(strcmp($_POST['action'],"insert") == 0) 
{
if($items->create($_SESSION['username'],$_POST['description']))
 {
 	
 	echo 'successfully inserted';
 }
 else
 {
 	echo 'failed';
 }
}

else if(strcmp($_POST['action'] , "delete") == 0)
{
if($items->delete((int)$_POST['id']))
 {
 	echo 'success';
 }
 else
 {
 	echo 'failed';
 }
}
else if(strcmp($_POST['action'] , "update") === 0)
{
if($items->update($_POST['id'],$_POST['description']))
 {
 	echo 'success';
 }
 else
 {
 	echo 'failed';
 }
}


?>


