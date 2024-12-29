<title>Hydro</title>
<?php include '../views/navbar.php'; ?>

<?php
require_once '../config/database.php';
require_once '../controllers/ProdukController.php';
require_once '../controllers/AuthController.php';

// session_start();

$action = isset($_GET['action']) ? $_GET['action'] : 'landing';

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
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'penjual') {
            header('Location: login.php');
            exit;
        }
        require_once '../views/produk/create.php';
        break;

    case 'produk_store':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller->store();
        } else {
            header('Location: ../public/router.php');
        }
        break;

    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $produk = $controller->edit($id);
            require_once "../views/produk/edit.php";
        } else {
            header('Location: ../public/router.php');
        }
        break;

    case 'update':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->update($id);
        } else {
            header('Location: ../public/router.php');
        }
        break;

    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->destroy($id);
        } else {
            header('Location: ../public/router.php');
        }
        break;

    case 'search':
        $controller->search();
        break;

    // Dalam router.php
    case 'show':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->show($id); // Menyampaikan ID produk ke controller
        } else {
            header('Location: ../public/router.php');
        }
        break;


    default:
        $controller->index();
        break;
}
?>
