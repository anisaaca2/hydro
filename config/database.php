<?php
// Database connection
$dbname = 'hydrodb';
$host = 'localhost';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>