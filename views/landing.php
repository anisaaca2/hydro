<?php
require_once '../config/database.php';
require_once '../models/Produk.php';

// Pastikan variabel $db sudah terdefinisi di database.php
if (!isset($db)) {
    die("Koneksi database tidak ditemukan.");
}

// Mengambil data produk menggunakan model Produk
$produkModel = new Produk($db);
$produkList = $produkModel->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <!-- Tambahkan CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-center text-2xl font-bold">Daftar Produk</h1>
    </header>
    
    <main class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($produkList)): ?>
                <?php foreach ($produkList as $produk): ?>
                    <!-- Card Produk -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="../uploads/<?php echo htmlspecialchars($produk['foto']); ?>" alt="<?php echo htmlspecialchars($produk['nama']); ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($produk['nama']); ?></h2>
                            <p class="text-gray-600 mt-2"><?php echo htmlspecialchars($produk['deskripsi']); ?></p>
                            <p class="text-blue-600 font-bold mt-4">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                            <button class="bg-blue-600 text-white px-4 py-2 mt-4 rounded hover:bg-blue-700">
                                Detail
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500 text-center">Tidak ada produk yang tersedia.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
