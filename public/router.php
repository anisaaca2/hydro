<title>Hydro</title>
<?php include '../views/navbar.php'; ?>

<?php
require_once '../config/database.php';
require_once '../controllers/ProdukController.php';
require_once '../controllers/AuthController.php';

// session_start();

$action = isset($_GET['action']) ? $_GET['action'] : 'landing';

// Inisialisasi controller dengan database
$controller = new ProdukController($db);
$controller2 = new AuthController($db);

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
    
    case 'logout':
        $controller2->logout();
        break;

    case 'produk_create':
        // Pastikan hanya penjual yang bisa mengakses halaman ini
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'penjual') {
            header('Location: login.php');
            exit;
        }
        require_once '../views/produk/create.php';
        break;

    case 'produk_store':
        // Memanggil fungsi store untuk menambah produk baru
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller->store();
        } else {
            header('Location: ../public/router.php');
        }
        break;

    case 'edit':
        // Edit produk berdasarkan ID
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->edit($id);
        } else {
            header('Location: ../public/router.php');
        }
        break;

    case 'update':
        // Update produk berdasarkan ID
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->update($id);
        } else {
            header('Location: ../public/router.php');
        }
        break;

    case 'delete':
        // Menghapus produk berdasarkan ID
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->destroy($id);
        } else {
            header('Location: ../public/router.php');
        }
        break;

    case 'search':
        // Mencari produk berdasarkan keyword
        $controller->search();
        break;

    default:
        // Menampilkan daftar produk
        $controller->index();
        break;
}
?>
