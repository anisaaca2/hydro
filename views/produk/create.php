<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'penjual') {
    echo "Anda tidak memiliki izin untuk menambah produk.";
    exit;
}

require_once '../../config/database.php';
require_once '../../models/Kategori.php';

$kategoriModel = new Kategori($db);

$kategori = $kategoriModel->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold mb-6">Tambah Produk</h2>
            <div class="flex items-center mb-6">
                <p class="text-sm text-green-500"><a href="../produk/index.php">
                Seller Center
                </a></p>
                <span class="mx-2">/</span>
                <p>Tambah Produk</p>
            </div>
        </div>
        <form action="../../public/router.php?action=produk_store" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            <div class="mb-4">
                <label for="nama" class="block font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="nama" id="nama" required class="w-full px-4 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" required class="w-full px-4 py-2 border rounded-md"></textarea>
            </div>
            <div class="mb-4">
                <label for="harga" class="block font-medium text-gray-700">Harga</label>
                <input type="number" name="harga" id="harga" required min="0" step="0.01" class="w-full px-4 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label for="stok" class="block font-medium text-gray-700">Stok</label>
                <input type="number" name="stok" id="stok" required min="0" class="w-full px-4 py-2 border rounded-md">
            </div>
            <label for="kategori_id" class="block font-medium text-gray-700">Kategori</label>
            <div id="kategori_id" class="grid grid-cols-1 md:grid-cols-5 gap-2 px-4 py-2 mb-4 border border-gray-300 rounded-md">
                <?php foreach ($kategori as $item): ?>
                <div class="flex items-center">
                    <input type="radio" name="kategori_id" id="kategori_<?= $item['id'] ?>" value="<?= $item['id'] ?>" 
                        class="w-4 h-4 border-gray-300 rounded" required>
                    <label for="kategori_<?= $item['id'] ?>" class="ml-2 text-sm text-gray-700">
                        <?= htmlspecialchars($item['nama']) ?>
                    </label>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mb-4">
                <label for="foto" class="block font-medium text-gray-700">Foto Produk</label>
                <input type="file" name="foto" id="foto" required accept="image/png, image/jpeg" class="w-full px-4 py-2 border rounded-md">
            </div>

            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Simpan Produk</button>
            <button type="button" class="px-4 py-2 bg-slate-500 text-white rounded-md hover:bg-slate-600">
                <a href="../produk/index.php" class="text-white">Kembali</a>
            </button>

            <?php if (isset($message)): ?>
                <p class="mt-4 text-red-500"><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
