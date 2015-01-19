<!DOCTYPE html>
<html>

<?php
	session_start();

	// This is unsafe!
	$host   = "127.0.0.1";
	$dbuser = "root";
	$dbpw   = "";
	$dbname = "course_system";

	$link = mysqli_connect($host, $dbuser, $dbpw, $dbname);

	if( mysqli_connect_errno($link) )
		die("Failed to connect to database.");

	if( isset($_POST['UserName']) == false || isset($_POST['Password']) == false ){
		die("UserName or Password is not set.");
		}

	$id = $_POST['UserName'];
	$pw = $_POST['Password'];

	$query = "SELECT * FROM account WHERE ID='".mysqli_real_escape_string($link, $id)."'";
	$current_row = mysqli_fetch_array( mysqli_query($link, $query) );

	if( $current_row && $current_row['PASSWORD'] == $pw ){

		$_SESSION['name'] = $id;
		$_SESSION['identity'] = $current_row['TYPE'];
		
		// If no such type, log him out.
		$redirect = "logout.php";

		if( $_SESSION['identity'] == "m" )
			$redirect = "manager.php";
		else if( $_SESSION['identity'] == "t" )
			$redirect = "teacher.php";
		else if( $_SESSION['identity'] == "s" )
			$redirect = "student.php";
		
		echo "<head><meta http-equiv='refresh' content='3;url=".$redirect."'>";
		echo "<title>Success!</title></head>";
		echo "<body><h2>Redirecting...</h2></body>";

		}
	else{

		echo "<head><meta http-equiv='refresh' content='3;url=login.php'>";
		echo "<title>Login Failed!</title></head>";
		echo "<body><h2>Login failed!</h2></body>";

		}
	
	mysqli_close($link);

	?>

</html>
