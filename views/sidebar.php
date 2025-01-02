<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-800 text-white p-4">
            <h2 class="text-xl font-bold mb-6">Menu</h2>
            <ul class="space-y-4">
                <li><a href="../kategori/kateindex.php" class="block px-4 py-2 rounded hover:bg-slate-700">Daftar Kategori</a></li>
                <li><a href="../produk/index.php" class="block px-4 py-2 rounded hover:bg-slate-700">Daftar Produk</a></li>
                <li><a href="../../public/router.php" class="block px-4 py-2 rounded hover:bg-slate-700">Halaman Utama</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-100">
            <!-- Content will be injected here -->
        </div>
    </div>
</body>
</html>
