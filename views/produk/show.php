<?php

require_once '../../config/database.php';
require_once '../../models/Produk.php';

if (!isset($db)) {
    die("Koneksi database tidak ditemukan.");
}

$produkModel = new Produk($db);
$produk = $produkModel->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - <?= htmlspecialchars($produk['nama']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <?php if (isset($produk) && !empty($produk)): ?>
            <h2 class="text-2xl font-bold mb-6"><?= htmlspecialchars($produk['nama'] ?? 'Nama Produk Tidak Ditemukan'); ?></h2>

            <img src="../../uploads/<?= htmlspecialchars($produk['foto'] ?? 'default.jpg'); ?>" 
                alt="<?= htmlspecialchars($produk['nama'] ?? 'Produk'); ?>" 
                class="w-full h-64 object-cover mb-4">

            <p class="text-gray-700 mb-4"><?= htmlspecialchars($produk['deskripsi'] ?? 'Deskripsi tidak tersedia'); ?></p>

            <p>Rp <?= isset($produk['harga']) && !is_null($produk['harga']) ? number_format($produk['harga'], 0, ',', '.') : 'Harga tidak tersedia'; ?></p>

            <p>Stok: <?= isset($produk['stok']) && !is_null($produk['stok']) ? $produk['stok'] : 'Stok tidak tersedia'; ?></p>

            <!-- <p>Kategori: <?= isset($produk['kategori_id']) && !is_null($produk['kategori_id']) ? $produk['kategori_id'] : 'Kategori tidak tersedia'; ?></p> -->

            <p>Dibuat pada: <?= isset($produk['created_at']) && !is_null($produk['created_at']) ? $produk['created_at'] : 'Waktu pembuatan tidak tersedia'; ?></p>

            <!-- <p class="font-semibold">Rating Rata-rata: <?= isset($averageRating) ? number_format($averageRating, 1) . ' ⭐' : 'Belum ada rating'; ?></p> -->
        <?php else: ?>
            <p>Produk tidak ditemukan.</p>
        <?php endif; ?>


        <!-- <form method="POST" action="router.php?action=rate_product&id=<?= $produk['id']; ?>" class="mt-4">
            <label for="rating" class="block text-sm font-semibold text-gray-700">Berikan Rating</label>
            <select name="rating" id="rating" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded">Berikan Rating</button>
        </form> -->

        <div class="mt-6">
            <a href="../../public/router.php" class="text-blue-600">Kembali ke Daftar Produk</a>
        </div>
    </div>
</body>
</html>