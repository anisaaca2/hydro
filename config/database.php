<?php
// Database connection
$dbname = 'hydrodb';
$host = 'localhost';
$username = 'root';
$password = '';

try {
    $db = new mysqli($host, $username, $password, $dbname);
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
?>