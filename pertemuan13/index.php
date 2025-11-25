<?php
// index.php

// Pengecekan pesan dari proses_barang.php (misalnya: gagal login)
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal login") {
        echo "<script>alert('Login Gagal! Username atau password salah.');</script>";
    } else if ($_GET['pesan'] == "logout") {
        echo "<script>alert('Anda berhasil logout.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="kotak_login">
        <h3>Sistem Informasi Penjualan Barang <br/> Politeknik Negeri Subang</h3>
        <center>
            <img src="gambar/logo_aplikasi.png" width="200" height="200">
        </center>
    </div>

    <div class="kotak_login2">
        <p class="tulisan_login">Silahkan login</p>
        
        <form name="form1" method="post" action="proses_barang.php?action=login">
            <label>Username</label>
            <input type="text" name="username" id="username" class="form_login" placeholder="Username">

            <label>Password</label>
            <input type="password" name="password" id="password" class="form_login" placeholder="Password">

            <input type="submit" name="Submit" class="tombol_login" value="Login">
            &nbsp;
            <input type="reset" name="Reset" class="tombol_reset" value="Reset">
        </form>
    </div>

</body>
</html>