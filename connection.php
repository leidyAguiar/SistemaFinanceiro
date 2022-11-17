<?php
/**
 * Create Database Connection
 */

define ( 'DB_HOST', 'localhost' );
define ( 'DB_USER', 'root' );
define ( 'DB_PASSWORD', '' );
define ( 'DB_NAME', 'financeiro' );

// Create connection using mysqli_connect()
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// If $conn is false, connection is failed
if (!$conn ) {
  die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>           