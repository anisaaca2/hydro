<?php

require_once '../models/Produk.php';
require_once '../config/database.php';

class ProdukController {
    private $produkModel;

    public function __construct($db) {
        $this->produkModel = new Produk($db);
    }

    public function index() {
        // Menentukan jumlah produk per halaman
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini, default 1
        $offset = ($page - 1) * $limit; // Menghitung offset berdasarkan halaman

        // Mendapatkan produk dengan pagination
        $produkList = $this->produkModel->getPagination($limit, $offset);

        // Mendapatkan total produk untuk menghitung jumlah halaman
        $totalProduk = $this->produkModel->getCount();
        $totalPages = ceil($totalProduk / $limit); // Menghitung total halaman

        require_once "../views/produk/index.php";
    }
    
    public function store() {
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $harga = (int)$_POST['harga'];
        $stok = (int)$_POST['stok'];
        $kategori_id = intval($_POST['kategori_id']);
        $foto = $_FILES['foto'];

        if ($harga < 0 || $stok < 0) {
            die("Harga atau stok tidak valid.");
        }

        if ($foto['error'] === 0) {
            $ext = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
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
            'kategori_id' => $kategori_id,
            'foto' => $fileName
        ];

        if ($this->produkModel->create($data)) {
            header("Location: ../views/produk/index.php");
            exit;
        } else {
            die("Gagal menyimpan data.");
        }
    }

    public function edit($id) {
        $produk = $this->produkModel->getById($id);
        if (!$produk) {
            die("Produk tidak ditemukan.");
        }
        return $produk;
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $deskripsi = $_POST['deskripsi'];
            $harga = (int)$_POST['harga'];
            $stok = (int)$_POST['stok'];
            $kategori_id = intval($_POST['kategori_id']);
            $foto = $_FILES['foto'];

            $targetFile = $_POST['foto_lama'];

            if ($foto['error'] === 0) {
                $ext = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                    die("Format file foto tidak valid.");
                }

                $newFileName = uniqid() . "." . $ext;
                $uploadPath = "../uploads/" . $newFileName;

                if (move_uploaded_file($foto['tmp_name'], $uploadPath)) {
                    $targetFile = $newFileName;
                } else {
                    die("Gagal mengupload foto.");
                }
            }

            $data = [
                'id' => $id,
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'harga' => $harga,
                'stok' => $stok,
                'kategori_id' => $kategori_id,
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
            header("Location: ../views/produk/index.php");
            exit;
        } else {
            die("Gagal menghapus data.");
        }
    }

    public function search() {
        if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
            $keyword = htmlspecialchars(trim($_GET['keyword']));
            $produk = $this->produkModel->search($keyword);
            require_once "../views/produk/search.php";
        } else {
            header("Location: ../public/router.php");
            exit;
        }
    }

    public function show_produk($id) {
        $produk = $this->produkModel->getById($id);
    
        if (!$produk) {
            die("Produk tidak ditemukan.");
        }
    
        $kategori = $this->produkModel->getKategori($produk['kategori_id']);
    
        require_once "../views/produk/show.php";
    }
    
    
}

?>
