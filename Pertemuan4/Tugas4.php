<?php
class BangunRuang {
    // Properties 
    var $jenis;
    var $sisi = 0;
    var $jari_jari = 0;
    var $tinggi = 0;

    // Setter (untuk mengisi data ke dalam objek)
    function setJenis($jenis) {
        $this->jenis = $jenis;
    }

    function setSisi($sisi) {
        $this->sisi = $sisi;
    }

    function setJariJari($jari_jari) {
        $this->jari_jari = $jari_jari;
    }

    function setTinggi($tinggi) {
        $this->tinggi = $tinggi;
    }

    // Method menghitung volume 
    public function hitungVolume() {
        $pi = 3.14;
        $volume = 0;

        if ($this->jenis == 'Bola') {
            $volume = (4/3) * $pi * ($this->jari_jari * $this->jari_jari * $this->jari_jari);
        } elseif ($this->jenis == 'Kerucut') {
            $volume = (1/3) * $pi * ($this->jari_jari * $this->jari_jari) * $this->tinggi;
        } elseif ($this->jenis == 'Limas Segi Empat') {
            $volume = (1/3) * ($this->sisi * $this->sisi) * $this->tinggi;
        } elseif ($this->jenis == 'Kubus') {
            $volume = $this->sisi * $this->sisi * $this->sisi;
        } elseif ($this->jenis == 'Tabung') {
            $volume = $pi * ($this->jari_jari * $this->jari_jari) * $this->tinggi;
        }

        return $volume;
    }
}

// Data bangun ruang dalam array
$dataBangunRuang = [
    ['jenis' => 'Bola', 'sisi' => 0, 'jari_jari' => 7, 'tinggi' => 0],
    ['jenis' => 'Kerucut', 'sisi' => 0, 'jari_jari' => 14, 'tinggi' => 10],
    ['jenis' => 'Limas Segi Empat', 'sisi' => 8, 'jari_jari' => 0, 'tinggi' => 24],
    ['jenis' => 'Kubus', 'sisi' => 30, 'jari_jari' => 0, 'tinggi' => 0],
    ['jenis' => 'Tabung', 'sisi' => 0, 'jari_jari' => 7, 'tinggi' => 10],
];

// Judul 
echo "Hasil Perhitungan Volume Bangun Ruang: ";
echo "<br>";
echo "<br>";

// Perulangan foreach 
foreach ($dataBangunRuang as $data) {
    $bangun = new BangunRuang();

    // Set data ke objek
    $bangun->setJenis($data['jenis']);
    $bangun->setSisi($data['sisi']);
    $bangun->setJariJari($data['jari_jari']);
    $bangun->setTinggi($data['tinggi']);

    // Hitung volume
    $volume = $bangun->hitungVolume();

    // Tampilkan hasil
    echo "Jenis: {$bangun->jenis}<br>";
    echo "Sisi: {$bangun->sisi}<br>";
    echo "Jari-Jari: {$bangun->jari_jari}<br>";
    echo "Tinggi: {$bangun->tinggi}<br>";
    echo "Volume: " . $volume . "<br><br>";
}
?>
