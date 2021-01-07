<?php
//Open a new connection to the MySQL server
session_start();
$mysqli = mysqli_connect('localhost', 'root', 'test', 'notes');

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);

//VALIDATION

if (strlen($username) < 2) {
    echo 'username';
}   elseif (strlen($password) <= 4) {
    echo 'pshort';
} 

else {
	
	$query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error());
	$num_row = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	
		if ($num_row > 0) {

			if ($password === $row['password']) {
                $_SESSION['username'] = $username;
    	        $_SESSION['msg'] = "successfully logged in";
    	        mysqli_close($mysqli);
				echo 'true';

			}

		} else {

			echo 'false';

		}
		
}

?>