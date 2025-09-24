<?php
class Karyawan {
    public $nama;
    public $golongan;
    public $lembur;
    public $gajiPokok;

    // Constructor
    public function __construct($nama, $golongan, $lembur) {
        $this->nama = $nama;
        $this->golongan = $golongan;
        $this->lembur = $lembur;
        $this->gajiPokok = $this->getGajiPokok();
        echo "Construct : Data karyawan '$this->nama' dibuat.\n";
    }

    // Method gaji pokok
    public function getGajiPokok() {
        $gaji = [
            "Ib"=>1250000, "Ic"=>1300000, "Id"=>1350000,
            "IIa"=>2000000, "IIb"=>2100000, "IIc"=>2200000, "IId"=>2300000,
            "IIIa"=>2400000, "IIIb"=>2500000, "IIIc"=>2600000, "IIId"=>2700000,
            "IVa"=>2800000, "IVb"=>2900000, "IVc"=>3000000, "IVd"=>3100000
        ];
        return $gaji[$this->golongan] ?? 0;
    }

    // Hitung total gaji
    public function hitungGaji() {
        return $this->gajiPokok + ($this->lembur * 15000);
    }

    // Info karyawan
    public function getInfo() {
        return $this->nama." (Golongan: ".$this->golongan.", Lembur: ".$this->lembur." jam) = Rp ".number_format($this->hitungGaji(),0,",",".");
    }

    // Destructor
    public function __destruct() {
        echo "Destructor : Data karyawan '$this->nama' dihapus.\n";
    }
}

// ==== Main Program ====
echo "Masukkan jumlah karyawan: ";
$jumlahKaryawan = (int)trim(fgets(STDIN));

$listKaryawan = [];
$totalSemuaGaji = 0;

for($i = 1; $i <= $jumlahKaryawan; $i++) {
    echo "\nKaryawan ke-$i\n";
    echo "Nama       : "; $nama = trim(fgets(STDIN));
    echo "Golongan   : "; $golongan = trim(fgets(STDIN));
    echo "Total Lembur (jam): "; $jamLembur = (int)trim(fgets(STDIN));

    $pegawai = new Karyawan($nama, $golongan, $jamLembur);
    $listKaryawan[] = $pegawai;

    // akumulasi total gaji
    $totalSemuaGaji += $pegawai->hitungGaji();
}

// Cetak hasil
echo "\n-------------- Daftar Karyawan -------------\n";
foreach($listKaryawan as $item) {
    echo $item->getInfo()."\n\n";
}
echo "-------------------------------------------\n";
echo "TOTAL GAJI SELURUH KARYAWAN = Rp ".number_format($totalSemuaGaji,0,",",".")."\n";
?>
