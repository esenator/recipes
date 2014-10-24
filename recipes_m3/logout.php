<?php
$date_of_expiry = time() - 60 ;
setcookie( "userlogin", "loggerout", $date_of_expiry);
header("location:index.html");
?>