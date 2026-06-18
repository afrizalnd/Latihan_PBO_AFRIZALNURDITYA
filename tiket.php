<?php

// Mendefinisikan abstract class Tiket
abstract class Tiket {
    // Properti terenkapsulasi (protected) sesuai kolom database di Tahap 1
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $hargaDasarTiket;

    // Constructor untuk memetakan data array asosiatif hasil query database
    public function __construct($data) {
        $this->id_tiket        = $data['id_tiket'] ?? null;
        $this->nama_film       = $data['nama_film'] ?? '';
        $this->jadwal_tayang   = $data['jadwal_tayang'] ?? '';
        $this->jumlah_kursi    = $data['jumlah_kursi'] ?? 0;
        // Memetakan dari kolom database 'harga_dasar_tiket' ke properti camelCase $hargaDasarTiket
        $this->hargaDasarTiket = $data['harga_dasar_tiket'] ?? 0.0;
    }

    // =========================================================================
    // METODE ABSTRAK (Wajib dideklarasikan tanpa isi/body)
    // =========================================================================
    
    // Wajib diimplementasikan oleh kelas anak untuk menghitung total harga tiket + surcharge studio
    abstract public function hitungTotalHarga();

    // Wajib diimplementasikan oleh kelas anak untuk menampilkan spesifikasi fasilitas studio
    abstract public function tampilkanInfoFasilitas();
}