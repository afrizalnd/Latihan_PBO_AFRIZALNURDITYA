<?php
// 1. Sertakan file koneksi database
require_once 'koneksi.php';

// =========================================================================
// 2. DEFINISI ABSTRACT CLASS & SUBCLASS (Jika belum dipisah ke file lain)
// =========================================================================
abstract class Tiket {
    protected $id_tiket;
    public $nama_film; // Diubah ke public/getter agar bisa diakses oleh View
    public $jadwal_tayang;
    public $jumlah_kursi;
    public $hargaDasarTiket;
    public $jenis_studio;

    public function __construct($data) {
        $this->id_tiket        = $data['id_tiket'] ?? null;
        $this->nama_film       = $data['nama_film'] ?? '';
        $this->jadwal_tayang   = $data['jadwal_tayang'] ?? '';
        $this->jumlah_kursi    = $data['jumlah_kursi'] ?? 0;
        $this->hargaDasarTiket = $data['harga_dasar_tiket'] ?? 0.0;
        $this->jenis_studio    = $data['jenis_studio'] ?? '';
    }

    abstract public function hitungTotalHarga();
    abstract public function tampilkanInfoFasilitas();
}

class TiketRegular extends Tiket {
    private $tipeAudio;
    private $lokasiBaris;

    public function __construct($data) {
        parent::__construct($data);
        $this->tipeAudio   = $data['tipe_audio'] ?? 'Standard Audio';
        $this->lokasiBaris = $data['lokasi_baris'] ?? '-';
    }

    public function hitungTotalHarga() {
        return $this->jumlah_kursi * $this->hargaDasarTiket;
    }

    public function tampilkanInfoFasilitas() {
        return "<strong>Audio:</strong> " . $this->tipeAudio . " | <strong>Baris:</strong> " . $this->lokasiBaris;
    }
}

class TiketIMAX extends Tiket {
    private $kacamata3dId;
    private $efekGerakFitur;

    public function __construct($data) {
        parent::__construct($data);
        $this->kacamata3dId   = $data['kacamata_3d_id'] ?? 'Tidak Tersedia';
        $this->efekGerakFitur = $data['efek_gerak_fitur'] ?? 'Standard No-Motion';
    }

    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) + 35000;
    }

    public function tampilkanInfoFasilitas() {
        return "<strong>Kacamata 3D ID:</strong> " . $this->kacamata3dId . " | <strong>Efek Gerak:</strong> " . $this->efekGerakFitur;
    }
}

class TiketVelvet extends Tiket {
    private $bantalSelimutPack;
    private $layananButler;

    public function __construct($data) {
        parent::__construct($data);
        $this->bantalSelimutPack = $data['bantal_selimut_pack'] ?? 'Standard Pack';
        $this->layananButler     = $data['layanan_butler'] ?? 'Tidak Tersedia';
    }

    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
    }

    public function tampilkanInfoFasilitas() {
        return "<strong>Fasilitas Tidur:</strong> " . $this->bantalSelimutPack . " | <strong>Layanan Butler:</strong> " . $this->layananButler;
    }
}

// =========================================================================
// 3. PROSES AMBIL DATA & PEMBENTUKAN OBJEK (POLIMORFISME)
// =========================================================================
// Mengambil data menggunakan variabel properti koneksi ($koneksiBioskop->db)
$query = "SELECT * FROM tabel_tiket";
$result = $koneksiBioskop->db->query($query);

// Array penampung kelompok kategori studio
$kelompokTiket = [
    'Regular' => [],
    'IMAX'    => [],
    'Velvet'  => []
];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Proses Instansiasi Objek secara Dinamis sesuai jenis studio di database
        if ($row['jenis_studio'] === 'Regular') {
            $objekTiket = new TiketRegular($row);
        } elseif ($row['jenis_studio'] === 'IMAX') {
            $objekTiket = new TiketIMAX($row);
        } elseif ($row['jenis_studio'] === 'Velvet') {
            $objekTiket = new TiketVelvet($row);
        }
        
        // Memasukkan objek polimorfik ke kelompoknya masing-masing
        $kelompokTiket[$row['jenis_studio']][] = $objekTiket;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan Tiket Bioskop</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 30px; background-color: #f4f6f9; color: #333; }
        h1 { text-align: center; color: #2c3e50; margin-bottom: 30px; }
        .studio-section { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); margin-bottom: 40px; }
        .studio-title { font-size: 22px; font-weight: bold; padding-bottom: 10px; margin-bottom: 15px; border-bottom: 3px solid #34495e; color: #2c3e50; }
        .Regular .studio-title { border-color: #2ecc71; color: #27ae60; }
        .IMAX .studio-title { border-color: #3498db; color: #2980b9; }
        .Velvet .studio-title { border-color: #9b59b6; color: #8e44ad; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eceff1; font-size: 14px; }
        th { background-color: #34495e; color: white; text-transform: uppercase; letter-spacing: 0.5px; }
        tr:hover { background-color: #f8f9fa; }
        .badge { padding: 4px 8px; border-radius: 4px; color: white; font-size: 12px; font-weight: bold; }
        .badge-reg { background-color: #2ecc71; }
        .badge-imax { background-color: #3498db; }
        .badge-velvet { background-color: #9b59b6; }
        .text-right { text-align: right; }
        .empty { text-align: center; color: #7f8c8d; font-style: italic; padding: 20px; }
    </style>
</head>
<body>

    <h1>Daftar Pemesanan Tiket Bioskop</h1>

    <?php foreach ($kelompokTiket as $namaStudio => $daftarTiket): ?>
        <div class="studio-section <?= $namaStudio; ?>">
            <div class="studio-title">Kategori Studio: <?= $namaStudio; ?></div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Film</th>
                        <th>Jadwal Tayang</th>
                        <th>Jumlah Kursi</th>
                        <th>Harga Dasar</th>
                        <th>Spesifikasi Fasilitas Unik (Atribut Anak)</th>
                        <th class="text-right">Total Bayar (Polimorfik)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($daftarTiket)): ?>
                        <?php foreach ($daftarTiket as $tiket): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($tiket->nama_film); ?></strong></td>
                                <td><?= htmlspecialchars(date('d M Y - H:i', strtotime($tiket->jadwal_tayang))); ?> WIB</td>
                                <td><?= htmlspecialchars($tiket->jumlah_kursi); ?> Kursi</td>
                                <td>Rp <?= number_format($tiket->hargaDasarTiket, 0, ',', '.'); ?></td>
                                
                                <td><?= $tiket->tampilkanInfoFasilitas(); ?></td>
                                
                                <td class="text-right"><strong>Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="empty">Belum ada riwayat data pemesanan untuk tipe Studio <?= $namaStudio; ?>.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>

</body>
</html>