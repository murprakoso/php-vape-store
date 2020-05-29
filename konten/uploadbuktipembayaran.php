<?php 
	include 'function.php';
	$id_transaksi = $_GET['id'];

	if (isset($_POST["upload"])) {
		if (uploadBuktiPembayaran($_POST) > 0 ) {
			$berhasilUpload = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php'>";
		}else{
			$gagalUpload = true;
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
					<li class="active">Upload Bukti Pembayaran</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-2">
				<?php if (isset($berhasilUpload)): ?>
					<div class="alert alert-success">Bukti pembayaran berhasil diupload !</div>
				<?php elseif(isset($gagalUpload)): ?>
					<div class="alert alert-danger">Bukti pembayaran gagal diupload !</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="row" style="min-height: 50vh;">
			<div class="col-md-8 offset-2">
				<h5 class="text-uppercase text-center mb-3">Upload Bukti Pembayaran</h5>
				<p class="text-center">( Kode Transaksi : <?php echo $id_transaksi; ?> )</p>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>">
					<div class="form-group">
						<img src="img/buktipembayaran/noimg.jpg" id="buktipembayaran" style="width: 100%; height: 500px; object-fit: contain;">
						<input type="file" name="buktipembayaran" accept="image/jpg, image/jpeg, image/png" class="form-control" onchange="readURLC(this);" required>
					</div>
					<div class="form-group">
						<input type="submit" name="upload" value="Upload" class="btn btn-sm btn-primary">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>