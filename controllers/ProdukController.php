<?php
require_once '../models/Produk.php';

class ProdukController {
    private $produkModel;

    public function __construct() {
        $this->produkModel = new Produk();
    }

    public function index() {
        $produk = $this->produkModel->getAllProduk();
        require_once '../views/produk/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $foto = $this->uploadFoto();
        
            if ($foto) {
                $this->produkModel->createProduk($nama, $deskripsi, $harga, $stok, $foto);
                header('Location: index.php');
            } else {
                echo "Gagal meng-upload foto.";
            }
        }

        require_once '../views/produk/create.php';
    }

    public function edit($id) {
        $produk = $this->produkModel->getProdukById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];

            $foto = isset($_FILES['foto']) && $_FILES['foto']['error'] == 0 ? $this->uploadFoto() : $produk['foto'];

            if ($this->produkModel->updateProduk($id, $nama, $deskripsi, $harga, $stok, $foto)) {
                header('Location: index.php');
            }
        }

        require_once '../views/produk/edit.php';
    }

    public function delete($id) {
        $this->produkModel->deleteProduk($id);
        header('Location: index.php');
    }

    public function search() {
        if (isset($_POST['search'])) {
            $keyword = $_POST['search'];
            $produk = $this->produkModel->searchProduk($keyword);
            require_once '../views/produk/index.php';
        }
    }

    private function uploadFoto() {
        $targetDir = "../uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        $hashedFileName = hash('sha256', uniqid() . $_FILES["foto"]["name"]) . '.' . $imageFileType;
        $targetFile = $targetDir . $hashedFileName;

        if (getimagesize($_FILES["foto"]["tmp_name"])) {
            if ($_FILES["foto"]["size"] <= 2000000) {
                if (in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
                        return $hashedFileName;
                    } else {
                        echo "Gagal meng-upload file.";
                    }
                } else {
                    echo "Hanya file JPG, JPEG, PNG, atau GIF yang diperbolehkan.";
                }
            } else {
                echo "Ukuran file terlalu besar.";
            }
        } else {
            echo "File bukan gambar.";
        }

        return false;
    }
}
