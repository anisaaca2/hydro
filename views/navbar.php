<?php
$isLoggedIn = isset($_SESSION['id']); // Mengecek apakah user login
$userName = $isLoggedIn ? $_SESSION['username'] : ''; // Ambil nama user
$userRole = $isLoggedIn ? ($_SESSION['role'] ?? 'pembeli') : ''; 
$profileLink = $userRole === 'penjual' ? '../views/profile/penjual.php' : '../views/profile/pembeli.php';
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

            <div class="hidden md:flex space-x-6 items-center">
                <?php if ($isLoggedIn): ?>
                    <div class="relative">
                        <button id="userDropdown" class="flex items-center space-x-2 text-white hover:text-blue-300 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a4 4 0 100 8 4 4 0 000-8zm-7 10a7 7 0 0114 0v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-1z" clip-rule="evenodd" />
                            </svg>
                            <span><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </button>

                        <div id="dropdownMenu" class="hidden absolute right-0 bg-white shadow-md rounded mt-2 py-2 w-48">
                            <a href="<?php echo htmlspecialchars($profileLink, ENT_QUOTES, 'UTF-8'); ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profil</a>
                            <a href="../public/router.php?action=logout" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                    <?php else: ?>
                        <a href="router.php?action=login" class="text-white hover:text-blue-300">Login</a>
                        <a href="router.php?action=register" class="text-white hover:text-blue-300">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <script>
        // Dropdown toggle
        const userDropdown = document.getElementById("userDropdown");
        const dropdownMenu = document.getElementById("dropdownMenu");

        if (userDropdown) {
            userDropdown.addEventListener("click", () => {
                dropdownMenu.classList.toggle("hidden");
            });

            // Menutup dropdown jika klik di luar
            window.addEventListener("click", (e) => {
                if (!userDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        }
    </script>
</body>
</html>
