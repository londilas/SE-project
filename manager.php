<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Manager Mode</title>
	</head>

	<body>

		<?php

		session_start();

		// Change this if database is changed.
		$DatabaseHost     = "127.0.0.1";
		$DatabaseUser     = "root";
		$DatabasePassword = "";
		$DatabaseName     = "course_system";

		$Connection = mysqli_connect($DatabaseHost, $DatabaseUser, $DatabasePassword, $DatabaseName);

		// Make sure the connection is available.
		if( mysqli_connect_errno($Connection) )
			die("<h2>Failed to connect to database.</h2>");

		// If the user has not logged in.
		if( isset($_SESSION['name']) == false )
			die("<h2>You have not logged in yet.</h2>");

		// Handle request.
		if( isset( $_POST['UserName'] )
		 && isset( $_POST['Action'] ) ){

			$SQLCommand = "INVALID";

			// Add a new user.
			if( $_POST['Action'] == "Add"
			 && isset( $_POST['Password'] )
			 && isset( $_POST['Identity'] ) 
			 && ( $_POST['Identity'] == "s"
			   || $_POST['Identity'] == "t"
			   || $_POST['Identity'] == "m" ) )
				$SQLCommand = "INSERT INTO account (ID, TYPE, PASSWORD) VALUES('".mysqli_real_escape_string($Connection, $_POST['UserName'])."', '".mysqli_real_escape_string($Connection, $_POST['Identity'])."', '".mysqli_real_escape_string($Connection, $_POST['Password'])."')";
			// Remove a user by a user name.
			else if( $_POST['Action'] == "Remove" )
				$SQLCommand = "DELETE FROM account WHERE ID='".mysqli_real_escape_string($Connection, $_POST['UserName'])."'";

			// If it's a valid request from GET, this won't be empty.
			if( $SQLCommand != "INVALID" ){

				if( mysqli_query($Connection, $SQLCommand) == false )
					die("<h2>Failed to add/remove the user.</h2>");
				
				}

			}


		// Handle output here.
		$SQLCommand = "SELECT * FROM account";
		$QueryResult = mysqli_query($Connection, $SQLCommand);

		if( $QueryResult == false )
			die("<h2>Failed to query user information.</h2>");

		echo "<h2>Manager Mode</h2><hr/><h3>User List</h3><ul>";

		while( $CurrentRow = mysqli_fetch_array($QueryResult) )
			echo "<li>".htmlspecialchars($CurrentRow['ID']).", ".htmlspecialchars($CurrentRow['PASSWORD']).", ".$CurrentRow['TYPE']."</li>";					

		echo "</ul><br/>";

		mysqli_close($Connection);

		?>

		<h3>User Management</h3>
		<form method="POST" action="manager.php">
			<ul>
				<li>Account: <input  type="text"     name="UserName" /></li>
				<li>Password: <input type="password" name="Password" /></li>
				<li>Identity: <input type="radio" name="Identity" value="s" checked />Student
					      <input type="radio" name="Identity" value="t" />Teacher
					      <input type="radio" name="Identity" value="m" />Manager</li>
				<li>Action: <input type="radio" name="Action" value="Add" checked />Add
					    <input type="radio" name="Action" value="Remove" />Remove</li>
			</ul>
			&nbsp;<input type="submit" /> 
		</form>

	</body>

</html>
