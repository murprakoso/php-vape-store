<?php 
	$iduser = $_SESSION['userid'];

	$dataUser = mysqli_query($koneksi, "SELECT * FROM admin WHERE id='$iduser' ");
	if ($row = mysqli_fetch_assoc($dataUser)) {
		$id = $row['id'];
		$username = $row['username'];
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
			$berhasilUbahAvatar = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php?page=pengaturanprofil'>";
		}else{
			$gagalUbahAvatar = true;
		}
	}

 ?>

<div class="section">
	<div class="container">
		<div class="row f14" style="min-height: 50vh; padding: 20px 0;">
			<div class="col-md-12">
				<?php if (isset($berhasilUbahUserPass)) : ?>
					<div class="alert alert-success"> Berhasil ubah username / password</div>
				<?php elseif(isset($gagalUbahUserPass)) : ?>
					<div class="alert alert-danger"> Gagal ubah username / password</div>
				<?php elseif (isset($berhasilUbahAvatar)) : ?>
					<div class="alert alert-success"> Berhasil ubah Avatar</div>
				<?php elseif(isset($gagalUbahAvatar)) : ?>
					<div class="alert alert-danger"> Gagal ubah Avatar</div>
				<?php endif; ?>
			</div>
			<div class="col-md-8">
				<i class="fa fa-edit"></i> Username / Password
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
				<i class="fa fa-edit"></i> Avatar
				<br>
				<br>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group text-center">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="avatarlama" value="<?php echo $avatar; ?>">
						<img id="avatarlama" src="../img/admin/<?php echo $avatar; ?>" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; object-position: top;">
					</div>
					<br>
					<div class="form-group">
						<label for="avatar">Avatar</label>
						<input type="file" accept="image/jpg, image/jpeg, image/png" name="avatar" id="avatar" class="form-control" required onchange="readURLB(this);">
					</div>
					<div class="form-group">
						<input type="submit" name="ubahAvatar" class="btn btn-sm btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>