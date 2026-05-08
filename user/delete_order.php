<?php
require '../functions.php';

$id = $_GET['id'];

//data pesanan
$data = mysqli_query($conn, "SELECT * FROM pesanan WHERE id = $id");
$row = mysqli_fetch_assoc($data);

$produk = $row['produk'];
$jumlah = $row['jumlah'];


//hapus pesanan
mysqli_query($conn, "DELETE FROM pesanan WHERE id = $id");

header("Location: user.php");
?>