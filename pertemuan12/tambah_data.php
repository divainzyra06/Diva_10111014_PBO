<?php
// Baris 1-3: Setup dan Koneksi
include('koneksi.php');
$db = new Database();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Barang</title>
    
    <style type="text/css">
        .formbackground_border {
            color: black;
        }

        .formprint_satuan {
            margin: 0px 250px;
            color: white;
        }

        .posisi_tombol {
            margin: 0px 300px;
        }

        .tombol_login {
            background: #47C0DB;
            color: white;
            font-size: 11pt;
            border: none;
            padding: 10px 20px;
        }

        /* Styling diambil dari bagian style di screenshot */
        * {
            font-family: "Trebuchet MS";
        }
        
        h1 {
            text-transform: uppercase;
            color: #47C0DB;
        }

        table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            width: 40%;
            margin: 10px auto 10px auto;
        }

        table thead th {
            background-color: #DDEEFF;
            border: solid 1px #DDEEEE;
            color: #333333;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #fff;
            text-decoration: none;
        }

        table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }

        a {
            background-color: #47C0DB;
            color: #fff;
            padding: 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div align="center">
        <h1>Form Tambah Data Barang</h1>
    </div>

        <form method="post" action="proses_barang.php?action=add" enctype="multipart/form-data">
            <table width="60%">
            <tr>
                <td width="40%">Kode Barang</td>
                <td width="5%">:</td>
                <td width="55%">
                    <input type="text" name="kode_barang" placeholder="Kode Barang " required/>
                </td>
            </tr>


                <tr>
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td><input type="text" name="nama_barang" placeholder="Nama Barang"></td>
                </tr>

                <tr>
                    <td>Stok</td>
                    <td>:</td>
                    <td><input type="text" name="stok" placeholder="Stok"></td>
                </tr>

                <tr>
                    <td>Harga Beli</td>
                    <td>:</td>
                    <td><input type="text" name="harga_beli" placeholder="Harga Beli"></td>
                </tr>

                <tr>
                    <td>Harga Jual</td>
                    <td>:</td>
                    <td><input type="text" name="harga_jual" placeholder="Harga Jual"></td>
                </tr>

                <tr>
                    <td>Gambar Produk</td>
                    <td>:</td>
                    <td>
                        <input type="file" name="gambar_produk" required> 
                        <span style="color: red">Ekstensi yang diperbolehkan: .png | .jpeg | .jpg</span>
                    </td>
                </tr>

                <tr>
                    <td height="40" colspan="3" align="center">
                        <input type="submit" class="tombol_login" name="tombol" value="Simpan">
                        <input type="submit" class="tombol_login" name="tombol" value="Kembali">
                        </td>
                </tr>
            </tbody>
        </table>
    </form>

</body>
</html>