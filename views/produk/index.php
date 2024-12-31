<?php

require_once '../../config/database.php';
require_once '../../models/Produk.php';

if (!isset($db)) {
    die("Koneksi database tidak ditemukan.");
}

$produkModel = new Produk($db);
$produkList = $produkModel->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold text-blue-600 mb-6 text-center">Daftar Produk</h2>

        <?php if (!empty($produkList)): ?>
            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="min-w-full border-collapse bg-white rounded-lg">
                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th class="border px-6 py-3 text-left font-semibold">No.</th>
                            <th class="border px-6 py-3 text-left font-semibold">Nama Produk</th>
                            <th class="border px-6 py-3 text-left font-semibold">Harga</th>
                            <th class="border px-6 py-3 text-left font-semibold">Stok</th>
                            <th class="border px-6 py-3 text-left font-semibold">Foto</th>
                            <th class="border px-6 py-3 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produkList as $produk): ?>
                            <tr class="hover:bg-gray-100 transition duration-300">
                                <td class="border px-6 py-4"><?= htmlspecialchars($produk['id']); ?></td>
                                <td class="border px-6 py-4"><?= htmlspecialchars($produk['nama']); ?></td>
                                <td class="border px-6 py-4 text-blue-600 font-bold">Rp<?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                                <td class="border px-6 py-4"><?= $produk['stok']; ?></td>
                                <td class="border px-6 py-4">
                                    <img src="../../uploads/<?= htmlspecialchars($produk['foto']); ?>" 
                                         alt="Foto Produk" 
                                         class="w-24 h-24 object-cover rounded-lg border border-gray-300">
                                </td>
                                <td class="border px-6 py-4">
                                    <button><a href="../produk/edit.php">Edit</a></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-500 text-center mt-10">Belum ada produk yang tersedia.</p>
        <?php endif; ?>
    </div>
</body>
</html>
