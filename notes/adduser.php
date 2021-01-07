<?php
//Open a new connection to the MySQL server
session_start();
define("PATH_ROOT", dirname(__FILE__));
include_once PATH_ROOT . "/config/Database.php";

$database = new Database();

$mysqli = $database->getMYSQLI();


//Output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$confirmPassword = mysqli_real_escape_string($mysqli, $_POST['confirmPassword']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);

//VALIDATION

if (strlen($username) < 2) {
    echo 'username';
} elseif (strlen($email) <= 4) {
    echo 'eshort';
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo 'eformat';
} elseif (strlen($password) <= 4) {
    echo 'pshort';
} 
elseif ($confirmPassword !== $password) {
    echo 'confirmPassword';
} 
else {
	
	//PASSWORD ENCRYPT
	//$spassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
	
	$query = "SELECT * FROM users WHERE email = '$email' or username = '$username' LIMIT 1";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error());
	$num_row = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	
		if ($num_row < 1) {

			$insert_row = $mysqli->query("INSERT INTO users(username,email,password) VALUES ('$username','$email','$password')");

			if ($insert_row) {
                $_SESSION['username'] = $username;
    	        $_SESSION['msg'] = "successfully registered";
    	        mysqli_close($mysqli);
				echo 'true';

			}

		} else {

			echo 'false';

		}
		
}

