<?php
class KonversiSuhu {
    public $celcius;
    public $hasil = [];

    // Constructor untuk menerima input suhu dalam Celcius
    function __construct($celcius) {
        $this->celcius = $celcius;
        $this->konversi();
    }

    // Method untuk konversi ke suhu lain
    function konversi() {
        $this->hasil = [
            "Kelvin" => $this->celcius + 273.15,
            "Fahrenheit" => ($this->celcius * 9/5) + 32
        ];
    }

    // Method untuk menampilkan hasil konversi
    function tampilkan() {
        echo "<h2>Konversi Suhu dari Celcius</h2>";
        echo " Suhu dalam Celcius = {$this->celcius} derajat <br>";

        foreach ($this->hasil as $satuan => $nilai) {
            // percabangan untuk format tampilan
            if ($satuan == "Fahrenheit") {
                echo "Suhu dalam {$satuan} = " . number_format($nilai, 1) . " derajat <br>";
            } else {
                echo "Suhu dalam {$satuan} = {$nilai} derajat <br/>";
            }
        }

        echo "<br><i>Selain konversi suhu yang bisa dilakukan</i>";
    }
}

// Ambil input suhu dari GET
if (isset($_GET['suhu'])) {
    $suhu = $_GET['suhu'];
    $konversi = new KonversiSuhu($suhu);
    $konversi->tampilkan();
} else {
    // Form input jika belum ada nilai GET
    echo "<form method='get'>";
    echo "Masukkan suhu (Celcius): <input type='text' name='suhu'>";
    echo "<input type='submit' value='Konversi'>";
    echo "</form>";
}
?>