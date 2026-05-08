<?php
require '../functions.php';

$total = $_POST["total"];
$uang = $_POST["uang"];

if($uang < $total){

	echo "
	<script>
	alert('Uang tidak cukup');
	document.location.href='user.php';
	</script>
	";

}else{

	// ambil semua pesanan
	$pesanan = mysqli_query($conn,"SELECT * FROM pesanan");

	while($row = mysqli_fetch_assoc($pesanan)){

		$id_produk = $row['id_produk'];
		$jumlah = $row['jumlah'];

		// kurangi stock makanan
		mysqli_query($conn,"
		UPDATE items 
		SET stok = stok - $jumlah 
		WHERE id = '$id_produk'
		");

	}

	$kembalian = $uang - $total;
	
	echo "
	<script>
	alert('Pembayaran berhasil!');
	document.location.href='struk.php?total=$total&uang=$uang&kembalian=$kembalian';
	</script>
	";

}
?>