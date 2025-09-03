<?php

class BarangHarian{
    var $namaBarang = "Mie Instan";
    var $harga;
    var $jumlah;
    var $total;
 

    function setnamaBarang($X){
        $this->namaBarang = $X;
    }
    function get_namaBarang(){
        return $this->namaBarang;
    }

    function setharga($Y){
        $this->harga = $Y;
    }
    function get_harga(){
        return $this->harga;
    }

    function set_jumlah($Y){
        $this->jumlah = $Y;
    }
    function get_jumlah(){
        return $this->jumlah;
    }

        function hitungtotalPembayaran(){
        $total = $this->harga * $this->jumlah;
        return $total;
    }

    function statusPembayaran(){
        $total = $this->hitungtotalPembayaran();
        if ($total > 5000) $status = 'Mahal';
        else $status = 'Murah';
        return $status;
        }
    }


$barang1 = new BarangHarian();
$barang1 -> harga = 15000;
$barang1 -> jumlah = 3;

$barang2 = new BarangHarian();
$barang2 -> namaBarang = "Kopi";
$barang2 -> harga = 3000;
$barang2 -> jumlah = 5;

$barang3 = new BarangHarian();
$barang3 -> namaBarang = "air mineral";
$barang3 -> harga = 5000;
$barang3 -> jumlah = 5;


echo $barang1 -> namaBarang; echo "<br>";
echo "Harga = Rp " . $barang1 -> harga; echo "<br>";
echo "Jumlah Beli =  " . $barang1 -> jumlah; echo "<br>";
echo "Total Harga = Rp " . $barang1 -> hitungtotalPembayaran(); echo "<br>";
echo "Status Pembayaran = ". $barang1 -> statusPembayaran();
echo "<br>";

echo "<br>";
echo $barang2 -> namaBarang; echo "<br>";
echo "Harga = Rp " . $barang2 -> harga; echo "<br>";
echo "Jumlah Beli =  " . $barang2 -> jumlah; echo "<br>";
echo "Total Harga = Rp " . $barang2 -> hitungtotalPembayaran(); echo "<br>"; 
echo "Status Pembayaran = ". $barang2 -> statusPembayaran();
echo "<br>";

echo "<br>";
echo $barang3 -> namaBarang; echo "<br>";
echo "Harga = Rp " . $barang3 -> harga; echo "<br>";
echo "Jumlah Beli =  " . $barang3 -> jumlah; echo "<br>";
echo "Total Harga = Rp " . $barang3 -> hitungtotalPembayaran(); echo "<br>";
echo "Status Pembayaran = ". $barang3 -> statusPembayaran();

$totalBelanja = $barang1 -> hitungtotalPembayaran() + $barang2 -> hitungtotalPembayaran(); + $barang3 -> hitungtotalPembayaran();

echo "<br>";
echo "Total Belanja = Rp. " . $totalBelanja; echo "<br>";

?> 