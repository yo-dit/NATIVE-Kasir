<?php
require 'functions.php';

if ( isset($_POST["submit"])){
        //cek apakah berhasil atau tidak
    if(add($_POST)>0){
        echo 
        "<script>
        alert('Success!');
        document.location.href = 'index.php';
        </script>";
    }else {
        echo
        "<script>
        alert('Failed.');
        document.location.href = 'add.php';
        </script>";
    }
}
?>

<html>
    <head>
        <title>Halaman admin</title>
    </head>
    <body>

<form action="" method="post" enctype="multipart/form-data">
            <ul>
                <div id="inputs">
                    <li>
                        <label for="image">Gambar :</label><br>
                        <img id="preview" src="" width="120" style="display:none;"><br><br>
                        <!-- drop area -->
                        <div id="drop-area">
                            <p>Drag & Drop / Paste / Klik untuk pilih gambar</p>
                            <input type="file" name="image" id="image" accept="image/*" hidden>
                        </div>
                    </li>
                    <li>
                        <label for="produk">Produk : </label>
                        <input type="text" name="produk" id="produk" required>
                    </li>
                    <li>
                        <label for="harga">Harga : </label>
                        <input type="text" name="harga" id="harga" required>
                    </li>
                    <li>
                        <label for="stok">Stok : </label>
                        <input type="" name="stok" id="stok" required>
                    </li>
                </div>
                
                    <button id="tombol1" type="submit" name="submit">Tambahkan Data</button>
                
            </ul>
        </form>

        <a href="index.php" class="btn-home">← Home</a>

        <link rel="stylesheet" href="add.css">
        <script src="add.js"></script>
    </body>
    
</html>