<!-- KODE INI SEMENTARA DIBISUKAN -->

<title>Hydro</title>

<?php include '../views/navbar.php'; ?>

<?php

require_once '../controllers/ProdukController.php';
// require_once '../controllers/AuthController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controller = new ProdukController();

switch ($action) {
    case 'home':
        require_once '../views/home.php';
        break;
    case 'produk_create':
        require_once '../views/produk/create.php';
        break;
    case 'produk_store':
        require_once '../controllers/ProdukController.php';
        $produkController->store();
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->edit($id);
        } else {
            header('Location: ../public/router.php');
        }
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->delete($id);
        } else {
            header('Location: ../public/router.php');
        }
        break;
    case 'search':
        $controller->search();
        break;
    default:
        $controller->index();
        break;
}

?>

<?php
// if (isset($_GET['action'])) {
//     $action = $_GET['action'];

//     if ($action === 'store') {
//         require '../controllers/ProdukController.php';
//         $controller = new ProdukController();
//         $controller->store();
//     } else {
//         http_response_code(404);
//         echo "Rute tidak ditemukan.";
//     }
// } else {
//     echo "Selamat datang di halaman utama.";
// }
?>


<!-- // $authController = new AuthController();

// if (isset($_GET['action']) && $_GET['action'] === 'login') {
//     if ($_SESSION['role'] == 'penjual') {
//         header('Location: produk/index.php');
//         exit;
//     } elseif ($_SESSION['role'] == 'pembeli') {
//         header('Location: landing.php');
//         exit;
//     }
// } else {
//     include __DIR__ . '/../views/auth/login.php';
// }

?> -->
