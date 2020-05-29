<?php 
	include 'function.php';
	setlocale(LC_ALL, 'IND');
	date_default_timezone_set('Asia/Pontianak');
	$id_user = $_SESSION['userid'];

	$pesanan = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_pemesan='$id_user' ORDER BY id DESC ");
	if ($row = mysqli_fetch_assoc($pesanan)) {
		$bank = $row['bank'];
		$id_transaksi = $row['id_transaksi'];
		$waktu = date('H:i', strtotime($row['waktu']));
		$tanggal = $row['tanggal'];
		$tanggal1 = str_replace('-', '/', $tanggal);
		$tanggalbatas = date('d/m/Y',strtotime($tanggal1 . "+1 days"));
	}

	$totalbayar = mysqli_query($koneksi, "SELECT sum(jumlah_bayar) AS jumlah FROM pesanan WHERE id_pemesan='$id_user' AND status='Belum dibayar' ");
	if ($row = mysqli_fetch_assoc($totalbayar)) {
		$jumlahbayar = $row['jumlah'];
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
					<li class="active">Pembayaran</li>
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
		<div class="row" style="min-height: 50vh; padding-bottom: 60px;">
			<div class="col-md-8 offset-2 alert-success p-5">
				<p class="font-weight-bold text-center f18">Menunggu Pembayaran</p>
				<p class="text-center">Mohon segera melakukan pembayaran sebelum tanggal <?php echo $tanggalbatas; ?> pukul <?php echo $waktu; ?> WIB, dengan rincian sebagai berikut.</p>
				
				<div class="row">
					<div class="col-md-10 offset-2">
						<table cellpadding="5">					
						<tr>
							<td>Bank</td>
							<td>:</td>
							<td><?php echo $bank; ?></td>
						</tr>
						<tr>
							<?php 
								if ($bank == "Mandiri") {
									$norekening = "0924415756178819 <br> a/n Ohanna Vape Store";
								}elseif ($bank == "BCA") {
									$norekening = "8129027728918891 <br> a/n Ohanna Vape Store";
								}elseif ($bank == "BNI") {
									$norekening = "0231892776200210 <br> a/n Ohanna Vape Store";
								}elseif ($bank == "BRI") {
									$norekening = "3034323876111098 <br> a/n Ohanna Vape Store";
								}
							 ?>
							<td>No. Rekening</td>
							<td>:</td>
							<td><?php echo $norekening; ?></td>
						</tr>
						<tr>
							<td>Kode Transaksi</td>
							<td>:</td>
							<td><?php echo $id_transaksi; ?></td>
						</tr>
						<tr>
							<td>Jumlah yang harus dibayar</td>
							<td>:</td>
							<td><b><?php echo rupiah($jumlahbayar); ?></b></td>
						</tr></p>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-md-10 offset-1 mt-5 text-center">
						Sudah melakukan pembayaran ? silahkan <a href="index.php?page=uploadbuktipembayaran&&id=<?php echo $id_transaksi; ?>">Upload Bukti Pembayaran</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>