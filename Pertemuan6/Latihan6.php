<?php
class belanja{
    public $namabarang;
    public $harga;
    public $jumlah;
    public $total;

    public function __construct($namabarang, $harga, $jumlah){
        $this->namabarang = $namabarang;
        $this->harga = $harga;
        $this->jumlah = $jumlah;
        $this->total = $harga * $jumlah;
        echo "constuct : Data belanja '$this->namabarang' dibuat.\n";
    }
    public function getinfo(){
        return $this->namabarang . " (" . $this->harga . " x ". $this->jumlah . ") = ". $this->total;
    }
    public function __destruct(){
        echo "Destructor : Data belanja '$this->namabarang' dihapus.\n";
    }

}
echo"Masukkan jumlah barang yang di beli: ";
$jml = (int)trim(fgets(STDIN));

$barang = [];
$totalBelanja= 0;

for($i = 1; $i <=$jml; $i++){
    echo "\nBarang ke-$i\n";
    echo "Nama Barang: "; $namabarang = trim(fgets(STDIN));
    echo "Harga Satuan: "; $harga = (int)trim(fgets(STDIN));
    echo "Jumlah: "; $jumlah = (int)trim(fgets(STDIN));

    $mie = new belanja ($namabarang, $harga, $jumlah);
    $barang[] = $mie;
    $totalBelanja += $mie->total;
}
echo "--------------Daftar Belanja-------------" . "\n";
foreach ($barang as $item){
    echo $item->getInfo() . "\n";

}

echo "-------------------------" . "\n";
echo"Total Belanja adalah: " . $totalBelanja . "\n";
?>