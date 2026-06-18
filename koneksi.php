<?php
class Koneksi {
    // Atribut untuk konfigurasi database bioskop/latihan PBO
    private $host = "localhost";
    private $username = "root";
    private $password = ""; // Isi password jika MySQL kamu menggunakannya
    private $database = "db_latihan_pbo_ti_1d_afrizalnurditya";
    public $db;

    // Constructor otomatis berjalan saat objek dibuat
    public function __construct() {
        // Membuat koneksi ke MySQL menggunakan ekstensi mysqli
        $this->db = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Memeriksa status koneksi
        if ($this->db->connect_error) {
            die("Koneksi ke database gagal: " . $this->db->connect_error);
        } else {
            // Menampilkan pesan sukses jika berhasil terkoneksi
            echo "Koneksi berhasil! Anda telah terhubung ke database '" . $this->database . "'.<br>";
        }
    }
}

// Instansiasi objek untuk menguji hubungan dengan database
$koneksiBioskop = new Koneksi();
?>