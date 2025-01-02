<?php
require_once '../../config/database.php';
require_once '../../models/Produk.php';
require_once '../../models/Kategori.php';

$produkModel = new Produk($db);
$kategoriModel = new Kategori($db);

// Tentukan jumlah produk per halaman dan halaman saat ini
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Ambil data produk dengan pagination
$produkList = $produkModel->getPagination($limit, $offset);
$totalProduk = $produkModel->getCount();

// Hitung total halaman
$totalPages = ceil($totalProduk / $limit);
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
    <div class="flex">

        <?php include '../sidebar.php'; ?>
        
        <div class="flex-1 p-10 bg-gray-100 -ml-10">
            <div class="flex justify-between mb-5">
                <h2 class="text-3xl font-bold text-green-600">Hydro Seller Center</h2>
                <div class="flex items-center mb-6">
                    <p class="text-sm text-green-500"><a href="../produk/index.php">
                        Seller Center
                    </a></p>
                    <span class="mx-2">/</span>
                    <p>Beranda</p>
                </div>
            </div>
            
            <button class="bg-green-500 px-4 py-2 mb-5 rounded-lg hover:bg-green-600">
                <a href="../produk/create.php" class="text-white">Tambahkan Produk</a>
            </button>
            <?php if (!empty($produkList)): ?>
                <div class="overflow-x-auto shadow-lg rounded-lg">
                    <table class="min-w-full border-collapse bg-white rounded-lg">
                        <thead>
                            <tr class="bg-green-500 text-white">
                                <th class="border px-6 py-3 text-left font-semibold">No.</th>
                                <th class="border px-6 py-3 text-left font-semibold">Nama Produk</th>
                                <th class="border px-6 py-3 text-left font-semibold">Harga</th>
                                <th class="border px-6 py-3 text-left font-semibold">Stok</th>
                                <th class="border px-6 py-3 text-left font-semibold">Kategori</th>
                                <th class="border px-6 py-3 text-left font-semibold">Foto</th>
                                <th class="border px-6 py-3 text-left font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produkList as $index => $produk): ?>
                                <tr class="hover:bg-gray-100 transition duration-300">
                                    <td class="border px-6 py-4"><?= ($index + 1) + (($page - 1) * $limit); ?></td>
                                    <td class="border px-6 py-4"><?= htmlspecialchars($produk['nama']); ?></td>
                                    <td class="border px-6 py-4 text-green-600 font-bold">Rp<?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                                    <td class="border px-6 py-4"><?= htmlspecialchars($produk['stok']); ?></td>
                                    <td class="border px-6 py-4">
                                        <?php
                                            $namaKategori = $kategoriModel->getNamaById($produk['kategori_id']);
                                            echo htmlspecialchars($namaKategori);
                                        ?>
                                    </td>
                                    <td class="border px-6 py-4">
                                        <img src="../../uploads/<?= htmlspecialchars($produk['foto'] ?? 'default.jpg'); ?>" 
                                             alt="Foto Produk" 
                                             class="w-32 h-18 object-cover rounded-lg border border-gray-300">
                                    </td>
                                    <td class="border px-6 py-4">
                                        <a href="../produk/edit.php?id=<?= $produk['id']; ?>" 
                                           class="text-white px-4 py-2 rounded-lg bg-green-500 hover:bg-green-600 mr-2">Edit</a>
                                        <a href="../../public/router.php?action=delete&id=<?= $produk['id']; ?>" 
                                           class="text-white px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4 flex justify-between">
    <!-- Previous Page -->
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1; ?>" class="text-green-500 hover:underline">Sebelumnya</a>
    <?php else: ?>
        <span class="text-gray-500">Sebelumnya</span>
    <?php endif; ?>

    <!-- Page Numbers -->
    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i; ?>" class="text-green-500 hover:underline <?= ($i == $page) ? 'font-bold' : ''; ?>"><?= $i; ?></a>
            <?php if ($i < $totalPages): ?>
                <span class="text-gray-500 mx-2">|</span>
            <?php endif; ?>
        <?php endfor; ?>
    </div>

    <!-- Next Page -->
    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1; ?>" class="text-green-500 hover:underline">Selanjutnya</a>
    <?php else: ?>
        <span class="text-gray-500">Selanjutnya</span>
    <?php endif; ?>
</div>



            <?php else: ?>
                <p class="text-gray-500 text-center mt-10">Belum ada produk yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
