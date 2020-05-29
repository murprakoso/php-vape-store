<?php 
	
	include 'function.php';

	if (isset($_POST["daftar"])) {
		if (daftar($_POST) > 0 ) {
			$berhasilDaftar = true;
			echo "<meta http-equiv='refresh' content='1;URL=index.php?page=login'>";
		}else{
			$gagalDaftar = true;
		}
	}

 ?>


<div class="container-fluid">
	<div class="row f14" style="margin: 50px 0; min-height: 60vh;">
		<div class="col-md-4 col-xs-4 offset-4">
			<h4 class="text-center">Daftar</h4>
 			<?php if(isset($berhasilDaftar)) : ?>
 				<div class="alert alert-success">
 					<p>Selamat, anda berhasil mendaftar. Silahkan login menggunakan akun anda !</p>
 				</div>
 			<?php elseif(isset($gagalDaftar)) : ?>
 				<div class="alert alert-danger">
 					<p>Maaf, anda gagal mendaftar. Mohon periksa kembali data yang anda masukkan !</p>
 				</div>
 			<?php endif; ?>
			<br>
				<table class="table ">
					<form action="" method="post" enctype="multipart/form-data">
					<tr>
						<td>Nama Lengkap</td>
						
						<td><input type="text" name="nama" placeholder="Masukkan nama lengkap ..." class="form-control f13" required=""></td>
					</tr>
					<tr>
						<td>Username</td>
						
						<td><input type="text" name="username" placeholder="Masukkan username ..." class="form-control f13" required=""></td>
					</tr>
					<tr>
						<td>Email</td>
						
						<td><input type="email" name="email" placeholder="Masukkan email ..." required="" class="form-control f13"></td>
					</tr>
					<tr>
						<td>Password</td>
						
						<td><input type="password" name="password" placeholder="Masukkan password ..." class="form-control f13" required=""></td>
					</tr>
					<tr>
						<td>Konfirmasi Password</td>
						
						<td><input type="password" name="konfirmasipassword" placeholder="Masukkan ulang password ..." class="form-control f13" required=""></td>
					</tr>
					<tr>
						<td>Alamat</td>
						
						<td><input type="text" name="alamat" placeholder="Masukkan alamat ..." required="" class="form-control f13"></td>
					</tr>
					<tr>
						<td>No. Handphone</td>
						
						<td><input type="text" name="nohp" placeholder="Masukkan nomor HP ..." class="form-control f13" required=""></td>
					</tr>
					<tr>
						<td>Avatar</td>
						
						<td><img src="img/noimg.png" id="avatar" style="width: 100px; height: 100px; object-fit: cover; object-position: top; border: 1px solid #333; border-radius: 50%;"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="file" name="avatar" accept="image/jpg, image/jpeg, image/png" onchange="readURLA(this);"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="daftar" class="btn btn-block btn-primary" value="Daftar"></input>
						</td>
					</tr>
				</form>
			</table>
			<br><br>
			Sudah punya akun ? silahkan <a href="index.php?page=login"><b>Masuk</b></a> !
		</div>
	</div>
</div>
