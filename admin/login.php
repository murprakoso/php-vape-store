<?php 
	if (!isset($_SESSION)) {
		session_start();
	}
	
	require "function.php";
	// cek session
  if (isset($_SESSION["loginAdmin"])) {
    header("Location: index.php");
    exit;
  }
	  
 if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE username ='$username' ");
    if (mysqli_num_rows($result) === 1 ) {
      $row = mysqli_fetch_assoc($result);
      if(password_verify($password, $row["password"]) ){
        	// set session
        	$_SESSION['loginAdmin'] = true;
				  $_SESSION['userid'] = $row["id"];
				  header("Location:index.php");
				  exit;
      }
    }
    $error = true;
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Ohanna Vape</title>
    <link rel="icon" href="../img/icon.png">
     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
			<div class="container-fluid">
				<div class="row f15" style="min-height: 80vh; padding: 20vh 0;">
					<div class="col-md-4 offset-4">
						<h4 class="text-center">LOGIN ADMIN</h4>
						<p class="text-center">Ohanna Vape Store</p>
						<?php if(isset($error)) : ?>
							<div class="alert alert-danger">
								<p>Username atau password salah !</p>
							</div>
						<?php endif; ?>
						<br>
						<table class="table-condensed table border-0">
							<form action="" method="post">
							<tr>
								<td>Username</td>
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
					</div>
				</div>
			</div>
	</body>
</html>