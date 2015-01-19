<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="refresh" content="3;url=index.html">
		<title>Logout</title>
	</head>

	<body>

		<?php
		
		session_start();

		if( isset($_SESSION['name']) )
			echo "<h2>See you next time!</h2><br/>Redirect to index page now...";
		else
			echo "<h2>You've not logged in yet.</h2><br/>";
		
		session_destroy();
		
		?>

	</body>
</html>
