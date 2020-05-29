<?php 

	include '../koneksi.php';

	function query($query){
      global $koneksi;
      $result = mysqli_query($koneksi, $query);
      $rows = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
      }
      return $rows;
    }

  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
  }
	
	function tambahproduk(){
		global $koneksi;
		$nama = $_POST['nama'];
		$kategori = $_POST['kategori'];
		$brand = $_POST['brand'];
		$keterangan = $_POST['keterangan'];
		$harga = $_POST['harga'];
		$stok = $_POST['stok'];

		// upload foto produk
    $fotoproduk = uploadfotoproduk();
    if (!$fotoproduk) {
      return false;
    }

		mysqli_query($koneksi, "INSERT INTO produk VALUES ('','$nama','$kategori','$brand','$keterangan','$harga','$stok','$fotoproduk')");
		return mysqli_affected_rows($koneksi);
	}

  function ubahproduk(){
      global $koneksi;
      $id = $_GET["id"];
      $nama = $_POST["nama"];
      $kategori = $_POST["kategori"];
      $brand = $_POST["brand"];
      $keterangan = $_POST["keterangan"];
      $harga =$_POST["harga"];
      $stok = $_POST["stok"];
      $fotoproduklama = $_POST["fotolama"];
       // cek apakah user pilih gambar baru atau tidak

        if ($_FILES['foto']['error'] === 4 ) {
          $fotoproduk = $fotoproduklama;
        }else {
          $fotoproduk = uploadfotoproduk();
          // Hapus foto lama
          $carifotoproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id' ");
          if($hasilfotoproduk = mysqli_fetch_assoc($carifotoproduk)){
            $hapusfotoproduk = $hasilfotoproduk["foto"];
          }
          unlink( "../img/produk/".$hapusfotoproduk);
        }

        $ubahproduk = mysqli_query($koneksi, "UPDATE produk SET nama='$nama', kategori='$kategori', brand='$brand', keterangan='$keterangan', harga='$harga', stok='$stok', foto='$fotoproduk'  WHERE id='$id' ");
        return mysqli_affected_rows($koneksi); 
    }

    function hapusproduk(){
      global $koneksi;
      $id = $_GET["id"];

      // Hapus foto lama
      $carifotoproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id' ");
      if($hasilfotoproduk = mysqli_fetch_assoc($carifotoproduk)){
        $hapusfotoproduk = $hasilfotoproduk["foto"];
      }
      unlink( "../img/produk/".$hapusfotoproduk);

        $hapusproduk = mysqli_query($koneksi, "DELETE FROM produk WHERE id='$id' ");
        return mysqli_affected_rows($koneksi); 
    }

    function hapusPesanan(){
      global $koneksi;
      $id = $_GET["id"];
      
      $hapuspesanan = mysqli_query($koneksi, "DELETE FROM pesanan WHERE id='$id' ");
      return mysqli_affected_rows($koneksi); 
    }


	function uploadfotoproduk(){
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4 ) {
      echo "<script>
                alert('Silahkan pilih foto terlebih dahulu ! ');
              </script>
              ";
      return false;
    }

    // cek apakah yang akan diupload adalah gambar
    $ekstensifotovalid = ['jpg','jpeg','png'];
    $ekstensifoto = explode('.',$namafile);
    $ekstensifoto = strtolower(end($ekstensifoto));

    if (!in_array($ekstensifoto,$ekstensifotovalid)) {
      echo "<script>
                alert('File yang anda pilih bukan foto ! ');
              </script>
              ";
      return false;
    }

    // generate nama file agar unik
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensifoto;

    move_uploaded_file($tmpname, '../img/produk/'.$namafilebaru);
    return $namafilebaru;

  }

  function ubahUserPass(){
      global $koneksi;
      $id = $_POST["id"];
      $username = strtolower(stripslashes($_POST["username"]));
      $passwordbaru = $_POST["passwordbaru"];
      $konfirmasipassword = $_POST["konfirmasipassword"];

      if ($passwordbaru != $konfirmasipassword) {
         echo "<script>
                    alert('Password tidak sesuai dengan konfirmasi ! ');
                  </script>
                  ";
          return false;
      }
      
      $passwordbaruhash = password_hash($passwordbaru, PASSWORD_DEFAULT);

      $ubah = mysqli_query($koneksi, "UPDATE admin SET username='$username', password='$passwordbaruhash' WHERE id='$id' ");
        return mysqli_affected_rows($koneksi); 
  }

    function ubahAvatar(){
      global $koneksi;
      $id = $_POST["id"];
      $avatarlama = $_POST["avatarlama"];
       // cek apakah user pilih gambar baru atau tidak

        if ($_FILES['avatar']['error'] === 4 ) {
          $avatar = $avatarlama;
        }else {
          $avatar = uploadAvatar();
          // Hapus foto lama
          $cariavatar = mysqli_query($koneksi, "SELECT * FROM admin WHERE id='$id' ");
          if($hasilavatar = mysqli_fetch_assoc($cariavatar)){
            $hapusavatar = $hasilavatar["avatar"];
          }
          unlink( "../img/admin/".$hapusavatar);
        }

        $ubah = mysqli_query($koneksi, "UPDATE admin SET avatar='$avatar' WHERE id='$id' ");
        return mysqli_affected_rows($koneksi); 
    }

    function uploadAvatar(){
    $namafile = $_FILES['avatar']['name'];
    $ukuranfile = $_FILES['avatar']['size'];
    $error = $_FILES['avatar']['error'];
    $tmpname = $_FILES['avatar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4 ) {
      echo "<script>
                alert('Silahkan pilih avatar terlebih dahulu ! ');
              </script>
              ";
      return false;
    }

    // cek apakah yang akan diupload adalah gambar
    $ekstensiavatarvalid = ['jpg','jpeg','png'];
    $ekstensiavatar = explode('.',$namafile);
    $ekstensiavatar = strtolower(end($ekstensiavatar));

    if (!in_array($ekstensiavatar,$ekstensiavatarvalid)) {
      echo "<script>
                alert('File yang anda pilih bukan avatar ! ');
              </script>
              ";
      return false;
    }

    // generate nama file agar unik
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensiavatar;

    move_uploaded_file($tmpname, '../img/admin/'.$namafilebaru);
    return $namafilebaru;

  }



 ?>