<?php
    if (!defined('SID')) {
        session_start();
    }

    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    function register_user($username, $password, $email) {
        include 'password.php';
        
        $password = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $db->prepare('INSERT INTO profiles(username, password, email) VALUES(:username, :password, :email)');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);

        try {
            $stmt->execute();
        if ($stmt->rowCount() != 1)
        {
            $_SESSION["login_failure"]="Username is already taken, please choose another";
            header( 'Location: signin.php' );
            return;
        }}
        catch(Exception $e){
            $_SESSION["login_failure"]="Username already exists, please choose another";
            header( 'Location: signin.php' );
            return;
        }

        $stmt = $db->prepare('SELECT username, password, email FROM profiles WHERE username=:username AND password=:password AND email=:email');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $pasword);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $_SESSION('memid') = $username;
        $_SESSION['signed_in'] = 'false';
        header( 'Location: index.html' ) ;
        return;
    }
	$newusername = $_POST['username'];
	$newpassword = $_POST['password'];
	$newemail = $_POST['email'];
	register_user($newusername, $newpassword, $newemail);
    
?>


