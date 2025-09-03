<?php

class Belanja {
    var $nama_pembeli;
    var $punya_kartu_member;
    var $total_belanja;
    var $diskon;
    var $total_bayar;

    function setNamaPembeli($nama) {
        $this->nama_pembeli = $nama;
    }

    function setPunyaKartuMember($status) {
        $this->punya_kartu_member = $status;
    }

    function setTotalBelanja($total) {
        $this->total_belanja = $total;
    }

    function getNamaPembeli() {
        return $this->nama_pembeli;
    }

    function getPunyaKartuMember() {
        return $this->punya_kartu_member;
    }

    function getTotalBelanja() {
        return $this->total_belanja;
    }
    
    function getDiskon() {
        $this->hitungDiskon();
        return $this->diskon;
    }
    
    function getTotalBayar() {
        $this->hitungTotalBayar();
        return $this->total_bayar;
    }

    function hitungDiskon() {
        if ($this->punya_kartu_member) {
            if ($this->total_belanja > 500000) {
                $this->diskon = 50000;
            } elseif ($this->total_belanja > 100000) {
                $this->diskon = 15000;
            } else {
                $this->diskon = 5000;
            }
        } else {
            if ($this->total_belanja > 100000) {
                $this->diskon = 5000;
            } else {
                $this->diskon = 0;
            }
        }
    }

    function hitungTotalBayar() {
        $this->hitungDiskon();
        $this->total_bayar = $this->total_belanja - $this->diskon;
    }
}


$pembeli1 = new Belanja();
$pembeli1->setNamaPembeli("Pembeli 1");
$pembeli1->setPunyaKartuMember('Memiliki');
$pembeli1->setTotalBelanja(200000);



echo "Nama Pembeli = " . $pembeli1->getNamaPembeli(); echo "<br>";
echo "Punya Kartu Member = " . $pembeli1->getPunyaKartuMember(); echo "<br>";
echo "Total Belanja = Rp " . $pembeli1->getTotalBelanja(); echo "<br>";
echo "Diskon = Rp " . $pembeli1->getDiskon(); echo "<br>";
echo "Total Bayar = Rp " . $pembeli1->getTotalBayar(); echo "<br>";

?>