<?php
for ($i = 1; $i < 5; $i++) {

    // Cetak spasi
    for ($j = $i; $j <= 5; $j++) {
        echo "&nbsp;"; // spasi kosong
    }

    // Cetak bintang
    for ($j = 1; $j <= $i; $j++) {
        echo " * ";
    }

    echo '<br />';
}
?>
