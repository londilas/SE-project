<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Manager Mode</title>
	</head>

	<body>
<?php
	session_start();
	$host   = "127.0.0.1";
	$dbuser = "root";
	$dbpw   = "";
	$dbname = "course_system";
	$link = mysqli_connect($host, $dbuser, $dbpw, $dbname);

	
$szUpLoad = "./upload/";

if( move_uploaded_file($_FILES['file']['tmp_name'],$szUpLoad.$_FILES['file']['name']))
{
   echo "Success";
}
else
{
   echo "Failed";
}
$fp = fopen($szUpLoad.$_FILES['file']['name'], "r");
while ( $ROW = fgetcsv($fp, $_FILES['file']['size']) ) {
	$SQL = "INSERT INTO grade (ID,GRADE,CLASS) VALUES('$ROW[0]','$ROW[1]','$ROW[2]')";
	mysqli_query($link,$SQL);
}
fclose($fp);
echo "<meta http-equiv='refresh' content='3;url=teacher.php'>";
?>

	</body>

</html>
