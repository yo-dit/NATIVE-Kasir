<?php
require '../functions.php';

foreach($_POST['jumlah'] as $id => $jumlah){

	if($jumlah > 0){

		$produk = $_POST['produk'][$id];
		$harga = $_POST['harga'][$id];

		// cek stok
		$data = mysqli_query($conn,"SELECT stok FROM items WHERE id = $id");
		$items = mysqli_fetch_assoc($data);

		if($jumlah > $items['stok']){

			echo "<script>
			alert('Stock $produk tidak cukup');
			document.location.href='user.php';
			</script>";
			exit;

		}

		$total = $harga * $jumlah;

		mysqli_query($conn,"
		INSERT INTO pesanan (id_produk, produk, harga, jumlah, total)
		VALUES ('$id', '$produk', '$harga', '$jumlah', '$total')
		");

	}

}

header("Location: user.php");
exit;