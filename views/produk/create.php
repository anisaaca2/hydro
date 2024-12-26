<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

        <form action="index.php?action=create" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md" required></textarea>
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="harga" id="harga" class="mt-1 block w-full rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stok" id="stok" class="mt-1 block w-full rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                <input type="file" name="foto" id="foto" class="mt-1 block w-full text-sm text-gray-900 border rounded-md" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white p-2 rounded">Tambah Produk</button>
        </form>

        <div class="mt-4">
            <a href="index.php" class="text-blue-500 hover:underline">Kembali ke Daftar Produk</a>
        </div>
    </div>
</body>
</html>
