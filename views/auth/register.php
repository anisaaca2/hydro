<?php
// require_once '../../controllers/AuthController.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, email, nohp, alamat, password, role) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $nohp, $alamat, $hashedPassword, $role])) {
        $_SESSION['message'] = "Registrasi berhasil! Silakan login.";
        header("Location: ../public/router.php");
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-md mx-auto bg-white p-6 mt-10 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center">Register</h2>
        <form method="POST" action="" class="mt-4">
            <div class="mb-4">
                <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
                <input type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="nohp" class="block text-sm font-semibold text-gray-700">Nomor Telepon</label>
                <input type="nohp" name="nohp" id="nohp" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-semibold text-gray-700">Alamat</label>
                <input type="alamat" name="alamat" id="alamat" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-semibold text-gray-700">Role</label>
                <select name="role" id="role" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    <option value="penjual">Penjual</option>
                    <option value="pembeli">Pembeli</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded mt-4 hover:bg-blue-500">Register</button>
        </form>
        <div class="mt-4 text-center">
            <p>Already have an account? <a href="router.php?action=login" class="text-blue-600">Login here</a></p>
        </div>
    </div>
</body>
</html>
