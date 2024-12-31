<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../../config/database.php';
require_once '../../models/User.php';

$userId = $_SESSION['id'];
$userRole = $_SESSION['role'] ?? '';

if ($userRole !== 'pembeli') {
    die("Anda tidak memiliki akses ke halaman ini.");
}

$userModel = new User($db);
$user = $userModel->getUserById($userId);

if (!$user) {
    die("Data user tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="container flex justify-end mx-auto mt-10 space-x-4">
    <!-- Tombol Kembali -->
    <button class="bg-green-500 px-4 py-2 text-white rounded-lg hover:bg-green-600 flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
        </svg>
        <a href="../../public/router.php">Kembali</a>
    </button>
    <!-- Tombol Logout -->
    <button class="bg-red-500 px-4 py-2 text-white rounded-lg hover:bg-red-600 flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
        </svg>
        <a href="../../public/router.php?action=logout">Logout</a>
    </button>
</div>


    <div class="container mx-auto mt-6 p-4 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Informasi Pengguna</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <p class="text-green-500"><span class="font-bold text-gray-700">Role:</span> <?php echo htmlspecialchars($user['role']); ?></p>
            </div>
            <div>
                <p class="text-gray-700"><span class="font-bold">Username:</span> <?php echo htmlspecialchars($user['username']); ?></p>
            </div>
            <div>
                <p class="text-gray-700"><span class="font-bold">Email:</span> <?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <div>
                <p class="text-gray-700"><span class="font-bold">Alamat:</span> 
                    <?php echo htmlspecialchars($user['alamat'] ?? 'Belum diatur'); ?>
                </p>
            </div>
            <div>
                <p class="text-gray-700"><span class="font-bold">Nomor Telepon:</span> 
                    <?php echo htmlspecialchars($user['nohp'] ?? 'Belum diatur'); ?>
                </p>
            </div>
            <div>
                <p class="text-gray-700"><span class="font-bold">Bergabung Sejak:</span> <?php echo htmlspecialchars($user['created_at']); ?></p>
            </div>

        </div>
        </div>
    </div>

    <div class="container mx-auto mt-6 p-4 bg-white rounded-lg shadow-md mb-10">
        <h2 class="text-2xl font-bold pb-4">Profil Pengguna</h2>
        <form action="../../public/router.php?action=profile_update" method="POST" class="mx-auto bg-white p-6 rounded-lg shadow-md">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Username:</label>
                <input 
                    type="text" 
                    name="username" 
                    value="<?php echo htmlspecialchars($user['username']); ?>" 
                    required 
                    class="border pl-2 py-2 w-full rounded-md border-gray-300"
                >
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email:</label>
                <input 
                    type="email" 
                    name="email" 
                    value="<?php echo htmlspecialchars($user['email']); ?>" 
                    required 
                    class="border pl-2 py-2 w-full rounded-md border-gray-300"
                >
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Alamat:</label>
                <input 
                    type="text" 
                    name="alamat" 
                    value="<?php echo htmlspecialchars($user['alamat']); ?>" 
                    required 
                    class="border pl-2 py-2 w-full rounded-md border-gray-300"
                >
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                <input 
                    type="text" 
                    name="nohp" 
                    value="<?php echo htmlspecialchars($user['nohp']); ?>" 
                    required 
                    class="border pl-2 py-2 w-full rounded-md border-gray-300"
                >
            </div>

            <!-- <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password (Kosongkan jika tidak ingin mengganti):</label>
                <input 
                    type="password" 
                    name="password" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >
            </div> -->

            <div>
                <button 
                    type="submit" 
                    class="inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-600"
                >
                    Simpan
                </button>
            </div>
        </form>
</div>
</body>
</html>
