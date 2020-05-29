<?php 

	if (isset($_POST["tambahproduk"])) {
		if (tambahproduk($_POST) > 0 ) {
			$berhasilTambahProduk = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php?page=produk'>";
		}else{
			$gagalTambahProduk = true;
		}
	}

	if (isset($_POST["ubahproduk"])) {
		if (ubahproduk($_POST) > 0 ) {
			$berhasilUbahProduk = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php?page=produk'>";
		}else{
			$gagalUbahProduk = true;
		}
	}

		if (isset($_GET["hapus"])) {
		if (hapusproduk($_GET) > 0 ) {
			$berhasilHapusProduk = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php?page=produk'>";
		}else{
			$gagalHapusProduk = true;
		}
	}

 ?>

<div class="container-fluid">
	<div class="col-md-12">
		<div class="row">
			<?php if(isset($berhasilTambahProduk)) : ?>
			<div class="alert alert-success d-block">
				<p>Produk baru berhasil ditambahkan</p>
			</div>
			<?php elseif(isset($gagalTambahProduk)) : ?>
				<div class="alert alert-danger d-block">
					<p>Produk gagal ditambahkan, periksa kembali data yang anda masukkan !</p>
				</div>
			<?php elseif(isset($berhasilUbahProduk)) : ?>
			<div class="alert alert-success d-block">
				<p>Data produk berhasil diubah</p>
			</div>
			<?php elseif(isset($gagalUbahProduk)) : ?>
				<div class="alert alert-danger d-block">
					<p>Data produk gagal diubah, periksa kembali data yang anda masukkan !</p>
				</div>
			<?php elseif(isset($berhasilHapusProduk)) : ?>
			<div class="alert alert-success d-block">
				<p>Data produk berhasil dihapus</p>
			</div>
			<?php elseif(isset($gagalHapusProduk)) : ?>
				<div class="alert alert-danger d-block">
					<p>Data produk gagal dihapus</p>
				</div>
			<?php endif; ?>
		</div>
		<div class="row f14">
			<?php if(isset($_GET["tambah"])) : ?>
				<li class="float-left list-unstyled mr-5">
				 <h5>+ Tambah data produk</h5>	
				 </li>
				 <li class="float-right list-unstyled">	
				 <a href="index.php?page=produk" class="btn btn-sm btn-secondary f12"><i class="fa fa-angle-left"></i> Kembali</a>
				 </li>
				<table class="table">
					<form action="" method="post" enctype="multipart/form-data">
						<tr>
							<td><label for="nama">Nama Produk</label></td>
							<td><input type="text" name="nama" id="nama" required="" class="form-control"></td>
						</tr>
						<tr>
							<td><label for="kategori">Kategori</label></td>
							<td>
								<select name="kategori" id="kategori" class="form-control" required="">
									<option value="">--- Pilih Kategori ---</option>
									<option value="mod">MOD</option>
									<option value="kawat">KAWAT</option>
									<option value="kapas">KAPAS</option>
									<option value="liquid">LIQUID</option>
									<option value="alat">ALAT</option>
									<option value="aksesoris">AKSESORIS</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label for="brand">Brand / Merek</label></td>
							<td><input type="text" name="brand" id="brand" class="form-control" required=""></td>
						</tr>
						<tr>
							<td><label for="keterangan">Keterangan</label></td>
							<td><textarea name="keterangan" id="keterangan" cols="100" rows="7" class="form-control"></textarea></td>
						</tr>
						<tr>
							<td><label for="harga">Harga</label></td>
							<td><input type="number" name="harga" class="form-control" id="harga" required=""></td>
						</tr>
						<tr>
							<td><label for="stok">Stok</label></td>
							<td><input type="number" name="stok" class="form-control" id="stok" required=""></td>
						</tr>
						<tr>
							<td><label for="foto">Foto</label></td>
							<td><img id="fotoproduk" src="../img/produk/bgnoimage.png" style="width: 400px; height: 300px; object-fit: contain;"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="file" name="foto" id="foto" required="" onchange="readURLA(this);"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="tambahproduk" class="btn btn-success" value="Simpan" style="width: 200px;"></td>
						</tr>
					</form>
				</table>
			<?php elseif(isset($_GET['ubah'])) : ?>
				<?php 
					$id = $_GET['id'];
					$produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id' ");
					if ($row = mysqli_fetch_assoc($produk)) {
						$nama = $row['nama'];
						$kategori = $row['kategori'];
						$brand = $row['brand'];
						$keterangan = $row['keterangan'];
						$harga = $row['harga'];
						$stok = $row['stok'];
						$foto = $row['foto'];
					}
				 ?>
				 <li class="float-left list-unstyled mr-5">
				 <h5><i class="fa fa-edit"></i> Ubah data produk</h5>	
				 </li>
				 <li class="float-right list-unstyled">	
				 <a href="index.php?page=produk" class="btn btn-sm btn-secondary f12"><i class="fa fa-angle-left"></i> Kembali</a>
				 </li>
				<table class="table">
					<form action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="fotolama" value="<?php echo $foto; ?>">
						<tr>
							<td><label for="nama">Nama Produk</label></td>
							<td><input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" required="" class="form-control"></td>
						</tr>
						<tr>
							<td><label for="kategori">Kategori</label></td>
							<td>
								<select name="kategori" id="kategori" class="form-control" required="">
									<option value="<?php echo $kategori; ?>"><?php echo $kategori; ?></option>
									<option value="mod">MOD</option>
									<option value="kawat">KAWAT</option>
									<option value="kapas">KAPAS</option>
									<option value="liquid">LIQUID</option>
									<option value="alat">ALAT</option>
									<option value="aksesoris">AKSESORIS</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label for="brand">Brand / Merek</label></td>
							<td><input type="text" name="brand" id="brand" class="form-control" value="<?php echo $brand; ?>" required=""></td>
						</tr>
						<tr>
							<td><label for="keterangan">Keterangan</label></td>
							<td><textarea name="keterangan" id="keterangan" cols="100" rows="7" class="form-control"><?php echo $keterangan; ?></textarea></td>
						</tr>
						<tr>
							<td><label for="harga">Harga</label></td>
							<td><input type="number" name="harga" class="form-control" id="harga" value="<?php echo $harga; ?>" required=""></td>
						</tr>
						<tr>
							<td><label for="stok">Stok</label></td>
							<td><input type="number" name="stok" class="form-control" id="stok" required="" value="<?php echo $stok; ?>"></td>
						</tr>
						<tr>
							<td><label for="foto">Foto</label></td>
							<td><img id="fotoproduk" src="../img/produk/<?php echo $foto; ?>" style="width: 400px; height: 300px; object-fit: contain;"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="file" name="foto" id="foto" onchange="readURLA(this);"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="ubahproduk" class="btn btn-success" value="Simpan" style="width: 200px;"></td>
						</tr>
					</form>
				</table>
			<?php else : ?>
				<?php 
					$produk = mysqli_query($koneksi, "SELECT * FROM produk");
					  // Pagination (Perpindahan hal)
						  if (isset($_GET["jdp"])) {
						      $dataTampil = $_GET["jdp"];
						    }else{
						      $dataTampil = 10;
						    }
						  $jdp = (isset($_GET["jdp"])) ? $_GET["jdp"] : 10;
						  $jumlahdataperhal = $dataTampil;
						  $jumlahdata = count(query("SELECT * FROM produk"));
						  $jumlahhal = ceil($jumlahdata / $jumlahdataperhal);
						  $halaktif = (isset($_GET["hal"])) ? $_GET["hal"] : 1;
						  $awaldata = ($jumlahdataperhal * $halaktif) - $jumlahdataperhal;

						  if (isset($_GET["sortBrandASC"])) {
						  		$sortBrand = "sortBrandDESC";
						  		$sortNama = "sortNamaDESC";
						  		$sortKategori = "sortKategoriDESC";
						  		$sortHarga = "sortHargaDESC";
						  		$sortStok = "sortStokDESC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY brand ASC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortBrandDESC"])) {
						  		$sortBrand = "sortBrandASC";
						  		$sortNama = "sortNamaASC";
						  		$sortKategori = "sortKategoriASC";
						  		$sortHarga = "sortHargaASC";
						  		$sortStok = "sortStokASC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY brand DESC LIMIT $awaldata,$jumlahdataperhal");
						  }
						  elseif (isset($_GET["sortKategoriDESC"])) {
						  		$sortKategori = "sortKategoriASC";
						  		$sortBrand = "sortBrandASC";
						  		$sortNama = "sortNamaASC";
						  		$sortHarga = "sortHargaASC";
						  		$sortStok = "sortStokASC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY Kategori DESC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortKategoriASC"])) {
						  		$sortKategori = "sortKategoriDESC";
						  		$sortBrand = "sortBrandDESC";
						  		$sortNama = "sortNamaDESC";
						  		$sortHarga = "sortHargaDESC";
						  		$sortStok = "sortStokDESC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY Kategori ASC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortNamaDESC"])) {
						  		$sortNama = "sortNamaASC";
						  		$sortBrand = "sortBrandASC";
						  		$sortKategori = "sortKategoriASC";
						  		$sortHarga = "sortHargaASC";
						  		$sortStok = "sortStokASC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY nama DESC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortNamaASC"])) {
						  		$sortNama = "sortNamaDESC";
						  		$sortBrand = "sortBrandDESC";
						  		$sortKategori = "sortKategoriDESC";
						  		$sortHarga = "sortHargaDESC";
						  		$sortStok = "sortStokDESC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY nama ASC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortHargaDESC"])) {
						  		$sortNama = "sortNamaASC";
						  		$sortBrand = "sortBrandASC";
						  		$sortKategori = "sortKategoriASC";
						  		$sortHarga = "sortHargaASC";
						  		$sortStok = "sortStokASC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY harga DESC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortHargaASC"])) {
						  		$sortNama = "sortNamaDESC";
						  		$sortBrand = "sortBrandDESC";
						  		$sortKategori = "sortKategoriDESC";
						  		$sortHarga = "sortHargaDESC";
						  		$sortStok = "sortStokDESC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY harga ASC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortStokDESC"])) {
						  		$sortNama = "sortNamaASC";
						  		$sortBrand = "sortBrandASC";
						  		$sortKategori = "sortKategoriASC";
						  		$sortHarga = "sortHargaASC";
						  		$sortStok = "sortStokASC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY stok DESC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  elseif (isset($_GET["sortStokASC"])) {
						  		$sortNama = "sortNamaDESC";
						  		$sortBrand = "sortBrandDESC";
						  		$sortKategori = "sortKategoriDESC";
						  		$sortHarga = "sortHargaDESC";
						  		$sortStok = "sortStokDESC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY stok ASC LIMIT $awaldata,$jumlahdataperhal ");
						  }
						  else{
						  		$sortBrand = "sortBrandASC";
						  		$sortKategori = "sortKategoriASC";
						  		$sortNama = "sortNamaASC";
						  		$sortHarga = "sortHargaASC";
						  		$sortStok = "sortStokASC";
						  		$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC LIMIT $awaldata,$jumlahdataperhal ");
						  }

						  $totalproduk = count(query("SELECT * FROM produk"));
				 ?>
				 <ul class="list-unstyled" style="display: flex;">
				 	<li style="margin: 1px 10px 0 0;"><a href="index.php?page=produk&&tambah" class="btn btn-outline-primary f14">+ Tambah</a></li>
				 	<li style="margin-right: 30px;">
				 		<form action="" method="GET" class="form-group">
              <input type="hidden" name="page" value="produk">
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
                  <?php endif; ?>
                </select>
            </form>
				 	</li>
				 	<!-- Navigasi hal -->
          <li style="margin-top: -10px; margin-right: 50px;">
            <nav aria-label="Page Navigation">
              <ul class="breadcrumb" style="background: transparent;">
                  <?php if($halaktif > 1 ) : ?>
                    <li class="page-item">
                       <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=1" class="page-link">
                         &laquo; First
                       </a>
                    </li>
                  <?php endif; ?>
                  <?php if($halaktif > 1 ) : ?>
                    <li class="page-item">
                       <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $halaktif - 1; ?>" class="page-link">
                         &laquo; Prev
                       </a>
                    </li>
                   <?php endif; ?>
                  <!-- Pilihan hal -->
                  <?php if ($halaktif == 1): ?>
                    <?php for($i = max(1, $halaktif - 2); $i <= min($halaktif + 4, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                   <?php elseif ($halaktif == 2): ?>
                    <?php for($i = max(1, $halaktif - 2); $i <= min($halaktif + 3, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                  <?php elseif ($halaktif == $jumlahhal): ?>
                    <?php for($i = max(1, $halaktif - 4); $i <= min($halaktif + 3, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                   <?php elseif ($halaktif == ($jumlahhal - 1)) : ?>
                    <?php for($i = max(1, $halaktif - 3); $i <= min($halaktif + 3, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endfor; ?>
                  <?php else: ?>
                    <?php for($i = max(1, $halaktif - 2); $i <= min($halaktif + 2, $jumlahhal); $i++ ) : ?> 
                      <?php if($i == $halaktif ) : ?>
                        <li class="page-item active">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
                            <?= $i; ?>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $i; ?>" class="page-link">
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
                       <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $halaktif + 1; ?> " class="page-link">
                         Next &raquo;
                       </a>
                    </li>
                   <?php endif; ?>

                    <?php if($halaktif < $jumlahhal ) : ?>
                      <li class="page-item">
                         <a href="?page=produk&&jdp=<?= $jdp; ?>&&hal=<?= $jumlahhal; ?> " class="page-link">
                           Last &raquo;
                         </a>
                     </li>
                   <?php endif; ?>
                </ul>
             </nav>
          </li>
				 	<li style="margin-top: 10px;">Menampilkan <?= $dataTampil; ?> dari <?= $totalproduk; ?> produk</li>
				 </ul>
				<table class="table table-hover">
					<tr>
						<th>No</th>
						<th>Foto</th>
						<th><a href="index.php?page=produk&&<?= $sortNama; ?>">Nama <i class="fa fa-caret-down"></i></a></th>
						<th><a href="index.php?page=produk&&<?= $sortKategori; ?>">Kategori <i class="fa fa-caret-down"></i></a></th>
						<th><a href="index.php?page=produk&&<?= $sortBrand; ?>">Brand <i class="fa fa-caret-down"></i></a></th>
						<th><a href="index.php?page=produk&&<?= $sortHarga; ?>">Harga <i class="fa fa-caret-down"></i></a></th>
						<th><a href="index.php?page=produk&&<?= $sortStok; ?>">Stok <i class="fa fa-caret-down"></i></a></th>
						<th>Aksi</th>
					</tr>
					<?php if ($totalproduk > 0) : ?>
						<?php $i = (($jdp * $halaktif) - $dataTampil) +1; ?>
						<?php while ($row = mysqli_fetch_assoc($produk)) : ?>
						<tr>
							<td><?= $i ?></td>
							<td><img src="../img/produk/<?php echo $row['foto']; ?>" style="width: 120px; height: 100px; object-position: center; object-fit: contain; border: solid 1px #333; border-radius: 5px;"></td>
							<td><?php echo $row['nama']; ?></td>
							<td class="text-capitalize"><?php echo $row['kategori']; ?></td>
							<td><?php echo $row['brand']; ?></td>
							<td><?php echo rupiah($row['harga']); ?></td>
							<td><?php echo $row['stok']; ?></td>
							<td>
								<a href="index.php?page=produk&&ubah&&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning text-white"><i class="fa fa-edit"></i> Ubah</a>
								<a href="index.php?page=produk&&hapus&&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
							</td>
						</tr>
						<?php $i++; ?>
						<?php endwhile; ?>
					<?php else: ?>
						<tr>
							<td>Data produk kosong !</td>
						</tr>
					<?php endif; ?>
				</table>
			<?php endif; ?>			
		</div>
	</div>
</div>
