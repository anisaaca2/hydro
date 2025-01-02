<?php
require_once '../config/database.php';
require_once '../models/Produk.php';
require_once '../models/Kategori.php';

if (!isset($db)) {
    die("Koneksi database tidak ditemukan.");
}

$produkModel = new Produk($db);
$kategoriModel = new Kategori($db);

$produkList = $produkModel->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container justify-center items-center mx-auto mt-5">
        <div class="bg-white shadow-sm py-20 rounded-lg text-center"></div>
    </div>
    
    <main class="container mx-auto p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            <?php if (!empty($produkList)): ?>
                <?php foreach ($produkList as $produk): ?>
                    <div class="bg-white shadow-sm border transition hover:border-green-500 rounded-lg overflow-hidden">
                        <img src="../uploads/<?php echo htmlspecialchars($produk['foto']); ?>" alt="<?php echo htmlspecialchars($produk['nama']); ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($produk['nama']); ?></h2>
                            <p class="text-blue-600 font-bold mt-4">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                            <p class="text-sm text-gray-400">
                                <?php
                                    $namaKategori = $kategoriModel->getNamaById($produk['kategori_id']);
                                    echo htmlspecialchars($namaKategori);
                                ?>
                            </p>
                            
                            <a href="../public/router.php?action=show_produk&id=<?= $produk['id'] ?>">
                                <button class="bg-blue-600 text-white px-4 py-2 mt-4 rounded hover:bg-blue-700">
                                    Detail
                                </button>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500 text-center">Tidak ada produk yang tersedia.</p>
            <?php endif; ?>
        </div>
</main>

</body>
</html>
