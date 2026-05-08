<?php
require '../functions.php';

$items = query("SELECT * FROM items");
?>

<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// proteksi halaman user
if ($_SESSION["role"] !== "user") {
	echo "<script>
        alert('Akses ditolak!');
        document.location.href = '/index.php';
    </scr
	ipt>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pesan Item</title>
	<link rel="stylesheet" href="user.css">
</head>

<body>

	<div class="container">
		<div class="menu">
			<h2>Menu Item</h2>

			<form action="order.php" method="post">

			<div class="menu-grid">
				<?php foreach ($items as $row) : ?>

				<div class="card">

					<div class="foto">
						<img src="../img/<?= $row["image"]; ?>">
					</div>

					<div class="info">

						<div class="produk">
							<?= $row["produk"]; ?>
						</div>

						<div class="stok">
							Stock <?= $row["stok"]; ?>
						</div>

						<div class="harga">
							Rp <?= $row["harga"]; ?>
						</div>

						<div class="beli">

							<input type="hidden" name="produk[<?= $row['id']; ?>]" value="<?= $row["produk"]; ?>">
							<input type="hidden" name="harga[<?= $row['id']; ?>]" value="<?= $row["harga"]; ?>">

							<div class="qty-control">

								<input type="number" name="jumlah[<?= $row['id']; ?>]" value="0" min="0">

								<button type="button" onclick="tambah(this)">▲</button>

								<button type="button" onclick="kurang(this)">▼</button>

							</div>

						</div>

					</div>

				</div>

				<?php endforeach; ?>
			</div>

			<br>

			<button class="enter-pesanan" type="submit">Masukkan Pesanan</button>


			<br>
			<a href="login.php" class="logout">LOG OUT</a>
			</form>

		</div>
					
		<div class="pesanan">

			<h2>Pesanan</h2>

			<div class="list">

				<?php
				$pesanan = mysqli_query($conn,"SELECT * FROM pesanan");

				$total = 0;

				if(mysqli_num_rows($pesanan) == 0){
					echo "Belum ada pesanan";
				}else{
					while($row = mysqli_fetch_assoc($pesanan)){
				?>

				<div>
					<?= $row['produk']; ?> x<?= $row['jumlah']; ?> 
					Rp<?= $row['total']; ?>

					<a href="delete_order.php?id=<?= $row['id']; ?>">❌</a>
				</div>

				<?php
					$total += $row['total'];
					}
				}
				?>

			</div>

			<div class="total">
				Total : Rp <?php echo $total; ?>
			</div>

			<br>

			<form action="payment.php" method="post">

				Uang Pembeli :
				<br>
				<input type="number" name="uang" id="uang" placeholder="Masukan uang pembeli">

				<div class="tombol-uang">
					<button type="button" onclick="tambahuang('000')">000</button>
					<button type="button" onclick="tambahuang('00')">00</button>
					<button type="button" onclick="hapus()">C</button>
				</div>

				<input type="hidden" name="total" value="<?= $total; ?>">

				<button class="pay" type="submit">Bayar</button>

			</form>
			

		</div>
	</div>

	<script>
		//func quick input
	function tambahuang(nol){
		let input = document.getElementById("uang");
		input.value = input.value + nol;
	}

	function hapus(){
		document.getElementById("uang").value = "";
	}


	//func qty control - order
	function tambah(btn){
	let input = btn.parentElement.querySelector("input");
	input.value = parseInt(input.value) + 1;
	}

	function kurang(btn){
		let input = btn.parentElement.querySelector("input");
		if(input.value > 0){
			input.value = parseInt(input.value) - 1;
		}
	}

	function enterSubmit(e, form){
		if(e.key === "Enter"){
			e.preventDefault();
			form.submit();
		}
	}
	</script>

</body>
</html>