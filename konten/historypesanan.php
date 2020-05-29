<?php 
	
	include 'function.php';
	$id_user = $_SESSION['userid'];
	$datapesanan = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_pemesan='$id_user' ORDER BY id DESC ");
	$totalpesanan = count(query("SELECT * FROM pesanan"));

	if (isset($_POST['diterima'])) {
		$id = $_POST['id'];
		$status = "Di terima";

		mysqli_query($koneksi, "UPDATE pesanan SET status='$status' WHERE id='$id' ");
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
					<li class="active">History Pesanan</li>
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
		<div class="row" style="min-height: 50vh;">
			<div class="col-md-12">
				<h5>History Pesanan Anda</h5>
				<br>
				<table class="table table-responsive f13">
					<tr class="text-center">
						<th>No</th>
						<th>Kode Transaksi</th>
						<th>Nama Produk</th>
						<th>Jumlah Produk</th>
						<th>Jumlah Bayar</th>
						<th>Alamat Pengiriman</th>
						<th>Pembayaran Melalui</th>
						<th>Jasa Pengiriman</th>
						<th>Status Pesanan</th>
					</tr>
					<?php if ($totalpesanan > 0): ?>
						<?php $i = 1; ?>
						<?php while ($row = mysqli_fetch_assoc($datapesanan)) : ?>
              <?php 
                $id_pemesan = $row['id_pemesan'];
                $id_produk = $row['id_produk'];
                $dataPemesan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_pemesan' ");
                if ($dPemesan = mysqli_fetch_assoc($dataPemesan)) {
                  $namapemesan = $dPemesan['nama'];
                  $nohp = $dPemesan['nohp'];
                }
                $dataProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id_produk' ");
                 if ($dProduk = mysqli_fetch_assoc($dataProduk)) {
                  $namaproduk = $dProduk['nama'];
                }
               ?>
							<tr>
								<td class="text-center"><?= $i; ?></td>
                <td class="text-center"><?php echo $row['id_transaksi']; ?></td>
								<td class="text-center"><?php echo $namaproduk; ?></td>
								<td class="text-center"><?php echo $row['jumlah_barang']; ?> unit</td>
                <td><?php echo rupiah($row['jumlah_bayar']); ?></td>
								<td class="text-capitalize"><?php echo $row['alamat_pengiriman'] ?>, Kode POS <?php echo $row['kodepos']; ?></td>
                <td class="text-center">BANK <?php echo $row['bank']; ?></td>
								<td class="text-center"><?php echo $row['jasa_pengiriman']; ?></td>
                <?php 
                  if ($row['status'] == "Belum dibayar") {
                    $background = "btn btn-sm alert-danger";
                  }elseif ($row['status'] == "Pengiriman") {
                    $background = "btn btn-sm alert-warning";
                  }elseif ($row['status'] == "Di terima") {
                    $background = "btn btn-sm alert-success";
                  }
                 ?>
                <td class="text-capitalize text-center f12 d-block <?php echo $background; ?>" style="padding: 5px 10px; margin: 0 10px;">
                  <?php echo $row['status']; ?><br> <br>
                  <?php if ($row['status'] == "Belum dibayar"): ?>
                  <a href="index.php?page=uploadbuktipembayaran&&id=<?php echo $row['id_transaksi']; ?>" class="btn btn-sm btn-primary f12" style="padding: 5px 10px;">Upload Bukti Pembayaran</a>
                  <?php elseif ($row['status'] == "Pengiriman"): ?>
                  <form action="" method="post">
                  	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  	<input type="submit" name="diterima" value="Barang telah diterima" class="btn btn-sm btn-success f12">
                  </form>
                  <?php endif; ?>
                </td>
							</tr>
						<?php $i++; ?>
						<?php endwhile; ?>
					<?php else : ?>
						<tr>
							<td>Data pesanan kosong !</td>
						</tr>
					<?php endif; ?>
				</table>
			</div>
		</div>
	</div>
</div>