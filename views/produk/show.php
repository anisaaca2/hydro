<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container flex justify-end mx-auto mt-10 space-x-4">
        <button class="bg-gray-500 px-4 py-2 text-white rounded-lg hover:bg-gray-600 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            <a href="../public/router.php" class="text-white">Kembali</a>
        </button>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-center">
                <?php if (!empty($produk['foto'])): ?>
                    <img src="../uploads/<?= htmlspecialchars($produk['foto']) ?>" alt="Foto Produk" class="w-full h-full object-cover max-w-md rounded-lg shadow-lg">
                <?php endif; ?>
            </div>

            <div class="space-y-6">
                <h1 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($produk['nama']) ?></h1>

                <div class="flex items-center space-x-4">
                    <p class="text-2xl font-semibold text-green-600">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></p>
                    <span class="text-sm text-gray-500">Tersisa <?= htmlspecialchars($produk['stok']) ?> item</span>
                </div>

                <div class="space-y-2">
                    <p class="text-lg text-gray-700"><strong class="text-gray-600">Kategori: </strong><?= htmlspecialchars($kategori['nama'] ?? 'Tidak diketahui') ?></p>
                </div>

                <div class="flex justify-start mt-4">
                    <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600">Pesan Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Deskripsi Produk -->
        <div class="mt-6 p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Tentang Produk</h2>
            <p class="text-lg text-gray-600"><?= htmlspecialchars($produk['deskripsi']) ?></p>
        </div>
    </div>

</body>
</html>
