<?php

$host = //host name
$username = "esenator"; //mysql username
$password = "CSC210!ea"; //mysql password
$db_name = "esenator_db"; //name of db
$user_table = "profiles"; //name of table of users

//connect to server
mysql_connect("$host", "$username", "$password") or die ("cannot cannect to database"); 
mysql_select_db("$db_name") or die ("cannot select a database");

$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $user_table WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count == 1) {
	session_register("myusername");
	session_register("mypassword");
	header("location: login_success.php"); 
} else {
	echo "wrong username or password"; 
}

?>
