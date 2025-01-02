

<?php
session_start();

require_once '../config/database.php';
require_once '../models/Produk.php';
require_once '../controllers/ProdukController.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/KategoriController.php';

require '../views/navbar.php';


$action = isset($_GET['action']) ? $_GET['action'] : 'landing';

$controller = new ProdukController($db);
$controller2 = new AuthController($db);
$controller3 = new KategoriController($db);


switch ($action) {
    case 'landing':
        require_once '../views/landing.php';
        break;

    case 'login':
        require_once '../views/auth/login.php';
        break;

    case 'register':
        require_once '../views/auth/register.php';
        break;

    case 'profile_edit':
        $id = $_SESSION['id'] ?? null;
        if ($id) {
            $user = $controller2->editUser($id);
            require_once '../views/profile/edit.php';
        } else {
            header('Location: login.php');
        }
        break;

    case 'profile_update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller2->updateUser($_POST);
        } else {
            header('Location: ../public/router.php');
        }
        break;
        
    case 'logout':
        $controller2->logout();
        break;

        case 'produk_create':
            // Hanya penjual yang dapat membuat produk
            if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'penjual') {
                header('Location: login.php');
                exit;
            }
            require_once '../views/produk/create.php';
            break;
        
        case 'produk_store':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store(); // Memanggil fungsi store pada ProdukController
            } else {
                header('Location: ../public/router.php');
                exit;
            }
            break;
        
        case 'edit':
            $id = isset($_GET['id']) ? intval($_GET['id']) : null; // Pastikan ID valid
            if ($id) {
                $produk = $controller->edit($id); // Mendapatkan data produk
                if ($produk) {
                    require_once '../views/produk/edit.php';
                } else {
                    die("Produk tidak ditemukan.");
                }
            }// else {
                // header('Location: ../public/router.php');
                // exit;
            //}
            break;
        
        case 'update':
            $id = isset($_GET['id']) ? intval($_GET['id']) : null; // Validasi ID
            if ($id && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->update($id); // Update produk
            } else {
                header('Location: ../public/router.php');
                exit;
            }
            break;
        
        case 'delete':
            $id = isset($_GET['id']) ? intval($_GET['id']) : null; // Validasi ID
            if ($id) {
                $controller->destroy($id); // Hapus produk
            } else {
                header('Location: ../views/produk/index.php');
                exit;
            }
            break;
        
        case 'search':
            if (isset($_GET['keyword'])) {
                $controller->search(); // Memanggil fungsi pencarian
            } else {
                header("Location: ../public/router.php");
                exit;
            }
            break;
        
        case 'show_produk':
            $id = isset($_GET['id']) ? intval($_GET['id']) : null;
            if ($id) {
                $controller->show_produk($id);
            } else {
                die("ID produk tidak valid.");
            }
            break;

        case 'kategori':
            $kategori = $controller3->index();
            require_once '../views/kategori/kateindex.php';
            break;

            case 'kategori_create':
                // Menampilkan form tambah kategori
                require_once '../views/kategori/katecreate.php';
                break;
            
            case 'kategori_store':
                // Menyimpan data kategori baru
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller3->store($_POST);
                    header('Location: ../views/kategori/kateindex.php');
                    exit;
                }
                break;
            
            // case 'kategori_edit':
            //     // Menampilkan form edit kategori
            //     $id = isset($_GET['id']) ? intval($_GET['id']) : null;
            //     if ($id) {
            //         $kategori = $controller3->edit($id); // Tambahkan metode edit pada KategoriController
            //         require_once '../views/kategori/edit.php';
            //     } else {
            //         header('Location: router.php?action=kategori');
            //     }
            //     break;
            
            // case 'kategori_update':
            //     // Memperbarui data kategori
            //     $id = isset($_GET['id']) ? intval($_GET['id']) : null;
            //     if ($id && $_SERVER['REQUEST_METHOD'] === 'POST') {
            //         $controller3->update($id, $_POST); // Tambahkan metode update pada KategoriController
            //         header('Location: router.php?action=kategori');
            //         exit;
            //     }
            //     break;
            
            // case 'kategori_delete':
            //     // Menghapus data kategori
            //     $id = isset($_GET['id']) ? intval($_GET['id']) : null;
            //     if ($id) {
            //         $controller3->delete($id); // Tambahkan metode destroy pada KategoriController
            //         header('Location: router.php?action=kategori');
            //         exit;
            //     }
            //     break;
            
            
    default:
        $controller->index();
        break;
}

?>



<title>Hydro</title>