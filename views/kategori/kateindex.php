<?php
require_once '../../config/database.php';
require_once '../../models/Kategori.php';

$kategoriModel = new Kategori($db);

$kategoriList = $kategoriModel->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori - Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar di sebelah kiri -->
        <?php include '../../views/sidebar.php'; ?>

        <!-- Konten Utama di sebelah kanan -->
        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold text-blue-600 mt-10 mb-4">Daftar Kategori</h2>
            <a href="../kategori/katecreate.php" 
               class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mb-4">Tambah Kategori</a>

            <?php if (!empty($kategoriList)): ?>
                <table class="min-w-full border-collapse bg-white rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-green-500 text-white">
                            <th class="border px-6 py-3 text-left font-semibold">ID</th>
                            <th class="border px-6 py-3 text-left font-semibold">Nama</th>
                            <th class="border px-6 py-3 text-left font-semibold">Deskripsi</th>
                            <th class="border px-6 py-3 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategoriList as $kategori): ?>
                            <tr class="hover:bg-gray-100 transition duration-300">
                                <td class="border px-6 py-4"><?= htmlspecialchars($kategori['id']); ?></td>
                                <td class="border px-6 py-4"><?= htmlspecialchars($kategori['nama']); ?></td>
                                <td class="border px-6 py-4"><?= htmlspecialchars($kategori['deskripsi']); ?></td>
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
            <?php else: ?>
                <p class="text-gray-500 text-center mt-10">Belum ada kategori yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
