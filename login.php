<?php 
	if (!isset($_SESSION)) {
		session_start();
	}
	require "function.php";
	// cek session
  if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
  }
	  
 if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username ='$username' OR email='$username' ");
    if (mysqli_num_rows($result) === 1 ) {
      $row = mysqli_fetch_assoc($result);
      if(password_verify($password, $row["password"]) ){
        	// set session
        	$_SESSION['login'] = true;
				  $_SESSION['userid'] = $row["id"];
				  header("Location:index.php");
				  exit;
      }
    }
    $error = true;
  }

 ?>

<div class="container-fluid">
	<div class="row f14" style="min-height: 70vh; padding: 50px 0;">
		<div class="col-md-4 offset-4">
			<h4 class="text-center">LOGIN</h4>
			<?php if(isset($error)) : ?>
				<div class="alert alert-danger">
					<p>Username atau password salah !</p>
				</div>
			<?php endif; ?>
			<br>
			<table class="table-condensed table border-0">
				<form action="" method="post">
				<tr>
					<td>Email / Username</td>
					<td>:</td>
					<td><input type="text" name="username" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td><input type="password" name="password" class="form-control" required></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input type="submit" name="login" value="Masuk" class="btn btn-block btn-primary"></td>
				</tr>
				</form>
			</table>
			<br><br>
			Belum memiliki akun, silahkan <a href="index.php?page=daftar"><b>Daftar</b></a> terlebih dahulu !
		</div>
	</div>
</div>