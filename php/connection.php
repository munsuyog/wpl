<?php
// Database credentials
$host = 'localhost';
$port = '5432';
$dbname = 'cycle';
$user = 'postgres';
$password = 'postgres';

try {
    // Establish a connection to the PostgreSQL database
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
?>
