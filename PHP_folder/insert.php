<?php
if (!defined('SID')) {
        session_start();
    }
$con=mysqli_connect("localhost","esenator","CSC210!ea","esenator_db");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$username = mysqli_real_escape_string($con, $_POST['username']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);

$sql="INSERT INTO profiles (username, email, password)
VALUES ('$username', '$email', '$password')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);
?>