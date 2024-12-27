<?php
class Produk {
    private $conn;
    private $table = 'produk';

    public function __construct($db) {
        $this->conn = $db;
    }

    public static function getAll() {
        try {
            $db = new PDO("mysql:host=localhost;dbname=hydrodb", "root", "");
            $stmt = $db->query("SELECT * FROM produk");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Kesalahan: " . $e->getMessage());
        }
    }

    public function create($data) {
        $query = "INSERT INTO $this->table (nama, deskripsi, harga, stok, foto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        $stmt->bind_param(
            "ssdis", 
            $data['nama'], 
            $data['deskripsi'], 
            $data['harga'], 
            $data['stok'], 
            $data['foto']
        );
        if (!$stmt->execute()) {
            die("Execute Error: " . $stmt->error);
        }
        return true;
    }

    public function getById($id) {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function edit($data) {
        $query = "UPDATE $this->table SET nama = ?, deskripsi = ?, harga = ?, stok = ?, foto = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        $stmt->bind_param(
            "ssdisi", 
            $data['nama'], 
            $data['deskripsi'], 
            $data['harga'], 
            $data['stok'], 
            $data['foto'], 
            $data['id']
        );
        if (!$stmt->execute()) {
            die("Execute Error: " . $stmt->error);
        }
        return true;
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            die("Execute Error: " . $stmt->error);
        }
        return true;
    }

    public function search($keyword) {
        $query = "SELECT * FROM $this->table WHERE nama LIKE ? OR deskripsi LIKE ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        $searchTerm = "%" . $keyword . "%";
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
