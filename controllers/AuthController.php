<?php

require_once '../config/database.php';

class AuthController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($data) {
        $username = isset($data['username']) ? trim($data['username']) : null;
        $email = isset($data['email']) ? trim($data['email']) : null;
        $password = isset($data['password']) ? trim($data['password']) : null;
        $alamat = isset($data['alamat']) ? trim($data['alamat']) : null;
        $nohp = isset($data['nohp']) ? trim($data['nohp']) : null;
        $role = isset($data['role']) ? trim($data['role']) : null;
    
        if (!$username || !$email || !$password || !$role) {
            return "Semua data wajib diisi (username, email, password, dan role).";
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Format email tidak valid.";
        }
    
        $checkUsername = $this->db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $checkUsername->execute([$username]);
        if ($checkUsername->fetchColumn() > 0) {
            return "Username sudah digunakan. Silakan pilih username lain.";
        }
    
        $checkEmail = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $checkEmail->execute([$email]);
        if ($checkEmail->fetchColumn() > 0) {
            return "Email sudah digunakan. Silakan gunakan email lain.";
        }
    
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, alamat, nohp, role) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([$username, $email, $passwordHash, $alamat, $nohp, $role]);
    
        if ($result) {
            return true;
        } else {
            return "Terjadi kesalahan saat menyimpan data. Silakan coba lagi.";
        }
    }
    
    public function login($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                if (isset($user['password']) && password_verify($password, $user['password'])) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['email'] = $user['email'];

                    if ($user['role'] === 'penjual') {
                        header('Location: ../public/router.php');
                    } elseif ($user['role'] === 'pembeli') {
                        header('Location: ../public/router.php');
                    }
                    return true;
                } else {
                    return "Email atau password salah.";
                }
            } else {
                return "User tidak ditemukan.";
            }
        } else {
            return "Terjadi kesalahan pada server: " . $this->db->error;
        }
    }

    public function editUser($id) {
        require_once '../models/User.php';
        $userModel = new User($this->db);
        $user = $userModel->getUserById($id);
        
        if (!$user) {
            die("User tidak ditemukan.");
        }
        
        return $user; // Mengembalikan data user untuk digunakan di view
    }
    
    public function updateUser($data) {
        require_once '../models/User.php';
        $userModel = new User($this->db);
    
        $id = isset($data['id']) ? $data['id'] : null;
        $username = isset($data['username']) ? trim($data['username']) : null;
        $email = isset($data['email']) ? trim($data['email']) : null;
        $alamat = isset($data['alamat']) ? trim($data['alamat']) : null;
        $nohp = isset($data['nohp']) ? trim($data['nohp']) : null;
        $password = isset($data['password']) ? trim($data['password']) : null;
    
        if (!$username || !$email || !$alamat || !$nohp) {
            return "Semua data wajib diisi (username, email, alamat, dan nomor telepon).";
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Format email tidak valid.";
        }
    
        $result = $userModel->updateUserById($id, $username, $email, $alamat, $nohp, $password);
    
        if ($result) {
            header('Location: ../views/profile/pembeli.php');
            exit;
        } else {
            return "Terjadi kesalahan saat mengupdate data. Silakan coba lagi.";
        }
    }    
    
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ../public/router.php');
        exit();
    }
}
?>
