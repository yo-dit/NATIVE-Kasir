<?php
require '../functions.php';

$pesanan = mysqli_query($conn, "SELECT * FROM pesanan");

$total = 0;
$total = $_GET['total'];
$uang = $_GET['uang'];
$kembalian = $_GET['kembalian'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Struk Pembayaran</title>
	<style>
		body {
			font-family: Arial;
			padding: 30px;
		}

		.struk {
			width: 300px;
			border: 1px solid black;
			padding: 20px;
		}

		.judul {
			text-align: center;
			font-weight: bold;
			margin-bottom: 20px;
		}

		.item {
			display: flex;
			justify-content: space-between;
		}

		.total {
			margin-top: 15px;
			border-top: 1px dashed black;
			padding-top: 10px;
			font-weight: bold;
		}
	</style>
</head>

<body>

	<div class="struk" class="center">

		<div class="judul">
			STRUK PEMBELIAN
			<br>
			<?= date("d-m-Y H:i"); ?>
		</div>

		<?php while ($row = mysqli_fetch_assoc($pesanan)) : ?>

			<div class="item">
				<span><?= $row['produk']; ?> x<?= $row['jumlah']; ?></span>
				<span>Rp <?= number_format($row['total'], 0, ',', '.'); ?></span>
			</div>

		<?php endwhile;?>

		<div class="total">
			Total : Rp <?= number_format($total, 0, ',', '.'); ?>
		</div>

		<div class="item">
			<span>Bayar</span>
			<span>Rp <?= number_format($uang, 0, ',', '.'); ?></span>
		</div>

		<div class="item">
			<span>Kembalian</span>
			<span>Rp <?= number_format($kembalian, 0, ',', '.'); ?></span>
		</div>

		<br>

		Terima Kasih 🙏

		<br><br>

		<a href="user.php">Kembali</a>

	</div>

	<?php
	mysqli_query($conn,"DELETE FROM pesanan");
	?>

</body>
</html>