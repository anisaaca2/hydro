<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-white text-2xl font-bold">
                <a href="index.php">Hydro</a>
            </div>
            
            <div class="hidden md:flex space-x-6">
                <!-- Menu untuk Desktop -->
                <a href="index.php" class="text-white hover:text-blue-300">Home</a>
                <a href="index.php?action=create" class="text-white hover:text-blue-300">Tambah Produk</a>
                <a href="index.php?action=login" class="text-white hover:text-blue-300">Login</a>
                <a href="index.php?action=register" class="text-white hover:text-blue-300">Register</a>
            </div>

            <!-- Tombol Hamburger untuk Mobile -->
            <div class="md:hidden flex items-center">
                <button id="hamburger" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu Dropdown untuk Mobile -->
        <div id="menu" class="md:hidden hidden bg-blue-600 text-white">
            <a href="index.php" class="block px-4 py-2">Home</a>
            <a href="index.php?action=create" class="block px-4 py-2">Tambah Produk</a>
            <a href="index.php?action=login" class="block px-4 py-2">Login</a>
            <a href="index.php?action=register" class="block px-4 py-2">Register</a>
        </div>
    </nav>

    <script>
        // Script untuk toggle menu mobile
        const hamburger = document.getElementById("hamburger");
        const menu = document.getElementById("menu");

        hamburger.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    </script>

</body>
</html>
