<?php
class Tabungan {
    private $saldo;          
    protected $nama;         

    public function __construct($nama, $saldoAwal) {
        $this->nama  = $nama;
        $this->saldo = $saldoAwal;
    }

    public function getNama() {
        return $this->nama;
    }

    // info saldo
    public function infoSaldo() {
        echo "Saldo {$this->nama}: Rp " . number_format($this->saldo,0,",",".") . "\n";
    }

    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
            echo "{$this->nama} setor Rp " . number_format($jumlah,0,",",".") . "\n";
        } else {
            echo "Jumlah setor tidak valid!\n";
        }
    }

    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
            echo "{$this->nama} tarik Rp " . number_format($jumlah,0,",",".") . "\n";
        } else {
            echo "Tarik gagal! Saldo {$this->nama} tidak cukup.\n";
        }
    }
}
 
class Siswa extends Tabungan {
    public function __construct($nama, $saldoAwal) {
        parent::__construct($nama, $saldoAwal);
    }
}

$siswa = [
    new Siswa("Siswa 1", 100000),
    new Siswa("Siswa 2", 150000),
    new Siswa("Siswa 3", 200000)
];

// pilih siswa
echo "Pilih siswa:\n";
for ($i = 0; $i < count($siswa); $i++) {
    echo ($i+1).". ".$siswa[$i]->getNama()."\n";
}
echo "Pilihan: ";
$pilih = (int) fgets(STDIN);
$index = $pilih - 1;

// validasi siswa
if (!isset($siswa[$index])) {
    echo "Siswa tidak ditemukan!\n"; 
    exit;
}

// tampilkan saldo siswa yg dipilih
echo "\n=== Saldo Awal ===\n";
$siswa[$index]->infoSaldo();

// menu transaksi
echo "\nMenu Transaksi:\n1. Setor\n2. Tarik\nPilih: ";
$menu = (int) fgets(STDIN);

echo "Masukkan jumlah uang: ";
$jumlah = (int) fgets(STDIN);

// proses transaksi
if ($menu == 1) {
    $siswa[$index]->setor($jumlah);
} elseif ($menu == 2) {
    $siswa[$index]->tarik($jumlah);
} else {
    echo "Menu tidak valid!\n";
}

// tampilkan saldo akhir siswa yang dipilih
echo "\n=== Saldo Akhir ===\n";
$siswa[$index]->infoSaldo();
