<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto p-8 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold text-blue-600 mb-6">Tambah Kategori</h1>
        
        <form action="../../public/router.php?action=kategori_store" method="POST">
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" id="nama" name="nama" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" required 
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan</button>
            </div>
        </form>
    </div>

</body>
</html>
