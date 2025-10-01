<?php

// buat class komputer
class komputer {

    // property dengan hak akses protected
    private $jenis_processor = "Intel Core i7-4790 3.6Ghz";
    protected $jenis_RAM = "DDR 4";
    public $jenis_VGA = "PCI Express";

    public function tampilkan_processor() {
        return $this->jenis_processor;
    }

    public function tampilkan_jenisprocessor() {
        return $this->jenis_processor;
    }

    private function tampilkan_ram() {
        return $this->jenis_RAM;
    }

    protected function tampilkan_vga() {
        return $this->jenis_VGA;
    }

    public function tampilkan_vga2() {
        return $this->jenis_VGA;
    }
}

// buat class laptop extends komputer
class laptop extends komputer{

    public function display_processor() {
        // ERROR: Properti private ($jenis_processor) tidak dapat diakses di subclass.
        return $this->jenis_processor;
    }

    public function display_processor2() {
        // ERROR: Method public (tampilkan_processor) tidak dapat mengakses properti private ($jenis_processor) dari luar class-nya sendiri
        return $this->tampilkan_processor();
    }

    public function display_ram() {
        // Properti protected ($jenis_RAM) dapat diakses di subclass.
        return $this->jenis_RAM;
    }

    public function display_ram2() {
        // ERROR: Method private (tampilkan_ram) tidak dapat diakses di subclass.
        return $this->tampilkan_ram();
    }

    public function display_vga() {
        // Method protected (tampilkan_vga) dapat diakses di subclass.
        return $this->tampilkan_vga();
    }

    private function display_processorkomputer() {
        // ERROR: Properti private ($jenis_processor) tidak dapat diakses di subclass.
        return $this->jenis_processor;
    }
}

// buat objek dari class laptop (instansiasi)
$komputer = new komputer();
$laptop = new laptop();

// jalankan method dari class komputer
echo "Line 61 : " .$komputer->tampilkan_processor()."<br />";
// Output: Intel Core i7-4790 3.6Ghz

echo "Line 62 : " .$laptop->display_processor()."<br />";
// NOTICE/ERROR: Akan menghasilkan error karena $jenis_processor adalah private di parent class.

echo "Line 63 : " .$laptop->display_processor2()."<br />";
// Output: Intel Core i7-4790 3.6Ghz (Method tampilkan_processor() di class komputer BISA mengakses properti private-nya)

echo "Line 64 : " .$laptop->tampilkan_jenisprocessor()."<br />";
// Output: Intel Core i7-4790 3.6Ghz (Memanggil method public dari parent class)

echo "Line 65 : " .$laptop->display_ram()."<br />";
// Output: DDR 4 (Properti protected bisa diakses di subclass)

echo "Line 66 : " .$laptop->display_vga()."<br />";
// Output: PCI Express (Method protected bisa dipanggil di subclass)

echo "Line 67 : " .$laptop->display_processorkomputer()."<br />";
// NOTICE/ERROR: Akan menghasilkan error karena display_processorkomputer adalah private di class laptop dan dipanggil dari luar.
// Selain itu, di dalamnya juga mencoba mengakses properti private dari parent class.
?>