<h1>Edit Produk</h1>
<form method="POST">
    <input type="text" name="nama" value="<?= $produk['nama'] ?>" placeholder="Nama Produk">
    <input type="text" name="kategori" value="<?= $produk['kategori'] ?>" placeholder="Kategori">
    <input type="number" name="harga" value="<?= $produk['harga'] ?>" placeholder="Harga">
    <input type="number" name="stok" value="<?= $produk['stok'] ?>" placeholder="Stok">
    <button type="submit">Update</button>
</form>
