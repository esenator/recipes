<?php
    if (!defined('SID')) {
        session_start();
        }

    ob_start();
    $host="localhost"; // Host name 
    $username="esenator"; // Mysql username 
    $password="CSC210!ea"; // Mysql password 
    $db_name="esenator_db"; // Database name 
    $tbl_name="profiles"; // Table name 


    // Connect to server and select databse.
    mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
    mysql_select_db("$db_name")or die("cannot select DB");

    // Define $myusername and $mypassword 
    $username=$_POST['username']; 
    $password=$_POST['password']; 

    // To protect MySQL injection (more detail about MySQL injection)
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysql_real_escape_string($username);
    $password = mysql_real_escape_string($password);
    $sql="SELECT * FROM $tbl_name WHERE username='$username' and password='$password'";
    $result=mysql_query($sql);

    // Mysql_num_row is counting table row
    $count=mysql_num_rows($result);

    // If result matched $username and $password, table row must be 1 row
    if($count==1)
    {
        $date_of_expiry = time() + 60 * 60 * 24 * 30 ;
        setcookie( "userlogin", $username, $date_of_expiry );
        header("location:login_success.php");
        return;
    }
    else {
        $_SESSION["login_failure"]="Username or password is incorrect";
            header( 'Location: signin.php' );
    }
    ob_end_flush();
?>
