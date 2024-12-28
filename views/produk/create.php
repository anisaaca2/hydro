<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'penjual') {
    echo "Anda tidak memiliki izin untuk menambah produk.";
    exit;
}
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
        <h2 class="text-2xl font-bold mb-6">Tambah Produk</h2>
        <form action="/hydro/public/router.php?action=produk_store" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
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
            <div class="mb-4">
                <label for="foto" class="block font-medium text-gray-700">Foto Produk</label>
                <input type="file" name="foto" id="foto" required accept="image/png, image/jpeg" class="w-full px-4 py-2 border rounded-md">
            </div>
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Simpan Produk</button>
            <?php if (isset($message)): ?>
                <p class="mt-4 text-red-500"><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
