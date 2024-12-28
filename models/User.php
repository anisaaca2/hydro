<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Mengembalikan data user
    }

    public function registerUser($name, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Enkripsi password
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $name, $email, $hashedPassword, $role);
        return $stmt->execute(); // Mengembalikan true jika berhasil
    }

    public function verifyLogin($email, $password) {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Login berhasil, kembalikan data user
        }
        return null; // Login gagal
    }

    public function logout() {
        session_start();
        session_unset();  // Menghapus semua session variables
        session_destroy(); // Menghancurkan session
        header('Location: ../../views/landing.php'); // Mengarahkan ke halaman login setelah logout
        exit();
    }
    
}
