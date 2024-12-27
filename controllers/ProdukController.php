<?php
require_once '../models/Produk.php';
require_once '../config/database.php';

class ProdukController {
    private $model;

    public function __construct() {
        global $conn;
        $this->model = new Produk($conn);
    }

    public function index() {
        $produk = $this->model->getAll();
        require '../views/produk/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_FILES + $_POST);
            header('Location: ../public/router.php');
        } else {
            require '../views/produk/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['id'] = $id;
            $this->model->edit($_FILES + $_POST);
            header('Location: ../public/router.php');
        } else {
            $produk = $this->model->getById($id);
            require '../views/produk/edit.php';
        }
    }

    public function store() {
        // Sanitasi dan validasi input
        $nama = filter_var($_POST['nama'], FILTER_SANITIZE_STRING);
        $harga = filter_var($_POST['harga'], FILTER_VALIDATE_FLOAT);
        $stok = filter_var($_POST['stok'], FILTER_VALIDATE_INT);

        if ($harga <= 0 || $stok < 0) {
            die("Harga dan stok harus valid.");
        }

        $foto = $_FILES['foto'];
        if ($foto['size'] > 2 * 1024 * 1024) {
            die("Ukuran file terlalu besar (maksimum 2MB).");
        }
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($foto['type'], $allowedTypes)) {
            die("Format file tidak valid.");
        }
        $targetDir = "../uploads/";
        $filename = uniqid() . "-" . basename($foto['name']);
        $targetFile = $targetDir . $filename;
        move_uploaded_file($foto['tmp_name'], $targetFile);

        try {
            $db = new PDO("mysql:host=localhost;dbname=hydrodb", "root", "");
            $stmt = $db->prepare("INSERT INTO produk (nama, harga, stok, foto) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nama, $harga, $stok, $filename]);
            echo "Produk berhasil ditambahkan.";
        } catch (PDOException $e) {
            die("Kesalahan: " . $e->getMessage());
        }
    }
    

    public function delete($id) {
        $this->model->delete($id);
        header('Location: ../public/router.php');
    }

    public function search() {
        $keyword = $_GET['keyword'] ?? '';
        $produk = $this->model->search($keyword);
        require '../views/produk/index.php';
    }
}
?>