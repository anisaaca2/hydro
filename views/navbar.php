<?php

session_start();

$isLoggedIn = isset($_SESSION['id']); // Mengecek apakah user sudah login
$userName = $isLoggedIn ? $_SESSION['username'] : ''; // Mengambil nama user jika login
$userRole = $isLoggedIn ? $_SESSION['role'] : ''; // Mengambil peran user jika login
$profileLink = $userRole === 'penjual' ? '../views/profile/penjual.php' : '../views/profile/pembeli.php'; // Mengarahkan ke halaman profil sesuai role
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-white text-2xl font-bold">
                <a href="index.php">Hydro</a>
            </div>

            <div class="flex-grow flex justify-center">
                <!-- Form Pencarian -->
                <form action="router.php?action=search" method="GET" class="flex items-center w-full max-w-md">
                    <input type="text" name="keyword" placeholder="Cari produk..." class="px-4 py-2 rounded-l-md border border-gray-300 w-full" required>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-400">Cari</button>
                </form>
            </div>




            <div class="hidden md:flex space-x-6 items-center">
                <?php if (!$isLoggedIn): ?>
                    <a href="router.php?action=login" class="text-white hover:text-blue-300">Login</a>
                    <a href="router.php?action=register" class="text-white hover:text-blue-300">Register</a>
                <?php else: ?>
                    <div class="relative">
                        <button id="userDropdown" class="flex items-center space-x-2 text-white hover:text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a4 4 0 100 8 4 4 0 000-8zm-7 10a7 7 0 0114 0v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-1z" clip-rule="evenodd" />
                            </svg>
                            <span><?php echo htmlspecialchars($userName); ?></span>
                        </button>

                        <div id="dropdownMenu" class="hidden absolute right-0 bg-white shadow-md rounded mt-2 py-2 w-48">
                            <a href="<?php echo $profileLink; ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profil</a>
                            <a href="router.php?action=logout" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div> 
    </nav>

    <script>
        const userDropdown = document.getElementById("userDropdown");
        const dropdownMenu = document.getElementById("dropdownMenu");

        if (userDropdown) {
            userDropdown.addEventListener("click", () => {
                dropdownMenu.classList.toggle("hidden");
            });
        }
    </script>
</body>
</html>
