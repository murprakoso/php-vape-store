<?php 
    if (isset($_GET["hapus"])) {
    if (hapusPesanan($_GET) > 0 ) {
      $berhasilHapusPesanan = true;
      echo "<meta http-equiv='refresh' content='1;URL=index.php?page=pesanan'>";
    }else{
      $gagalHapusPesanan = true;
    }
  }
 ?>
<div class="container-fluid">
	<div class="col-md-12">
    <div class="row f14">
      <?php if(isset($berhasilHapusPesanan)) : ?>
      <div class="alert alert-success d-block">
        <p>Data pelanggan berhasil dihapus</p>
      </div>
      <?php elseif(isset($gagalHapusPesanan)) : ?>
        <div class="alert alert-danger d-block">
          <p>Data pelanggan gagal dihapus</p>
        </div>
      <?php endif; ?>
    </div>
		<div class="row f14">
				<?php 
					$pesanan = mysqli_query($koneksi, "SELECT * FROM pesanan");
					  // Pagination (Perpindahan hal)
						  if (isset($_GET["jdp"])) {
						      $dataTampil = $_GET["jdp"];
						    }else{
						      $dataTampil = 10;
						    }
						  $jdp = (isset($_GET["jdp"])) ? $_GET["jdp"] : 10;
						  $jumlahdataperhal = $dataTampil;
						  $jumlahdata = count(query("SELECT * FROM pesanan"));
						  $jumlahhal = ceil($jumlahdata / $jumlahdataperhal);
						  $halaktif = (isset($_GET["hal"])) ? $_GET["hal"] : 1;
						  $awaldata = ($jumlahdataperhal * $halaktif) - $jumlahdataperhal;

						  $pesanan = mysqli_query($koneksi, "SELECT * FROM pesanan ORDER BY id DESC LIMIT $awaldata,$jumlahdataperhal ");
						  $totalpesanan = count(query("SELECT * FROM pesanan"));
				 ?>
				 <ul class="list-unstyled" style="display: flex;">
				 	<li style="margin-right: 30px;">
				 		<form action="" method="GET" class="form-group">
              <input type="hidden" name="page" value="pesanan">
                <select id="jdp" class="form-control" style="width: 70px;" name="jdp" onchange="this.form.submit()">
                  <?php if (($_GET["jdp"] == 10 )): ?>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                  <?php elseif (($_GET["jdp"] == 25 )): ?>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                  <option value="10">10</option>
                  <?php elseif (($_GET["jdp"] == 50 )): ?>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                  <option value="25">25</option>
                  <option value="10">10</option>
                  <?php elseif (($_GET["jdp"] == 75 )): ?>
                  <option value="75">75</option>
                  <option value="100">100</option>
                  <option value="50">50</option>
                  <option value="25">25</option>
                  <option value="10">10</option>
                  <?php elseif (($_GET["jdp"] == 100 )): ?>
                  <option value="100">100</option>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <?php else: ?>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                  <?php endif ?>
                </select>
            </form>
				 	</li>
				 	<!-- Navigasi hal -->
          <li style="margin-top: -10px; margin-right: 50px;">
            <nav aria-label="Page Navigation">
              <ul class="breadcrumb" style="background: transparent;">
                  <?php if($halaktif > 1 ) : ?>
                    <li class="page-item">
                       <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=1" class="page-link">
                         &laquo; First
                       </a>
                    </li>
                  <?php endif; ?>
                  <?php if($halaktif > 1 ) : ?>
                    <li class="page-item">
                       <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $halaktif - 1; ?>" class="page-link">
                         &laquo; Prev
                       </a>
                    </li>
                   <?php endif; ?>
                  <!-- Pilihan hal -->
                  <?php if ($halaktif == 1): ?>
                    <?php for($i = max(1, $halaktif - 2); $i <= min($halaktif + 4, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                   <?php elseif ($halaktif == 2): ?>
                    <?php for($i = max(1, $halaktif - 2); $i <= min($halaktif + 3, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                  <?php elseif ($halaktif == $jumlahhal): ?>
                    <?php for($i = max(1, $halaktif - 4); $i <= min($halaktif + 3, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                   <?php elseif ($halaktif == ($jumlahhal - 1)) : ?>
                    <?php for($i = max(1, $halaktif - 3); $i <= min($halaktif + 3, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                  <?php else: ?>
                    <?php for($i = max(1, $halaktif - 2); $i <= min($halaktif + 2, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                  <?php endif; ?>
                  <!-- Akhir pilihan hal -->

                  <!-- navigasi maju -->
                   <?php if($halaktif < $jumlahhal ) : ?>
                    <li class="page-item">
                       <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $halaktif + 1; ?> " class="page-link">
                         Next &raquo;
                       </a>
                    </li>
                   <?php endif; ?>

                    <?php if($halaktif < $jumlahhal ) : ?>
                      <li class="page-item">
                         <a href="?page=pesanan&&jdp=<?= $jdp; ?>&&hal=<?= $jumlahhal; ?> " class="page-link">
                           Last &raquo;
                         </a>
                     </li>
                   <?php endif; ?>
                </ul>
             </nav>
          </li>
				 	<li style="margin-top: 10px;">Menampilkan <?= $dataTampil; ?> dari <?= $totalpesanan; ?> pesanan</li>
				 </ul>
				<table class="table table-hover table-responsive f13">
					<tr class="text-center">
						<th>No</th>
            <th>Kode Transaksi</th>
						<th>Nama Pemesan</th>
            <th>No HP</th>
						<th>Nama Produk</th>
						<th>Jumlah Pesanan</th>
						<th>Total harga</th>
            <th>Alamat Pengiriman</th>
						<th>Kode POS</th>
            <th>Transfer Bank</th>
						<th>Jasa Pengiriman</th>
            <th>Status Pesanan</th>
            <th>Bukti Pembayaran</th>
            <th></th>
					</tr>
					<?php if ($totalpesanan > 0): ?>
						<?php $i = (($jdp * $halaktif) - $dataTampil) +1; ?>
						<?php while ($row = mysqli_fetch_assoc($pesanan)) : ?>
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
								<td class="text-center"><?php echo $namapemesan; ?></td>
                <td><?php echo $nohp; ?></td>
								<td class="text-center"><?php echo $namaproduk; ?></td>
								<td class="text-center"><?php echo $row['jumlah_barang']; ?> unit</td>
                <td><?php echo rupiah($row['jumlah_bayar']); ?></td>
								<td class="text-capitalize"><?php echo $row['alamat_pengiriman'] ?></td>
								<td><?php echo $row['kodepos']; ?></td>
                <td class="text-center"><?php echo $row['bank']; ?></td>
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
                <td class="text-capitalize text-center f12 <?php echo $background; ?>" style="padding: 5px 10px; margin: 10px;">
                  <?php echo $row['status']; ?>
                </td>
                <?php if ($row['buktipembayaran'] != 0) : ?>
                  <td>
                    <img src="../img/buktipembayaran/<?php echo $row['buktipembayaran']; ?>" style="width: 120px; height: 80px; object-fit: contain;">
                  </td>
                  <?php else: ?>
                    <td>
                      Belum mengupload bukti pembayaran !
                    </td>
                <?php endif; ?>
								<td>
									<a href="index.php?page=pesanan&&hapus&&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">
                    <i class="fa fa-trash"></i>
                  </a>
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
