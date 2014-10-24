<?php
    if (!defined('SID')) {
    session_start();
    }
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    function register_user($username, $password, $email) {
        include 'db.php';
        include 'password.php';
        
        //$password = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $db->prepare('INSERT INTO profiles(username, password) VALUES(:username, :password)');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        try {
            $stmt->execute();
        if ($stmt->rowCount() != 1)
        {
            $_SESSION["login_failure"]="Username is already taken, please choose another";
            header( 'Location: register.php' );
            return;
        }}
        catch(Exception $e){
            $_SESSION["login_failure"]="Username already exists, please choose another";
            header( 'Location: register.php' );
            return;
        }

        $stmt = $db->prepare('SELECT username, password FROM profiles WHERE username=:username AND password=:password');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $pasword);
        $stmt->execute();
        
        //Sets cookie upon successful login
        $date_of_expiry = time() + 60 * 60 * 24 * 30 ;
        setcookie( "userlogin", $username, $date_of_expiry );
        
        header( 'Location: login_success.php' ) ;
        return;
    }
	$newusername = $_POST['username'];
	$newpassword = $_POST['password'];
	register_user($newusername, $newpassword);
?>


