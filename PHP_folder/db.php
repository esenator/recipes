<?php
try {
     	# MySQL with PDO_MYSQL
        $db = new PDO("mysql:host=localhost;dbname=esenator_db", 'esenator', 'CSC210!ea');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_PERSISTENT, true);
}
catch (PDOException $e) { // remove try/catch to show real exception (not in prod)
    throw new Exception('Could not connect to database.');
}
?>


