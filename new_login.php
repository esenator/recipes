<?php
    function register_user($username, $password, $email) {
        // validate information
        // if (!is_string($first_name) || strlen($name) < 1)
        //     throw new Exception('Invalid name (must be at least 1 character long)');
        // else if (!is_int($classyear))
        //     throw new Exception('Class year must be an integral number.');
        // else if (!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        //     throw new Exception('Invalid email address');
        // else if (!is_array($preferences))
        //     throw new Exception('Preferences parameter must be of type array');

        // insert member into db
        include 'db.php';
        include 'password.php';
        
        $password = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $db->prepare('INSERT INTO profiles(username, password, email) VALUES(:username, :password, :email)');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);

        if (!$stmt->execute())
            throw new Exception('Could not insert member into database');
        if ($stmt->rowCount() != 1)
            throw new Exception('Member already exists.');

        // instantiate member object
        $stmt = $db->prepare('SELECT username, password, email FROM profiles WHERE username=:username AND password=:password AND email=:email');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $pasword);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
//        $member = $stmt->fetchObject('Member');
//        if ($member === FALSE)
//            throw new Exception('Could not find member after insertion.');

//        return $member;
    }

	//connect to server
	// mysql_connect("$host", "$username", "$password") or die ("Cannot connect to database"); 
	// mysql_select_db("$db_name") or die ("Cannot select a database");

	$newusername = $_POST['username'];
	$newpassword = $_POST['password'];
	$newemail = $_POST['email'];
	register_user($newusername, $newpassword, $newemail);

	// $sql="SELECT * FROM $user_table WHERE username='$newusername'";
	// $result=mysql_query($sql);

	// $count=mysql_num_rows($result);
	// if($count == 0) {
	// 	$sql = "INSERT INTO $user_table (username, password, firstname, lastname, email) ($newusername, $newpassword, "unknown", "unknown", "unknown")";
	// 	session_register("myusername");
	// 	session_register("mypassword");
	// } else {
	// 	echo "wrong username or password"; 
	// }
    header( 'Location: profile.html' ) ;
?>


