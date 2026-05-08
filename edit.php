<?php
//koneksi ke DB
require 'functions.php';
//ambil data di URL
$id = $_GET['id'];

$trans = query("SELECT * FROM items WHERE id = $id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //cek apakah data berhasil ditambahkan/tdk
    if (edit($_POST) > 0) {
        echo"
        <script>
        alert('Data Berhasil Diubah!');
        document.location.href = 'index.php';
        </script>
        ";
}else{
    echo"
        <script>
        alert('Data Gagal Diubah!');
        document.location.href = 'index.php';
        </script>
        ";
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
                    <input type="hidden" name="id" value="<?= $trans['id']; ?>">
                    <input type="hidden" name="gambarLama" value="<?= $trans['image']; ?>">
                    <li>
                    <label for="image">Gambar :</label><br>
                    <img id="preview" src="img/<?= $trans['image']; ?>" width="120"><br><br>

                    <!-- drop area -->
                    <div id="drop-area">
                        <p>Drag & Drop / Paste / Klik untuk pilih gambar</p>
                        <input type="file" name="image" id="image" accept="image/*" hidden>
                    </div>
                    </li>
                    <li>
                        <label for="produk">Produk : </label>
                        <input type="text" name="produk" id="produk" value="<?= $trans['produk']; ?>" required>
                    </li>
                    <li>
                        <label for="harga">Harga : </label>
                        <input type="text" name="harga" id="harga" value="<?= $trans['harga']; ?>" required>
                    </li>
                    <li>
                        <label for="stok">Stok : </label>
                        <input type="text" name="stok" id="stok" value="<?= $trans['stok']; ?>" required>
                    </li>
                </div>
                
                    <button id="tombol1" type="submit" name="submit">Ubah Data</button>
                
            </ul>
        </form>

        <a href="index.php" class="btn-home">← Home</a>

        <link rel="stylesheet" href="edit.css">
        <script src="edit.js"></script>
    </body>
    
</html>