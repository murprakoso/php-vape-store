<?php 
	
	include 'function.php';
	
	$id = $_GET['id'];
	$produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id' ");
	if ($row = mysqli_fetch_assoc($produk)) {
		$nama = $row['nama'];
		$kategori = $row['kategori'];
		$brand = $row['brand'];
		$keterangan = $row['keterangan'];
		$harga = $row['harga'];
		$foto = $row['foto'];
	}

	$produkSejenis = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori='$kategori' ORDER BY RAND() LIMIT 6 ");

  if (isset($_POST['masukkanKeranjang'])) {
  	if (!isset($_SESSION['login'])) {
  		header('Location: index.php?page=login');
  		exit;
  	}else{
  		$id_produk = $_POST['id'];
  		$id_pemesan = $_SESSION['userid'];
  		$tanggal = date("Y-m-d");
  		$jumlah = $_POST['jumlah'];

  		$cekStok = mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id_produk");
  		if ($row = mysqli_fetch_assoc($cekStok)) {
  			$stok = $row['stok'];
  		}
  		if ($stok > 0) {
  			$minStok = $stok - 1;
  			$cekPesanan = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pemesan='$id_pemesan' AND id_produk='$id_produk' ");
	  		if ($hasil = mysqli_fetch_assoc($cekPesanan)) {
	  			$id_pesan = $hasil['id'];
	  			$jumlahPesan = $hasil['jumlah']; 
	  			$jumlah = $jumlahPesan + 1;
	  			$keranjang = mysqli_query($koneksi,"UPDATE keranjang SET jumlah='$jumlah' WHERE id='$id_pesan' ");
	  		}else{
	  			$jumlah = 1;
  				$keranjang= mysqli_query($koneksi,"INSERT INTO keranjang VALUES ('','$id_produk','$jumlah','$tanggal','$id_pemesan')");
	  		}
  			$updateStok = mysqli_query($koneksi, "UPDATE produk SET stok='$minStok' WHERE id=$id_produk; ");
			  echo "<meta http-equiv='refresh' content='0'>";
  		}else{
  			echo '<script>';
			  echo 'alert("Mohon maaf, stok untuk produk ini telah habis !")';  //not showing an alert box.
			  echo '</script>';
			  echo "<meta http-equiv='refresh' content='0'>";
  		}
  	}
  }
 ?>

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-6 col-md-push-2">
				<div id="product-main-img">
					<div class="product-preview">
						<img src="img/produk/<?php echo $foto; ?>" alt="">
					</div>
				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product details -->
			<div class="col-md-6 mt-5">
				<div class="product-details">
					<h2 class="product-name"><?php echo $nama ?></h2>
					<div>
						<h3 class="product-price"><?php echo rupiah($harga); ?></h3>
						<span class="product-available">Produk tersedia</span>
					</div>
					<p>
						<?php echo $keterangan; ?>
					</p>

					<div class="add-to-cart">
						<form action="" method="post">
						<div class="qty-label">
							Jumlah
							<div class="input-number">
								<input type="number" name="jumlah" value="1">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
						<br><br>
							<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
							<button type="submit" name="masukkanKeranjang" class="add-to-cart-btn f12"><i class="fa fa-shopping-cart"></i> Tambah ke keranjang</button>
						</form>
					</div>
				</div>
			</div>
			<!-- /Product details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h4 class="title">Produk Sejenis</h4>
				</div>
			</div>

			<!-- product -->
			<?php while($row = mysqli_fetch_assoc($produkSejenis)) : ?>
			<div class="col-md-3 col-xs-6">
				<div class="product">
					<div class="product-img">
						<img src="img/produk/<?php echo $row['foto']; ?>" alt="">
						<div class="product-label">
							<span class="sale"><?php echo $row['brand']; ?></span>
						</div>
					</div>
					<div class="product-body">
						<p class="product-category text-uppercase"><?php echo $row['kategori']; ?></p>
						<h3 class="product-name">
							<a href="index.php?page=detail&&id=<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></a>
						</h3>
						<h4 class="product-price"><?php echo rupiah($row['harga']); ?></h4>
					</div>
					<div class="add-to-cart">
						<form action="" method="post">
							<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
							<button type="submit" name="masukkanKeranjang" class="add-to-cart-btn f12">
								<i class="fa fa-shopping-cart"></i> Tambah ke keranjang
							</button>
						</form>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
			<!-- /product -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /Section -->