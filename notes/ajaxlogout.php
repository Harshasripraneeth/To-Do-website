
<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['message']);

echo 'loggedout';
?>
