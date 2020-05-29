<?php 

	include 'function.php';
	$iduser = $_SESSION['userid'];

	$dataUser = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$iduser' ");
	if ($row = mysqli_fetch_assoc($dataUser)) {
		$id = $row['id'];
		$username = $row['username'];
		$nama = $row['nama'];
		$email = $row['email'];
		$alamat = $row['alamat'];
		$nohp = $row['nohp'];
		$norekening = $row['norekening'];
		$avatar = $row['avatar'];
	}

		if (isset($_POST["ubahUserPass"])) {
			if (ubahUserPass($_POST) > 0 ) {
				$berhasilUbahUserPass = true;
				echo "<meta http-equiv='refresh' content='1;URL=logout.php'>";
			}else{
				$gagalUbahUserPass = true;
			}
		}

	if (isset($_POST["ubahAvatar"])) {
		if (ubahAvatar($_POST) > 0 ) {
			$berhasilubahAvatar = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php?page=pengaturan'>";
		}else{
			$gagalubahAvatar = true;
		}
	}

	if (isset($_POST["ubahDataAkun"])) {
		if (ubahDataAkun($_POST) > 0 ) {
			$berhasilubahDataAkun = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php?page=pengaturan'>";
		}else{
			$gagalubahDataAkun = true;
		}
	}


 ?>

<div class="section">
	<div class="container">
		<div class="row f14" style="min-height: 50vh; padding: 20px 0;">
			<div class="col-md-12">
				<?php if (isset($berhasilUbahUserPass)): ?>
				<?php elseif (isset($gagalUbahUserPass)): ?>
				<?php elseif (isset($berhasilubahDataAkun)): ?>
				<?php elseif (isset($gagalubahDataAkun)): ?>
				<?php elseif (isset($berhasilubahAvatar)): ?>
				<?php elseif (isset($gagalubahAvatar)): ?>
				<?php endif; ?>
			</div>
			<div class="col-md-4">
				<i class="fa fa-edit"></i> Username / Password Login
				<br>
				<br>
				<form action="" method="post">
					<div class="form-group">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<label for="username">Username</label>
						<input type="text" name="username" value="<?php echo $username; ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="passwordbaru">Password Baru</label>
						<input type="password" name="passwordbaru" id="passwordbaru" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="konfirmasipassword">Konfirmasi Password</label>
						<input type="password" name="konfirmasipassword" id="passwordbaru" class="form-control" required>
					</div>
					<div class="form-group">
						<input type="submit" name="ubahUserPass" class="btn btn-sm btn-primary" value="Simpan">
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<i class="fa fa-edit"></i> Data Akun
				<br>
				<br>
				<form action="" method="post">
					<div class="form-group">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<label for="nama">Nama</label>
						<input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>" required >
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control" value="<?php echo $alamat; ?>" required>
					</div>
					<div class="form-group">
						<label for="nohp">No HP</label>
						<input type="text" name="nohp" id="nohp" class="form-control" value="<?php echo $nohp; ?>" required>
					</div>
					<div class="form-group">
						<input type="submit" name="ubahDataAkun" class="btn btn-sm btn-primary" value="Simpan">
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<i class="fa fa-edit"></i> Avatar
				<br>
				<br>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group text-center">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="avatarlama" value="<?php echo $avatar; ?>">
						<img id="avatarlama" src="img/pelanggan/<?php echo $avatar; ?>" style="width: 150px; height: 150px; border-radius: 50%;">
					</div>
					<br>
					<div class="form-group">
						<label for="avatar">Avatar</label>
						<input type="file" accept="image/jpg, image/jpeg, image/png" name="avatar" id="avatar" class="form-control" onchange="readURLB(this);" required>
					</div>
					<div class="form-group">
						<input type="submit" name="ubahAvatar" class="btn btn-sm btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>