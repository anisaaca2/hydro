<?php
class Produk {
    private $db;
    private $table = "produk";

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        $query = "INSERT INTO $this->table (nama, deskripsi, harga, stok, foto, kategori_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ssdssi', $data['nama'], $data['deskripsi'], $data['harga'], $data['stok'], $data['foto'], $data['kategori_id']);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table ORDER BY created_at ASC";
        $stmt = $this->db->query($query);
        if ($stmt) {
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function getById($id) {
        if (!is_numeric($id)) {
            return null;
        }
    
        $query = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->db->prepare($query);
    
        if (!$stmt) {
            die("Kesalahan pada prepare statement: " . $this->db->error);
        }
    
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result || $result->num_rows === 0) {
            return null;
        }
    
        return $result->fetch_assoc();
    }

    public function update($data) {
        $query = "UPDATE $this->table SET nama = ?, deskripsi = ?, harga = ?, stok = ?, foto = ?, kategori_id = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ssdissi', $data['nama'], $data['deskripsi'], $data['harga'], $data['stok'], $data['foto'], $data['kategori_id'], $data['id']);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function search($keyword) {
        $query = "SELECT * FROM $this->table WHERE (nama LIKE ? OR deskripsi LIKE ?) ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return [];
        }
        $likeKeyword = "%$keyword%";
        $stmt->bind_param('ss', $likeKeyword, $likeKeyword);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getKategori($kategori_id) {
        $query = "SELECT * FROM kategori WHERE id = ?";
        $stmt = $this->db->prepare($query);
        
        if (!$stmt) {
            die("Kesalahan pada prepare statement: " . $this->db->error);
        }
        
        $stmt->bind_param('i', $kategori_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null; // Kategori tidak ditemukan
    }
    

    public function getPagination($limit, $offset) {
        $query = "SELECT * FROM $this->table ORDER BY created_at ASC LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        
        if (!$stmt) {
            die("Kesalahan dalam query: " . $this->db->error);
            return [];
        }

        $stmt->bind_param('ii', $offset, $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    
    public function getCount() {
        $query = "SELECT COUNT(*) AS total FROM $this->table";
        $result = $this->db->query($query);
        
        if ($result) {
            $row = $result->fetch_assoc();
            return (int) $row['total']; 
        }
        
        return 0;
    }
}
?>
