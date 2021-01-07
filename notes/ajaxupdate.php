<?php
session_start();
define("PATH_ROOT", dirname(__FILE__));
include_once PATH_ROOT . "/config/Database.php";
include_once PATH_ROOT . "/list/Items.php";
$db = (new Database())->getMYSQLI();
$items = new Items($db);

if($items->update($_POST['id'],$_POST['description']))
 {
 	echo 'true';
 }
 else
 {
 	echo 'failed';
 }

?>