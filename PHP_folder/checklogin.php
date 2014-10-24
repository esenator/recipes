<?php
    if (!defined('SID')) {
        session_start();
    }
    $username = $_POST['username'];
	$password = $_POST['password'];
	login_user($username, $password);

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    functon login_user($username, $password) {
        include 'password.php';
        
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql="SELECT * FROM $user_table WHERE username='$username' and password='$password'";
        $result = mysql_query($sql);
        
        $count=mysql_num_rows($result);
        if($count == 1) {
             $_SESSION['memID'] = $username
        } else {
            echo "wrong username or password"; 
        }

    }
