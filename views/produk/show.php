<?php
require_once '../../config/database.php';
require_once '../../models/Produk.php';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    die("ID produk tidak valid atau tidak ditemukan.");
}

$produkModel = new Produk($db);
$produk = $produkModel->getById($id);

if (!$produk) {
    die("Produk dengan ID $id tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - <?= htmlspecialchars($produk['nama'] ?? 'Produk Tidak Ditemukan'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <?php if (!empty($produk)): ?>
            <h2 class="text-2xl font-bold mb-6"><?= htmlspecialchars($produk['nama']); ?></h2>

            <img src="../../uploads/<?= htmlspecialchars($produk['foto'] ?? 'default.jpg'); ?>" 
                alt="<?= htmlspecialchars($produk['nama']); ?>" 
                class="w-full h-64 object-cover mb-4">

            <p class="text-gray-700 mb-4"><?= nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>

            <p class="font-semibold">Harga: Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></p>

            <p>Stok: <?= htmlspecialchars($produk['stok']); ?></p>

            <p>Kategori: <?= htmlspecialchars($kategori['nama'] ?? 'Tidak diketahui'); ?></p> <!-- Menampilkan kategori produk -->

            <p>Dibuat pada: <?= date("d-m-Y H:i", strtotime($produk['created_at'])); ?></p>
        <?php else: ?>
            <p class="text-red-500">Produk tidak ditemukan.</p>
        <?php endif; ?>

        <div class="mt-6">
            <a href="../../public/router.php" class="text-blue-600 underline">Kembali ke Daftar Produk</a>
        </div>
    </div>
</body>
</html>
