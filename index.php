<?php
require 'functions.php';
$items = query("SELECT*FROM items");
?>

<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: user/login.php");
    exit;
}

// proteksi halaman admin
if ($_SESSION["role"] !== "admin") {
    echo "<script>
        alert('Akses ditolak!');
        document.location.href = 'user/user.php';
    </script>";
    exit;
}
?>

<html>
    <head>
        <title>Halaman admin</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <h1 class="header">Tabel Items</h1>
        

        <table style="font-size:25px;" border="5" cellpadding="10" cellspacing="0">
        <tr>
        <!--<th>id</th>-->
        <th>No.</th>
        <th>Gambar</th>
        <th>Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Edit</th>
    </tr>

        <?php $i = 1; ?>
        <?php foreach ($items as $row) : ?>
        <tr>
            <td><?=$i;?></td>

        <td>
            <img src="img/<?= $row['image']; ?>" class="img-produk">
        </td>
        <td><?= $row ["produk"]; ?></td>
        <td><?= $row ["harga"]; ?></td>
        <td><?= $row ["stok"]; ?></td>
        <td>
            <a href="edit.php?id=<?= $row["id"]; ?>" class="btn-edit">Edit</a>
            <a href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');" class="btn-delete">Delete</a>
        </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        </table>

        <br>
        <br>
        <a href="add.php" style="font-size:20px;" class="btn-add">Tambah data Items</a>
        
        <a href="user/login.php" class="logout">LOG OUT</a>

    </body>
</html>
