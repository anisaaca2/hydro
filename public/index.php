<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
        theme: {
            extend: {
            colors: {
                clifford: '#da373d',
                hydrogreen: '#268C43',
            }
            }
        }
        }
    </script>
</head>

<?php include '../views/navbar.blade.php'; ?>

<?php
require_once '../controllers/ProdukController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controller = new ProdukController();

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $id = $_GET['id'];
        $controller->edit($id);
        break;
    case 'delete':
        $id = $_GET['id'];
        $controller->delete($id);
        break;
    case 'search':
        $controller->search();
        break;
    default:
        $controller->index();
}
?>
