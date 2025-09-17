<?php

class warung {
    private $barang;

    public function __construct($barang) {
        $this->barang = $barang;
    }

    public function menampilkanbarang() {
        foreach ($this->barang as $namabarang => $harga) {
            echo "- " . $namabarang . " dengan harga Rp " . $harga . "<br/>";
        }
    }
}

$barang = [
    "kecap" => 3000,
    "tepung terigu" => 4000
];

$barang1 = new warung($barang);
$barang1->menampilkanbarang();

?>