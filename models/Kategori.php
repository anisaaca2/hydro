<?php

class Kategori
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM kategori ORDER BY id ASC";
        $result = mysqli_query($this->conn, $query);

        $kategoriList = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $kategoriList[] = $row;
            }
        }

        return $kategoriList;
    }

    public function getNamaById($id) {
        // Gantilah $conn dengan $this->conn untuk menggunakan koneksi objek
        $query = "SELECT nama FROM kategori WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($this->conn, $query);
    
        if ($stmt === false) {
            return 'Error: Gagal menyiapkan query';
        }
    
        // Bind parameter
        mysqli_stmt_bind_param($stmt, 'i', $id);
    
        // Eksekusi statement
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    
        return $row ? $row['nama'] : 'Kategori Tidak Ditemukan';
    }
    

    public function delete($id) {
        $query = "DELETE FROM kategori WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);

        if ($stmt === false) {
            return false; // Gagal menyiapkan query
        }

        // Bind parameter
        mysqli_stmt_bind_param($stmt, 'i', $id);

        // Eksekusi statement
        $result = mysqli_stmt_execute($stmt);

        // Tutup statement setelah eksekusi
        mysqli_stmt_close($stmt);

        return $result;
    }
}
