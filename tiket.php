<?php

// Mendefinisikan abstract class Tiket
abstract class Tiket {
    // Properti terenkapsulasi (protected) sesuai dengan kolom database
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $hargaDasarTiket;

    // Constructor untuk memetakan/mapping data langsung dari kolom database
    public function __construct($data) {
        $this->id_tiket        = $data['id_tiket'] ?? null;
        $this->nama_film       = $data['nama_film'] ?? '';
        $this->jadwal_tayang   = $data['jadwal_tayang'] ?? '';
        $this->jumlah_kursi    = $data['jumlah_kursi'] ?? 0;
        // Memetakan dari kolom 'harga_dasar_tiket' di database ke properti hargaDasarTiket
        $this->hargaDasarTiket = $data['harga_dasar_tiket'] ?? 0.0;
    }

    // =========================================================================
    // ABSTRACT METHODS (Wajib diimplementasikan oleh semua class anak)
    // =========================================================================
    
    // Metode abstrak untuk menghitung total harga (termasuk biaya tambahan studio)
    abstract public function hitungTotalHarga();

    // Metode abstrak untuk menampilkan info fasilitas spesifik masing-masing studio
    abstract public function tampilkanInfoFasilitas();
}