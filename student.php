<!DOCTYPE html>
<html>

<?php
	session_start();
	$host   = "127.0.0.1";
	$dbuser = "root";
	$dbpw   = "";
	$dbname = "course_system";
	$link = mysqli_connect($host, $dbuser, $dbpw, $dbname);
	if( mysqli_connect_errno($link) )
		die("Failed to connect to database.");
	$query = "SELECT * FROM grade WHERE ID='".mysqli_real_escape_string($link, $_SESSION['name'])."'";
	$result =  mysqli_query($link, $query);
	$total_records=mysqli_num_rows($result);
	echo "StudentID ClassID Grade<br><br>";
	for ($i=0;$i<$total_records;$i++){
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
		echo "$row[0] $row[2] $row[1]";
		echo "<br>";
	}
	mysqli_close($link);
	?>
	<br>
	<br>
	<a href="index.html">Back</a> to login form.
</html>
