<?php
// Menyertakan file abstract class induk agar tidak error
require_once 'Tiket.php';

// =========================================================================
// 1. SUBCLASS: TIKET REGULAR (Overriding Tarif Standar Murni)
// =========================================================================
class TiketRegular extends Tiket {
    private $tipeAudio;
    private $lokasiBaris;

    public function __construct($data) {
        parent::__construct($data);
        $this->tipeAudio   = $data['tipe_audio'] ?? 'Standard Audio';
        $this->lokasiBaris = $data['lokasi_baris'] ?? '-';
    }

    /**
     * OVERRIDING METODE hitungTotalHarga()
     * Logika Bisnis: Total Harga = jumlah_kursi * hargaDasarTiket
     */
    public function hitungTotalHarga() {
        return $this->jumlah_kursi * $this->hargaDasarTiket;
    }

    public function tampilkanInfoFasilitas() {
        return "Studio: Regular | Audio: " . $this->tipeAudio . " | Baris: " . $this->lokasiBaris;
    }
}

// =========================================================================
// 2. SUBCLASS: TIKET IMAX (Overriding dengan Flat Surcharge Rp35.000)
// =========================================================================
class TiketIMAX extends Tiket {
    private $kacamata3dId;
    private $efekGerakFitur;

    public function __construct($data) {
        parent::__construct($data);
        $this->kacamata3dId   = $data['kacamata_3d_id'] ?? 'Tidak Tersedia';
        $this->efekGerakFitur = $data['efek_gerak_fitur'] ?? 'Standard No-Motion';
    }

    /**
     * OVERRIDING METODE hitungTotalHarga()
     * Logika Bisnis: Total Harga = (jumlah_kursi * hargaDasarTiket) + 35000
     */
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) + 35000;
    }

    public function tampilkanInfoFasilitas() {
        return "Studio: IMAX | ID Kacamata 3D: " . $this->kacamata3dId . " | Efek Gerak: " . $this->efekGerakFitur;
    }
}

// =========================================================================
// 3. SUBCLASS: TIKET VELVET (Overriding dengan Surcharge Premium 50%)
// =========================================================================
class TiketVelvet extends Tiket {
    private $bantalSelimutPack;
    private $layananButler;

    public function __construct($data) {
        parent::__construct($data);
        $this->bantalSelimutPack = $data['bantal_selimut_pack'] ?? 'Standard Pack';
        $this->layananButler     = $data['layanan_butler'] ?? 'Tidak Tersedia';
    }

    /**
     * OVERRIDING METODE hitungTotalHarga()
     * Logika Bisnis: Total Harga = (jumlah_kursi * hargaDasarTiket) * 1.50
     */
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
    }

    public function tampilkanInfoFasilitas() {
        return "Studio: Velvet | Fasilitas Tidur: " . $this->bantalSelimutPack . " | Layanan Butler: " . $this->layananButler;
    }
}