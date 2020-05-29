<?php 
	include 'function.php';

	$mod = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori='mod' ");
	$totalmod = count(query("SELECT * FROM produk WHERE kategori='mod' "));
	$kawat = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori='kawat' ");
	$totalkawat = count(query("SELECT * FROM produk WHERE kategori='kawat' "));
	$kapas = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori='kapas' ");
	$totalkapas = count(query("SELECT * FROM produk WHERE kategori='kapas' "));
	$liquid = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori='liquid' ");
	$totalliquid = count(query("SELECT * FROM produk WHERE kategori='liquid' "));
	$alat = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori='alat' ");
	$totalalat = count(query("SELECT * FROM produk WHERE kategori='alat' "));
	$aksesoris = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori='aksesoris' ");
	$totalaksesoris = count(query("SELECT * FROM produk WHERE kategori='aksesoris' "));

	if (isset($_POST['masukkanKeranjang'])) {
  	if (!isset($_SESSION['login'])) {
  		header('Location: index.php?page=login');
  		exit;
  	}else{
  		$id_produk = $_POST['id'];
  		$id_pemesan = $_SESSION['userid'];
  		$tanggal = date("Y-m-d");
  		$jumlah = 1;

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

<div class="container-fluid">
	<div class="row" style="background: #333;">
		<div class="col-md-12 col-lg-12 col-xs-12">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    		<div class="carousel-inner" role="listbox">
    			<div class="carousel-item active">
    				<img src="img/slide1.jpg" style="width: 100%; height: 450px; object-fit: contain;" />
    			</div>

    			<div class="carousel-item">
    				<img src="img/slide2.jpg" style="width: 100%; height: 450px; object-fit: contain;" />
    			</div>

    			<div class="carousel-item">
    				<img src="img/slide3.jpg" style="width: 100%; height: 450px; object-fit: contain;" />
    			</div>
    		</div>
    	</div>
		</div>
	</div>
	<!-- /row -->
</div>
<!-- /container -->

				<!-- SECTION -->
		<div class="section">	
			<!-- container -->
			<div class="container">
				<!-- row -->
					<div class="row">
							<div class="col-md-8 f14 col-xs-12 col-lg-8 col-md-8" style="margin-top: 10px;">
									<ul class="section-tab-nav tab-nav">
										<li class="active"><a data-toggle="tab" href="#mod">MOD</a></li>
										<li><a data-toggle="tab" href="#kawat">KAWAT</a></li>
										<li><a data-toggle="tab" href="#kapas">KAPAS</a></li>
										<li><a data-toggle="tab" href="#liquid">LIQUID</a></li>
										<li><a data-toggle="tab" href="#alat">ALAT</a></li>
										<li><a data-toggle="tab" href="#aksesoris">AKSESORIS</a></li>
									</ul>
							</div>
							<div class="col-md-4 col-xs-12">
								<form action="" method="post">
									<div class="form-group">
										<input type="text" name="keyword" id="keyword" placeholder="Cari Produk ..." class="form-control">
										<button type="submit" name="cariProduk" id="cariProduk">Cari</button>
									</div>
								</form>
							</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
				<div class="row" id="dataProduk" style="min-height: 60vh;">
					<div class="col-md-12" >
							<div class="products-tabs">
								<!-- mod -->
								<div id="mod" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<?php if ($totalmod > 0 ): ?>
											<?php while($row = mysqli_fetch_assoc($mod)) : ?>
												<!-- product -->
												<div class="product">
													<div class="product-img">
														<img src="img/produk/<?php echo $row['foto']; ?>">
													</div>
													<div class="product-body">
														<p class="product-category text-uppercase"><?php echo $row['kategori'] ?></p>
														<h3 class="product-name"><a href="index.php?page=detail&&id=<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></a></h3>
														<h4 class="product-price"><?php echo rupiah($row['harga']); ?></h4>
													</div>
													<div class="add-to-cart">
														<form action="" method="post">
															<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															<button type="submit" name="masukkanKeranjang" class="add-to-cart-btn 12">Tambah ke keranjang</button>
														</form>
													</div>
												</div>
												<!-- /product -->
											<?php endwhile; ?>
										<?php else: ?>
											<div class="alert alert-info" style="margin-top: 10vh;">
												Maaf, stok produk dengan kategori MOD telah habis !
											</div>
										<?php endif; ?>
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /mod -->

								<!-- kawat -->
								<div id="kawat" class="tab-pane">
									<div class="products-slick" data-nav="#slick-nav-2">
										<?php if ($totalkawat > 0 ): ?>
											<?php while($row = mysqli_fetch_assoc($kawat)) : ?>
												<!-- product -->
												<div class="product">
													<div class="product-img">
														<img src="img/produk/<?php echo $row['foto']; ?>">
													</div>
													<div class="product-body">
														<p class="product-category text-uppercase"><?php echo $row['kategori']; ?></p>
														<h3 class="product-name">
															<a href="index.php?page=detail&&id=<?php echo $row['id']; ?>">
																<?php echo $row['nama']; ?>
															</a>
														</h3>
														<h4 class="product-price"><?php echo rupiah($row['harga']); ?></h4>
													</div>
													<div class="add-to-cart">
														<form action="" method="post">
															<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															<button type="submit" name="masukkanKeranjang" class="add-to-cart-btn f12">Tambah ke keranjang</button>
														</form>
													</div>
												</div>
												<!-- /product -->
											<?php endwhile; ?>
										<?php else: ?>
											<div class="alert alert-info" style="margin-top: 10vh;">
												Maaf, stok produk dengan kategori KAWAT telah habis !
											</div>
										<?php endif; ?>
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /kawat -->

								<!-- kapas -->
								<div id="kapas" class="tab-pane">
									<div class="products-slick" data-nav="#slick-nav-2">
										<?php if ($totalkapas > 0 ): ?>
											<?php while($row = mysqli_fetch_assoc($kapas)) : ?>
												<!-- product -->
												<div class="product">
													<div class="product-img">
														<img src="img/produk/<?php echo $row['foto']; ?>">
													</div>
													<div class="product-body">
														<p class="product-category text-uppercase"><?php echo $row['kategori']; ?></p>
														<h3 class="product-name">
															<a href="index.php?page=detail&&id=<?php echo $row['id']; ?>">
																<?php echo $row['nama']; ?>
															</a>
														</h3>
														<h4 class="product-price"><?php echo rupiah($row['harga']); ?></h4>
													</div>
													<div class="add-to-cart">
														<form action="" method="post">
															<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															<button type="submit" name="masukkanKeranjang" class="add-to-cart-btn f12">Tambah ke keranjang</button>
														</form>
													</div>
												</div>
												<!-- /product -->
											<?php endwhile; ?>
										<?php else: ?>
											<div class="alert alert-info" style="margin-top: 10vh;">
												Maaf, stok produk dengan kategori KAPAS telah habis !
											</div>
										<?php endif; ?>
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /kapas -->

								<!-- liquid -->
								<div id="liquid" class="tab-pane">
									<div class="products-slick" data-nav="#slick-nav-2">
										<?php if ($totalliquid > 0 ): ?>
											<?php while($row = mysqli_fetch_assoc($liquid)) : ?>
												<!-- product -->
												<div class="product">
													<div class="product-img">
														<img src="img/produk/<?php echo $row['foto']; ?>">
													</div>
													<div class="product-body">
														<p class="product-category text-uppercase"><?php echo $row['kategori']; ?></p>
														<h3 class="product-name">
															<a href="index.php?page=detail&&id=<?php echo $row['id']; ?>">
																<?php echo $row['nama']; ?>
															</a>
														</h3>
														<h4 class="product-price"><?php echo rupiah($row['harga']); ?></h4>
													</div>
													<div class="add-to-cart">
														<form action="" method="post">
															<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															<button type="submit" name="masukkanKeranjang" class="add-to-cart-btn f12">Tambah ke keranjang</button>
														</form>
													</div>
												</div>
												<!-- /product -->
											<?php endwhile; ?>
										<?php else: ?>
											<div class="alert alert-info" style="margin-top: 10vh;">
												Maaf, stok produk dengan kategori LIQUID telah habis !
											</div>
										<?php endif; ?>
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /liquid -->

								<!-- alat -->
								<div id="alat" class="tab-pane">
									<div class="products-slick" data-nav="#slick-nav-2">
										<?php if ($totalalat > 0 ): ?>
											<?php while($row = mysqli_fetch_assoc($alat)) : ?>
												<!-- product -->
												<div class="product">
													<div class="product-img">
														<img src="img/produk/<?php echo $row['foto']; ?>">
													</div>
													<div class="product-body">
														<p class="product-category text-uppercase"><?php echo $row['kategori']; ?></p>
														<h3 class="product-name">
															<a href="index.php?page=detail&&id=<?php echo $row['id']; ?>">
																<?php echo $row['nama']; ?>
															</a>
														</h3>
														<h4 class="product-price"><?php echo rupiah($row['harga']); ?></h4>
													</div>
													<div class="add-to-cart">
														<form action="" method="post">
															<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															<button type="submit" name="masukkanKeranjang" class="add-to-cart-btn f12">Tambah ke keranjang</button>
														</form>
													</div>
												</div>
												<!-- /product -->
											<?php endwhile; ?>
										<?php else: ?>
											<div class="alert alert-info" style="margin-top: 10vh;">
												Maaf, stok produk dengan kategori ALAT telah habis !
											</div>
										<?php endif; ?>
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /alat -->

								<!-- aksesoris -->
								<div id="aksesoris" class="tab-pane">
									<div class="products-slick" data-nav="#slick-nav-2">
										<?php if ($totalaksesoris > 0 ): ?>
											<?php while($row = mysqli_fetch_assoc($aksesoris)) : ?>
												<!-- product -->
												<div class="product">
													<div class="product-img">
														<img src="img/produk/<?php echo $row['foto']; ?>">
													</div>
													<div class="product-body">
														<p class="product-category text-uppercase"><?php echo $row['kategori']; ?></p>
														<h3 class="product-name">
															<a href="index.php?page=detail&&id=<?php echo $row['id']; ?>">
																<?php echo $row['nama']; ?>
															</a>
														</h3>
														<h4 class="product-price"><?php echo rupiah($row['harga']); ?></h4>
													</div>
													<div class="add-to-cart">
														<form action="" method="post">
															<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															<button type="submit" name="masukkanKeranjang" class="add-to-cart-btn f12">Tambah ke keranjang</button>
														</form>
													</div>
												</div>
												<!-- /product -->
											<?php endwhile; ?>
										<?php else: ?>
											<div class="alert alert-info" style="margin-top: 10vh;">
												Maaf, stok produk dengan kategori AKSESORIS telah habis !
											</div>
										<?php endif; ?>
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /aksesoris -->

							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

