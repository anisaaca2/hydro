<?php
class Produk {
    private $db;
    private $table = "produk";

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        $query = "INSERT INTO $this->table (nama, deskripsi, harga, stok, foto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            $data['nama'],
            $data['deskripsi'],
            $data['harga'],
            $data['stok'],
            $data['foto']
        ]);
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table ORDER BY created_at ASC";
        $stmt = $this->db->query($query);
        if ($stmt) {
            return $stmt->fetch_all(MYSQLI_ASSOC); // Gunakan fetch_all() milik mysqli
        } 
        return [];
    }
    
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function findById($id) {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }
    

    public function update($data) {
        $query = "UPDATE produk SET nama = ?, deskripsi = ?, harga = ?, stok = ?, foto = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssdiss', $data['nama'], $data['deskripsi'], $data['harga'], $data['stok'], $data['foto'], $data['id']);
        return $stmt->execute();
    }

    // public function update($id, $nama, $deskripsi, $harga, $stok, $foto = null) {
        
    //         $query = "UPDATE produk SET nama = ?, deskripsi = ?, harga = ?, stok = ?, foto = ? WHERE id = ?";
    //         $stmt = $this->db->prepare($query);
    //         $stmt->bind_param('ssssi', $nama, $deskripsi, $harga, $stok, $foto, $id);
    //     return $stmt->execute();
    // } 

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }

    public function search($keyword) {
        $query = "SELECT * FROM $this->table WHERE nama LIKE ? OR deskripsi LIKE ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        if ($stmt) {
            $likeKeyword = "%$keyword%"; // Format keyword untuk LIKE
            $stmt->bind_param('ss', $likeKeyword, $likeKeyword); // Bind parameter untuk dua kolom
            $stmt->execute();
            $result = $stmt->get_result(); // Ambil hasil eksekusi
            return $result->fetch_all(MYSQLI_ASSOC); // Gunakan fetch_all() untuk banyak baris
        }
        return [];
    }
}
?>
