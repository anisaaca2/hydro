<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
        theme: {
            extend: {
            colors: {
                clifford: '#da373d',
                hydrogreen: '#268C43',
            }
            }
        }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

        <form method="POST" action="index.php?action=search" class="mb-6 flex justify-center">
            <input type="text" name="search" placeholder="Cari produk..." class="p-2 border w-1/2">
            <button type="submit" class="bg-blue-500 text-white p-2 transition hover:bg-blue-600">Cari</button>
        </form>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold">Nama</th>
                    <th class="py-3 px-4 text-left font-semibold">Deskripsi</th>
                    <th class="py-3 px-4 text-left font-semibold">Harga</th>
                    <th class="py-3 px-4 text-left font-semibold">Stok</th>
                    <th class="py-3 px-4 text-left font-semibold">Foto</th>
                    <th class="py-3 px-4 text-left font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $p) : ?>
                    <tr class="border-b last:border-none hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4 text-gray-700"><?php echo $p['nama']; ?></td>
                        <td class="py-3 px-4 text-gray-600 line-clamp-3"><?php echo $p['deskripsi']; ?></td>
                        <td class="py-3 px-4 text-gray-800"><?php echo 'Rp ' . number_format($p['harga'], 0, ',', '.'); ?></td>
                        <td class="py-3 px-4 text-gray-700"><?php echo $p['stok']; ?></td>
                        <td class="py-3 px-4">
                            <?php 
                            $imagePath = isset($p['foto']) && file_exists("../uploads/" . $p['foto']) 
                                ? "../uploads/" . htmlspecialchars($p['foto']) 
                                : "../uploads/default.png"; 
                            ?>
                            <img src="<?= $imagePath ?>" alt="Foto Produk" class="w-16 h-16 rounded-lg shadow-sm object-cover">
                        </td>
                        <td class="py-3 px-4 flex">
                            <a href="index.php?action=edit&id=<?php echo $p['id']; ?>" 
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all">Edit</a>
                            <a href="index.php?action=delete&id=<?php echo $p['id']; ?>" 
                            class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all ml-2">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <!-- Link untuk Menambah Produk -->
        <div class="mt-6">
            <a href="index.php?action=create" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Tambah Produk</a>
        </div>
    </div>
</body>
</html>
