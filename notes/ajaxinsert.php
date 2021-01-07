<?php
session_start();
define("PATH_ROOT", dirname(__FILE__));
include_once PATH_ROOT . "/config/Database.php";
include_once PATH_ROOT . "/list/Items.php";
$db = (new Database())->getMYSQLI();
$items = new Items($db);

if($items->create($_SESSION['username'],$_POST['description']))
 {
 	
 	echo 'inserted';
 }
 else
 {
 	echo 'failed';
 }
?>