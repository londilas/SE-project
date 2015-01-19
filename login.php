<?php session_start(); ?>


<?php

$link = mysql_connect("127.0.0.1", "root", "") or die("Could not connect : " . mysql_error());
mysql_select_db("course_system") or die("Could not select database"); 

$id = $_POST['UserName'];
$pw = $_POST['Password'];


$query = "SELECT * FROM account WHERE PASSWORD='$pw'";
$result = mysql_query($query);
$total_records=mysql_num_rows($result);  

for($i=0;$i<$total_records;$i++){

$row = mysql_fetch_assoc($result);

if($id!=null && $pw!= null && $row['ID']==$id){
   $_SESSION['name']=$id;
   echo "Success";
}
}

if($_SESSION['name']==NULL){
   echo "Failed";
   echo "<meta http-equiv='refresh' content='3;url=login.php'>";
}
else{

$query2 = "SELECT * FROM account WHERE ID='$id'";
$result2 = mysql_query($query2);
$row2 = mysql_fetch_assoc($result2);

if($row2['TYPE']=='s')
{
   echo "<meta http-equiv='refresh' content='3;url=student.php'>"; 
}

}

mysql_close($link);

?>
