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
        $query = "SELECT * FROM $this->table ORDER BY created_at DESC";
        $stmt = $this->db->query($query); // Gunakan query() untuk eksekusi langsung pada mysqli
        if ($stmt) {
            return $stmt->fetch_all(MYSQLI_ASSOC); // Gunakan fetch_all() milik mysqli
        }
        return [];
    }

    public function findById($id) {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt) {
            $stmt->bind_param('i', $id); // Bind parameter untuk ID
            $stmt->execute();
            $result = $stmt->get_result(); // Ambil hasil eksekusi
            return $result->fetch_assoc(); // Gunakan fetch_assoc() untuk satu baris
        }
        return null;
    }

    public function update($id, $data) {
        $query = "UPDATE $this->table SET nama = ?, deskripsi = ?, harga = ?, stok = ?, foto = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            $data['nama'],
            $data['deskripsi'],
            $data['harga'],
            $data['stok'],
            $data['foto'],
            $id
        ]);
    }

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
