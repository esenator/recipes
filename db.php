<?php

/**
 * Database Tools
 * Include file to connect to a database. Recommended approach is to set $db to
 * a local variable in the class.
 *
 * /classes/db.php
 */

// connect to the database
try {
	# MySQL with PDO_MYSQL
  	$DBH = new PDO("mysql:host=$esenator.rochestercs.org ;dbname=$esenator_db", $user, $pass);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_PERSISTENT, true);
}
catch (PDOException $e) { // remove try/catch to show real exception (not in prod)
    throw new Exception('Could not connect to database.');
}

?>