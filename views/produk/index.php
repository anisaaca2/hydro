<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="mt-10 mx-auto max-w-7xl">
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-6">Daftar Produk</h1>

        <div class="flex justify-between items-center mb-6">
            <a href="../views/produk/create.php" class="bg-sky-500 px-6 py-3 rounded-lg text-white font-semibold hover:bg-sky-600">
                Tambah Produk
            </a>
            <form method="GET" action="search.php" class="flex">
                <input type="text" name="keyword" placeholder="Cari produk..." class="border border-gray-300 px-4 py-2 rounded-l-lg focus:ring focus:ring-green-300">
                <button type="submit" class="bg-green-500 px-4 py-2 rounded-r-lg text-white hover:bg-green-600">Cari</button>
            </form>
        </div>

        <!-- Produk Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-green-500 text-white text-center">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Stok</th>
                        <th class="px-4 py-2">Gambar</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $produk->fetch_assoc()): ?>
                        <tr class="text-center border-b border-gray-200">
                            <td class="px-4 py-2"><?= $row['id'] ?></td>
                            <td class="px-4 py-2"><?= $row['nama'] ?></td>
                            <td class="px-4 py-2"><?= $row['deskripsi'] ?></td>
                            <td class="px-4 py-2">Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td class="px-4 py-2"><?= $row['stok'] ?></td>
                            <td class="px-4 py-2">
                                <img src="../uploads/<?= $row['foto'] ?>" alt="Gambar Produk" class="h-20 w-20 object-cover mx-auto rounded-lg">
                            </td>
                            <td class="px-4 py-2">
                                <a href="edit.php?id=<?= $row['id'] ?>" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Edit</a>
                                <a href="delete.php?id=<?= $row['id'] ?>" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>