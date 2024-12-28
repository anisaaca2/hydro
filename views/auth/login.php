<?php
require_once '../config/database.php';
require_once '../controllers/AuthController.php';

$error = null;

// Proses login jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController($db);
    $data = [
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? ''
    ];

    $error = $auth->login($data);
    if ($error === true) {
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-md mx-auto bg-white p-6 mt-10 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center">Login</h2>

        <?php if ($error && is_string($error)) : ?>
            <div class="bg-red-500 text-white p-2 mt-4 rounded text-center">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="mt-4">
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded mt-4 hover:bg-blue-500">Login</button>
        </form>

        <div class="mt-4 text-center">
            <p>Belum punya akun? <a href="router.php?action=register" class="text-blue-600">Daftar disini</a></p>
        </div>
    </div>
</body>
</html>
