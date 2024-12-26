<?php
require_once '../config/database.php';

class Produk {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAllProduk() {
        $stmt = $this->pdo->prepare("SELECT * FROM produk");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdukById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduk($nama, $deskripsi, $harga, $stok, $foto) {
        $stmt = $this->pdo->prepare("INSERT INTO produk (nama, deskripsi, harga, stok, foto) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nama, $deskripsi, $harga, $stok, $foto]);
    }

    public function updateProduk($id, $nama, $deskripsi, $harga, $stok, $foto) {
        $stmt = $this->pdo->prepare("UPDATE produk SET nama = ?, deskripsi = ?, harga = ?, stok = ?, foto = ? WHERE id = ?");
        $stmt->execute([$nama, $deskripsi, $harga, $stok, $foto, $id]);
    }

    public function deleteProduk($id) {
        $stmt = $this->pdo->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function searchProduk($keyword) {
        $stmt = $this->pdo->prepare("SELECT * FROM produk WHERE nama LIKE ?");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
