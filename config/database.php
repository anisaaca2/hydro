<?php
// Database connection
$dbname = 'hydrodb';
$host = 'localhost';
$username = 'root';
$password = '';

// $conn = new mysqli($host, $user, $password, $dbname);

// if ($conn->connect_error) {
//     die("Koneksi gagal: " . $conn->connect_error);
// }

try {
    $db = new mysqli($host, $username, $password, $dbname);
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
?>