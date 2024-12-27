<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Hydro</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Produk</h2>
        <form action="/public/index.php?action=produk_store" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Produk:</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" id="harga" required min="0" step="0.01">
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" name="stok" id="stok" required min="0">
            </div>
            <div class="form-group">
                <label for="foto">Foto Produk:</label>
                <input type="file" name="foto" id="foto" required accept="image/png, image/jpeg">
            </div>
            <button type="submit">Simpan Produk</button>
        </form>
    </div>
</body>
</html>
