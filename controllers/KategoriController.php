<?php
class KategoriController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        $query = "SELECT * FROM kategori";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function store($data)
    {
        $nama = $this->db->real_escape_string($data['nama']);
        $deskripsi = $this->db->real_escape_string($data['deskripsi']);

        $query = "INSERT INTO kategori (nama, deskripsi) VALUES ('$nama', '$deskripsi')";
        return $this->db->query($query);
    }
}
