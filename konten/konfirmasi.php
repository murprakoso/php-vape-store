<?php
	include 'function.php';
	setlocale(LC_ALL, 'IND');
	date_default_timezone_set('Asia/Pontianak');

	$subtotal = $_SESSION['subtotal'];
	$userid = $_SESSION['userid'];
	$dataPemesan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id' ");
	if ($row = mysqli_fetch_assoc($dataPemesan)) {
		$nama = $row['nama'];
		$nohp = $row['nohp'];
	}

	if (isset($_POST["konfirmasi"])) {
		if (konfirmasiPesanan($_POST) > 0 ) {
			$berhasilKonfirmasi = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php?page=pembayaran'>";
		}else{
			$gagalKonfirmasi = true;
		}
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
					<li class="active">Konfirmasi</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<?php if(isset($berhasilKonfirmasi)) : ?>
	 				<div class="alert alert-success">
	 					<p>Pesanan anda berhasil dikonfirmasi.</p>
	 				</div>
	 			<?php elseif(isset($gagalKonfirmasi)) : ?>
	 				<div class="alert alert-danger">
	 					<p>Maaf, anda gagal melakukan konfirmasi pesanan anda. Mohon periksa kembali data yang anda masukkan !</p>
	 				</div>
	 			<?php endif; ?>
			</div>

			<div class="col-md-6 f14 offset-3">
				<!-- Billing Details -->
				<div class="billing-details">
						<h4 class="text-center">KONFIRMASI PESANAN</h4>
						<br>
						<p>Masukkan alamat lengkap anda untuk pengiriman !</p>
					<form action="" method="post">
						<div class="form-group">
							<input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
							<input type="hidden" name="userid" value="<?php echo $userid; ?>">
							<input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
							<input type="hidden" name="waktu" value="<?php echo date('H:i:s'); ?>">
							<?php $id_transaksi = date('dmY') . time() . mt_rand() . $userid; ?>
							<input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>">
							<input class="input text-capitalize" type="text" name="nama" placeholder="Nama lengkap ..." value="<?php echo $nama; ?>">
						</div>
						<div class="form-group">
							<textarea class="input" type="text" name="alamat" placeholder="Alamat Pengiriman..."></textarea>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="kodepos" placeholder="Kode POS ...">
						</div>
						<div class="form-group">
							<input class="input" type="nohp" name="nohp" placeholder="Nomor Handphone ..." value="<?php echo $nohp; ?>">
						</div>
						<div class="form-group">
							<select name="bank" id="bank" class="input">
								<option value="">--- Transfer BANK ---</option>
								<option value="BNI">BNI</option>
								<option value="BCA">BCA</option>
								<option value="BRI">BRI</option>
								<option value="Mandiri">Mandiri</option>
							</select>
						</div>
						<div class="form-group">
							<select name="jasapengiriman" id="jasapengiriman" class="input">
								<option value="">--- Jasa Pengiriman ---</option>
								<option value="JNE">JNE</option>
								<option value="TIKI">TIKI</option>
								<option value="J&T">J&T</option>
							</select>
						</div>
						<br>
						<div class="form-group">
							<button type="submit" name="konfirmasi" class="btn btn-primary">--<i class="fa fa-angle-right"></i> Pembayaran</button>
						</div>
					</form>
				</div>
				<!-- /Billing Details -->
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->