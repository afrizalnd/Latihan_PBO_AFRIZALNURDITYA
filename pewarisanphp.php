<?php
// Pastikan file abstract class Tiket sudah disertakan jika file ini terpisah
// require_once 'Tiket.php';

// 1. CLASS TIKET REGULAR
class TiketRegular extends Tiket {
    // Properti tambahan spesifik TiketRegular
    private $tipeAudio;
    private $lokasiBaris;

    // Constructor
    public function __construct($data) {
        // Memanggil constructor dari abstract class induk (Tiket)
        parent::__construct($data);
        
        // Memetakan properti spesifik dari kolom database
        $this->tipeAudio   = $data['tipe_audio'] ?? 'Standard Audio';
        $this->lokasiBaris = $data['lokasi_baris'] ?? '-';
    }

    // Mengimplementasikan metode hitungTotalHarga
    public function hitungTotalHarga() {
        // Misal: Regular tidak ada biaya tambahan studio, murni harga dasar x jumlah kursi
        return $this->hargaDasarTiket * $this->jumlah_kursi;
    }

    // Mengimplementasikan metode tampilkanInfoFasilitas
    public function tampilkanInfoFasilitas() {
        return "Studio: Regular | Audio: " . $this->tipeAudio . " | Posisi Kursi: " . $this->lokasiBaris;
    }
}

// 2. CLASS TIKET IMAX
class TiketIMAX extends Tiket {
    // Properti tambahan spesifik TiketIMAX
    private $kacamata3dId;
    private $efekGerakFitur;

    // Constructor
    public function __construct($data) {
        parent::__construct($data);
        
        $this->kacamata3dId   = $data['kacamata_3d_id'] ?? 'Tidak Tersedia';
        $this->efekGerakFitur = $data['efek_gerak_fitur'] ?? 'Standard No-Motion';
    }

    // Mengimplementasikan metode hitungTotalHarga
    public function hitungTotalHarga() {
        // Misal: IMAX ada surcharge/biaya tambahan sebesar Rp 15.000 per kursi
        $biayaTambahanIMAX = 15000;
        return ($this->hargaDasarTiket + $biayaTambahanIMAX) * $this->jumlah_kursi;
    }

    // Mengimplementasikan metode tampilkanInfoFasilitas
    public function tampilkanInfoFasilitas() {
        return "Studio: IMAX 3D & 4DX | ID Kacamata 3D: " . $this->kacamata3dId . " | Fitur Gerak: " . $this->efekGerakFitur;
    }
}


// 3. CLASS TIKET VELVET
class TiketVelvet extends Tiket {
    // Properti tambahan spesifik TiketVelvet
    private $bantalSelimutPack;
    private $layananButler;

    // Constructor
    public function __construct($data) {
        parent::__construct($data);
        
        $this->bantalSelimutPack = $data['bantal_selimut_pack'] ?? 'Standard Pack';
        $this->layananButler     = $data['layanan_butler'] ?? 'Tidak Aktif';
    }

    // Mengimplementasikan metode hitungTotalHarga
    public function hitungTotalHarga() {
        // Misal: Velvet adalah kelas Suite VIP, ada biaya tambahan Rp 50.000 per paket/kursi
        $biayaTambahanVelvet = 50000;
        return ($this->hargaDasarTiket + $biayaTambahanVelvet) * $this->jumlah_kursi;
    }

    // Mengimplementasikan metode tampilkanInfoFasilitas
    public function tampilkanInfoFasilitas() {
        return "Studio: Velvet VIP | Paket Kenyamanan: " . $this->bantalSelimutPack . " | Layanan Butler: " . $this->layananButler;
    }
}