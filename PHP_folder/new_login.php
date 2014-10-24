<?php
    echo "top of new login";
    if (!defined('SID')) {
        session_start();
    }
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    try {
        # MySQL with PDO_MYSQL
        $db = new PDO("mysql:host=localhost;dbname=esenator_db", 'esenator', 'CSC210!ea');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_PERSISTENT, true);
    }
    catch (PDOException $e) { // remove try/catch to show real exception (not in prod)
        throw new Exception('Could not connect to database.');
    }

    $newusername = $_REQUEST['username'];
	$newpassword = $_REQUEST['password'];
	$newemail = $_REQUEST['email'];
	register_user($newusername, $newpassword, $newemail, $db);

    function register_user($username, $password, $email, $db) {
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
        header( 'Location: index.html' ) ;
        echo "success";
        return;
    }
?>


