<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Teacher Mode</title>
	</head>
	<body>

<?php
	session_start();
	$host   = "127.0.0.1";
	$dbuser = "root";
	$dbpw   = "";
	$dbname = "course_system";
	$link = mysqli_connect($host, $dbuser, $dbpw, $dbname);
	// Make sure the connection is available.
	if( mysqli_connect_errno($link) )
		die("<h2>Failed to connect to database.</h2>");
	// If the user has not logged in.
	if( isset($_SESSION['name']) == false ){
		echo "<meta http-equiv='refresh' content='3;url=index.html'>";
		die("<h2>You have not logged in yet.</h2>");
		}
	$query = "SELECT * FROM teach WHERE ID='".mysqli_real_escape_string($link, $_SESSION['name'])."'";
	$result =  mysqli_query($link, $query);
	$total_records=mysqli_num_rows($result);
	echo "ClassID TeacherID<br><br>";
	for ($i=0;$i<$total_records;$i++){
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
		echo "$row[0] $row[1]";
		echo "<br>";
	}
	echo "<br>";
	echo "<br>";
?>


Upload Grade sheet(use .CSV file):

<form action="upload.php" method="post" enctype="multipart/form-data">
Filename:<input type="file" name="file" id="file" /><br />
<input type="submit" name="submit" value="Upload" />
</form>
<br>
<a href="logout.php">Logout</a>
</body>
</html>
