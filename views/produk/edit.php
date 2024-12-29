<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h2 class="text-2xl font-bold mb-6">Edit Produk</h2>
        <?php if (isset($produk)): ?>
            <form action="../public/router.php?action=update&id=<?= htmlspecialchars($produk['id']); ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
                <div class="mb-4">
                    <label for="nama" class="block font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($produk['nama']); ?>" id="nama" required class="w-full px-4 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" required class="w-full px-4 py-2 border rounded-md"><?= htmlspecialchars($produk['deskripsi']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="harga" class="block font-medium text-gray-700">Harga</label>
                    <input type="number" name="harga" value="<?= htmlspecialchars($produk['harga']); ?>" id="harga" required min="0" step="0.01" class="w-full px-4 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="stok" class="block font-medium text-gray-700">Stok</label>
                    <input type="number" name="stok" value="<?= htmlspecialchars($produk['stok']); ?>" id="stok" required min="0" class="w-full px-4 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="foto" class="block font-medium text-gray-700">Foto</label>
                    <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($produk['foto']); ?>">
                    <?php if ($produk['foto']): ?>
                        <div class="mt-2">
                            <img src="../uploads/<?= htmlspecialchars($produk['foto']); ?>" alt="Foto Produk" class="w-32 h-32 object-cover">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2 border rounded-md mt-2">
                </div>
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Update Produk</button>
            </form>
        <?php else: ?>
            <p>Produk tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>
