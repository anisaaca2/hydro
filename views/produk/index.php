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
        <h2 class="text-2xl font-bold mb-6">Daftar Produk</h2>

        <?php if ($produk->num_rows > 0): ?>
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Nama Produk</th>
                        <th class="border border-gray-300 px-4 py-2">Harga</th>
                        <th class="border border-gray-300 px-4 py-2">Stok</th>
                        <th class="border border-gray-300 px-4 py-2">Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $produk->fetch_assoc()): ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['nama']); ?></td>
                            <td class="border border-gray-300 px-4 py-2">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $row['stok']; ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="../uploads/<?= htmlspecialchars($row['foto']); ?>" alt="Foto Produk" class="w-24 h-24 object-cover">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-500">Belum ada produk yang tersedia.</p>
        <?php endif; ?>
    </div>
</body>
</html>
