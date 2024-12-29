<?php

require_once '../models/Produk.php';
require_once '../config/database.php';

class ProdukController {
    private $produkModel;


    public function __construct($db) {
        $this->produkModel = new Produk($db);
    }

    public function index() {
        $produk = $this->produkModel->getAll();
        require_once "../views/produk/index.php";
    }

    public function store() {
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $harga = (int)$_POST['harga'];
        $stok = (int)$_POST['stok'];
        $foto = $_FILES['foto'];

        if ($harga < 0 || $stok < 0) {
            die("Harga atau stok tidak valid.");
        }

        if ($foto['error'] === 0) {
            $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                die("Format file foto tidak valid.");
            }

            $fileName = uniqid() . "." . $ext;
            $uploadPath = "../uploads/" . $fileName;

            if (!move_uploaded_file($foto['tmp_name'], $uploadPath)) {
                die("Gagal mengupload foto.");
            }
        } else {
            die("Foto wajib diunggah.");
        }

        $data = [
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'harga' => $harga,
            'stok' => $stok,
            'foto' => $fileName
        ];

        if ($this->produkModel->create($data)) {
            header("Location: ../public/router.php");
        } else {
            die("Gagal menyimpan data.");
        }
    }

    public function edit($id) {
        $produk = $this->produkModel->findById($id);
        if (!$produk) {
            die("Produk tidak ditemukan.");
        }
        return $produk;
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $foto = $_FILES['foto'];
        
            if ($foto['error'] == 0) {
                $targetDir = "../uploads/";
                $targetFile = $targetDir . basename($foto['name']);
                move_uploaded_file($foto['tmp_name'], $targetFile);
            } else {
                $targetFile = $_POST['foto_lama'];
            }
        
            $data = [
                'id' => $id,
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'harga' => $harga,
                'stok' => $stok,
                'foto' => $targetFile
            ];
            if ($this->produkModel->update($data)) {
                header("Location: ../public/router.php?action=show&id=" . $id);
                exit;
            } else {
                die("Gagal memperbarui produk.");
            }
        }
    }

    public function destroy($id) {
        if ($this->produkModel->delete($id)) {
            header("Location: ../public/router.php");
        } else {
            die("Gagal menghapus data.");
        }
    }

    public function search() {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $produk = $this->produkModel->search($keyword);
            require_once "../views/produk/index.php";
        } else {
            header("Location: ../public/router.php");
        }
    }

    public function show($id) {
        // Ambil data produk berdasarkan ID
        $produk = $this->produkModel->getById($id);
    
        if (!$produk) {
            die("Produk tidak ditemukan.");
        }
    
        // Pass data produk ke view
        require_once '../../views/produk/show.php';
    }
    
    
}
?>
