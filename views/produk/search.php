<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Hasil Pencarian untuk <span class="text-blue-600">"<?= htmlspecialchars($keyword); ?>"</span></h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            <?php if (!empty($produk)): ?>
                <?php foreach ($produk as $item): ?>
                    <div class="bg-white shadow-sm border transition hover:border-green-500 rounded-lg overflow-hidden">
                        <img src="../uploads/<?php echo htmlspecialchars($item['foto']); ?>" alt="<?php echo htmlspecialchars($item['nama']); ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($item['nama']); ?></h2>
                            <p class="text-blue-600 font-bold mt-4">Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
                            <a href="../views/produk/show.php">
                                <button class="bg-blue-600 text-white px-4 py-2 mt-4 rounded hover:bg-blue-700">
                                    Detail
                                </button>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500 text-center">Tidak ada produk yang sesuai.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
