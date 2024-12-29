<?php
session_start();

$isLoggedIn = isset($_SESSION['id']); 
$userName = $isLoggedIn ? $_SESSION['username'] : ''; 
$userRole = $isLoggedIn ? $_SESSION['role'] : ''; 
$id = $_SESSION['id'] ?? null; 

if ($id === null) {
    die("ID pengguna tidak ditemukan.");
}


include '../config/database.php'; 

// Mengambil data pengguna dari database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Pengguna tidak ditemukan.");
}

// Proses penyimpanan perubahan profil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['username'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon']; 
    $alamat = $_POST['alamat'];
    $gender = $_POST['gender'];

    $updateStmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, nohp = :telepon, alamat = :alamat, jenis_kelamin = :gender WHERE id = :id");
    $updateStmt->execute([
        'username' => $nama,
        'email' => $email,
        'telepon' => $telepon,
        'alamat' => $alamat,
        'gender' => $gender,
        'id' => $id
    ]);

    header("Location: profil.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9f5e9; 
        }
        .navbar {
            background-color: #4caf50; 
        }
    </style>
</head>
<body>

<?php include '../navbar.php';  ?>

<div class="container mx-auto mt-6 p-4 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold">Profil Pengguna</h2>
    <form method="POST" action="">
        <div class="profile-header flex items-center mb-4">
            <img src="path/to/profile-photo.jpg" alt="Foto Profil" class="rounded-full w-24 h-24 border-2 border-gray-300 mr-4">
            <div>
                <label class="block">
                    <span class="text-gray-700">Nama:</span>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" class="mt-1 block w-full border rounded p-2" required>
                </label>
                <label class="block">
                    <span class="text-gray-700">Email:</span>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="mt-1 block w-full border rounded p-2" required>
                </label>
                <label class="block">
                    <span class="text-gray-700">Nomor Telepon:</span>
                    <input type="text" name="telepon" value="<?php echo htmlspecialchars($user['nohp']); ?>" class="mt-1 block w-full border rounded p-2" required>
                </label>
                <label class="block">
                    <span class="text-gray-700">Alamat:</span>
                    <input type="text" name="alamat" value="<?php echo htmlspecialchars($user['alamat']); ?>" class="mt-1 block w-full border rounded p-2" required>
                </label>
                <label class="block">
                    <span class="text-gray-700">Jenis Kelamin:</span>
                    <select class="border rounded p-2" name="gender" id="gender">
                    <option value="laki-laki" <?php echo ($user['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="perempuan" <?php echo ($user['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        <option value="lainnya" <?php echo ($user['jenis_kelamin'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="profile-info">
            <h3 class="text-xl font-semibold border-b-2 border-green-500 pb-2">Informasi Profil</h3>
            <p><strong>Tanggal Lahir:</strong> <?php echo htmlspecialchars($user['tanggal_lahir']); ?></p> 
        </div>

        <button type="submit" class="mt-4 inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-300">
            Simpan Perubahan
        </button>
    </form>
</div>

</body>
</html>