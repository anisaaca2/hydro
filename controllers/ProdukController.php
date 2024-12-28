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

        // Validasi data
        if ($harga < 0 || $stok < 0) {
            die("Harga atau stok tidak valid.");
        }

        // Proses upload foto
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

        // Simpan data ke database
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
        require_once "../views/produk/edit.php";
    }

    public function update($id) {
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $harga = (int)$_POST['harga'];
        $stok = (int)$_POST['stok'];
        $foto = $_FILES['foto'];

        $produk = $this->produkModel->findById($id);
        $fileName = $produk['foto']; // Gunakan nama file lama jika tidak ada file baru diunggah

        // Proses upload foto baru (opsional)
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
        }

        // Update data di database
        $data = [
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'harga' => $harga,
            'stok' => $stok,
            'foto' => $fileName
        ];

        if ($this->produkModel->update($id, $data)) {
            header("Location: ../public/router.php");
        } else {
            die("Gagal memperbarui data.");
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
    
}
?>
