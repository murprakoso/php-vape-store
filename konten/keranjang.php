<?php 

	include 'function.php';

	$id_pemesan = $_SESSION['userid'];
	$totalKeranjang = count(query("SELECT * FROM keranjang WHERE id_pemesan='$id_pemesan' "));
	$dataKeranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pemesan='$id_pemesan' ORDER BY id DESC ");

	if (isset($_POST['hapus'])) {
		$idKeranjang = $_POST['idKeranjang'];
		$idProduk = $_POST['idProduk'];
		$jumlah = $_POST['jumlah'];
		$stok = $_POST['stok'];
		$updateStok = $jumlah + $stok;
		mysqli_query($koneksi, "DELETE FROM keranjang WHERE id='$idKeranjang' ");
		mysqli_query($koneksi, "UPDATE produk SET stok='$updateStok' WHERE id='$idProduk' ");
		echo "<meta http-equiv='refresh' content='0'>";
	}

 ?>

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb-tree">
					<li><a href="index.php">Beranda</a></li>
					<li class="active">Keranjang (<?php echo $totalKeranjang; ?>)</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<div class="section" style="min-height: 60vh;">
	<div class="container">
		<div class="row f14">
			<div class="col-md-12">
				<table class="table table-hover">
					<tr>
						<th>No</th>
						<th>Foto</th>
						<th>Nama Produk</th>
						<th>Kategori</th>
						<th>Jumlah</th>
						<th>Harga</th>
						<th></th>
					</tr>
					<?php $i=1; ?>
					<?php $subtotal = 0;  ?>
					<?php while($row = mysqli_fetch_assoc($dataKeranjang)) : ?>
						<?php 
							$id_produk = $row['id_produk'];
							$dataProduk = mysqli_query($koneksi,"SELECT * FROM produk WHERE id=$id_produk ");
						 ?>
					<?php if ($dP = mysqli_fetch_assoc($dataProduk)) : ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><img src="img/produk/<?php echo $dP['foto']; ?>" style="width: 100px; height: 100px; border-radius: 5px; object-fit: contain;"></td>
						<td><?php echo $dP['nama']; ?></td>
						<td><?php echo $dP['kategori']; ?></td>
						<td><?php echo $row['jumlah']; ?></td>
						<td><?php echo rupiah($dP['harga']); ?></td>
						<?php 
							$total = (($row['jumlah']) * ($dP['harga']));
							$subtotal += $total; 
						?>
						<td>
							<form action="" method="post">
								<input type="hidden" name="idKeranjang" value="<?php echo $row['id']; ?>">
								<input type="hidden" name="idProduk" value="<?php echo $dP['id']; ?>">
								<input type="hidden" name="stok" value="<?php echo $dP['stok']; ?>">
								<input type="hidden" name="jumlah" value="<?php echo $row['jumlah']; ?>">
								<button type="submit" name="hapus" class="btn btn-sm btn-outline-danger"> Batal </button>
							</form>
						</td>
					</tr>
					<?php endif; ?>
					<?php $i++; ?>
					<?php endwhile; ?>
					<tr style="margin-top: 30px;">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><b>Total</b></td>
						<td><b><?php echo rupiah($subtotal); ?></b></td>
						<?php 
								if (!isset($_SESSION['totalharga'])) {
										$_SESSION['totalharga'] = true;
										$_SESSION['subtotal'] = $subtotal; 
								}
							?>
						<td></td>
					</tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="index.php?page=konfirmasi" class="btn btn-block btn-primary"> Konfirmasi <i class="fa fa-arrow-circle-right"></i></a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>