<?php 

		if (isset($_GET["hapus"])) {
		if (hapuspelanggan($_GET) > 0 ) {
			$berhasilHapusPelanggan = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php?page=manajemenpelanggan'>";
		}else{
			$gagalHapusPelanggan = true;
		}
	}

 ?>

<div class="container-fluid">
	<div class="col-md-12">
		<div class="row">
			<?php if(isset($berhasilHapusPelanggan)) : ?>
			<div class="alert alert-success d-block">
				<p>Data pelanggan berhasil dihapus</p>
			</div>
			<?php elseif(isset($gagalHapusPelanggan)) : ?>
				<div class="alert alert-danger d-block">
					<p>Data pelanggan gagal dihapus</p>
				</div>
			<?php endif; ?>
		</div>
		<div class="row f14">
				<?php 
					$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
					  // Pagination (Perpindahan hal)
						  if (isset($_GET["jdp"])) {
						      $dataTampil = $_GET["jdp"];
						    }else{
						      $dataTampil = 10;
						    }
						  $jdp = (isset($_GET["jdp"])) ? $_GET["jdp"] : 10;
						  $jumlahdataperhal = $dataTampil;
						  $jumlahdata = count(query("SELECT * FROM pelanggan"));
						  $jumlahhal = ceil($jumlahdata / $jumlahdataperhal);
						  $halaktif = (isset($_GET["hal"])) ? $_GET["hal"] : 1;
						  $awaldata = ($jumlahdataperhal * $halaktif) - $jumlahdataperhal;

						  if (isset($_GET["sortAlamatASC"])) {
						  		$sortAlamat = "sortAlamatDESC";
						  		$sortNama = "sortNamaDESC";
						  		$sortEmail = "sortEmailDESC";
						  		$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY alamat ASC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortAlamatDESC"])) {
						  		$sortAlamat = "sortAlamatASC";
						  		$sortNama = "sortNamaASC";
						  		$sortEmail = "sortEmailASC";
						  		$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY alamat DESC LIMIT $awaldata,$jumlahdataperhal");
						  }
						  elseif (isset($_GET["sortEmailDESC"])) {
						  		$sortEmail = "sortEmailASC";
						  		$sortAlamat = "sortAlamatASC";
						  		$sortNama = "sortNamaASC";
						  		$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY email DESC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortEmailASC"])) {
						  		$sortEmail = "sortEmailDESC";
						  		$sortAlamat = "sortAlamatDESC";
						  		$sortNama = "sortNamaDESC";
						  		$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY email ASC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortNamaDESC"])) {
						  		$sortNama = "sortNamaASC";
						  		$sortAlamat = "sortAlamatASC";
						  		$sortEmail = "sortEmailASC";
						  		$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama DESC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortNamaASC"])) {
						  		$sortNama = "sortNamaDESC";
						  		$sortAlamat = "sortAlamatDESC";
						  		$sortEmail = "sortEmailDESC";
						  		$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama ASC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  else{
						  		$sortAlamat = "sortAlamatASC";
						  		$sortEmail = "sortEmailASC";
						  		$sortNama = "sortNamaASC";
						  		$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY id DESC LIMIT $awaldata,$jumlahdataperhal ");
						  }

						  $totalpelanggan = count(query("SELECT * FROM pelanggan"));
				 ?>
				 <ul class="list-unstyled" style="display: flex;">
				 	<li style="margin-right: 30px;">
				 		<form action="" method="GET" class="form-group">
              <input type="hidden" name="page" value="manajemenpelanggan">
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
                       <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=1" class="page-link">
                         &laquo; First
                       </a>
                    </li>
                  <?php endif; ?>
                  <?php if($halaktif > 1 ) : ?>
                    <li class="page-item">
                       <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $halaktif - 1; ?>" class="page-link">
                         &laquo; Prev
                       </a>
                    </li>
                   <?php endif; ?>
                  <!-- Pilihan hal -->
                  <?php if ($halaktif == 1): ?>
                    <?php for($i = max(1, $halaktif - 2); $i <= min($halaktif + 4, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                   <?php elseif ($halaktif == 2): ?>
                    <?php for($i = max(1, $halaktif - 2); $i <= min($halaktif + 3, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                  <?php elseif ($halaktif == $jumlahhal): ?>
                    <?php for($i = max(1, $halaktif - 4); $i <= min($halaktif + 3, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                   <?php elseif ($halaktif == ($jumlahhal - 1)) : ?>
                    <?php for($i = max(1, $halaktif - 3); $i <= min($halaktif + 3, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                  <?php else: ?>
                    <?php for($i = max(1, $halaktif - 2); $i <= min($halaktif + 2, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
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
                       <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $halaktif + 1; ?> " class="page-link">
                         Next &raquo;
                       </a>
                    </li>
                   <?php endif; ?>

                    <?php if($halaktif < $jumlahhal ) : ?>
                      <li class="page-item">
                         <a href="?page=manajemenpelanggan&&jdp=<?= $jdp; ?>&&hal=<?= $jumlahhal; ?> " class="page-link">
                           Last &raquo;
                         </a>
                     </li>
                   <?php endif; ?>
                </ul>
             </nav>
          </li>
				 	<li style="margin-top: 10px;">Menampilkan <?= $dataTampil; ?> dari <?= $totalpelanggan; ?> pelanggan</li>
				 </ul>
				<table class="table table-hover">
					<tr>
						<th>No</th>
						<th>Avatar</th>
						<th><a href="index.php?page=manajemenpelanggan&&<?= $sortNama; ?>">Nama <i class="fa fa-caret-down"></i></a></th>
						<th><a href="index.php?page=manajemenpelanggan&&<?= $sortEmail; ?>">Email <i class="fa fa-caret-down"></i></a></th>
						<th><a href="index.php?page=manajemenpelanggan&&<?= $sortAlamat; ?>">Alamat <i class="fa fa-caret-down"></i></a></th>
						<th>No. Hp</th>
						<th>Aksi</th>
					</tr>
					<?php if ($totalpelanggan > 0): ?>
						<?php $i = (($jdp * $halaktif) - $dataTampil) +1; ?>
						<?php while ($row = mysqli_fetch_assoc($pelanggan)) : ?>
							<tr>
								<td><?= $i ?></td>
								<td><img src="../img/pelanggan/<?php echo $row['avatar']; ?>" style="width: 60px; height: 60px; border-radius: 50%; object-position: center; object-fit: contain; border: solid 1px #333;"></td>
								<td><?php echo $row['nama']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td class="text-capitalize"><?php echo $row['alamat']; ?></td>
								<td><?php echo$row['nohp']; ?></td>
								<td>
									<a href="index.php?page=manajemenpelanggan&&hapus&&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
								</td>
							</tr>
						<?php $i++; ?>
						<?php endwhile; ?>
					<?php else : ?>
						<tr>
							<td>Data pelanggan kosong !</td>
						</tr>
					<?php endif; ?>
				</table>	
		</div>
	</div>
</div>
