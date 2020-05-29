<?php 

	include 'koneksi.php';

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
	
	function daftar(){
		global $koneksi;
		$username = strtolower(stripslashes($_POST['username']));
		$email = $_POST['email'];
		$password = mysqli_real_escape_string($koneksi,$_POST['password']);
		$konfirmasipassword = mysqli_real_escape_string($koneksi,$_POST['konfirmasipassword']);
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$nohp = $_POST['nohp'];

		// cek username sudah ada atau belum
        $datausername = mysqli_query($koneksi, "SELECT username FROM pelanggan WHERE username='$username' ");
        if(mysqli_fetch_assoc($datausername)){
          echo "<script>
                    alert('Username sudah terdaftar, silahkan menggunakan username lain ! ');
                  </script>";
                  return false;
        }
        $dataemail = mysqli_query($koneksi, "SELECT email FROM pelanggan WHERE email='$email' ");
        if(mysqli_fetch_assoc($dataemail)){
          echo "<script>
                    alert('Email sudah terdaftar, silahkan menggunakan email lain ! ');
                  </script>";
                  return false;
        }
        if ($password !== $konfirmasipassword) {
          echo "<script>
                    alert('Password tidak sesuai dengan konfirmasi ! ');
                  </script>";
          return false;
        }
		// upload avatar
    $avatar = uploadavatar();
    if (!$avatar) {
      return false;
    }
		 // enkripsi password
      $password = password_hash($password, PASSWORD_DEFAULT);

		mysqli_query($koneksi, "INSERT INTO pelanggan VALUES ('','$username','$email','$password','$nama','$alamat','$nohp','$avatar')");
		return mysqli_affected_rows($koneksi);
	}

	function uploadavatar(){
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

    move_uploaded_file($tmpname, 'img/pelanggan/'.$namafilebaru);
    return $namafilebaru;

  }

  function konfirmasiPesanan(){
    global $koneksi;
    $userid = $_POST['userid'];
    $id_transaksi = $_POST['id_transaksi'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kodepos = $_POST['kodepos'];
    $nohp = $_POST['nohp'];
    $bank = $_POST['bank'];
    $jasapengiriman = $_POST['jasapengiriman'];
    $status = "Belum dibayar";

    $dataKeranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pemesan='$userid' ");
    while($row = mysqli_fetch_assoc($dataKeranjang)){
      $id_produk = $row['id_produk'];
      $dataProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id_produk' ");
      if ($dp = mysqli_fetch_assoc($dataProduk)) {
        $harga = $dp['harga'];
      }
      $jumlah_produk = $row['jumlah'];
      $subtotal = ($jumlah_produk * $harga);
      mysqli_query($koneksi, "INSERT INTO pesanan VALUES ('','$userid','$id_produk','$id_transaksi','$tanggal','$waktu', '$jumlah_produk', '$subtotal','$alamat', '$kodepos', '$bank', '$jasapengiriman','$status','')");
    }

    mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_pemesan='$userid' ");
    return mysqli_affected_rows($koneksi);
  }

  function uploadBuktiPembayaran(){
    global $koneksi;
    $id_transaksi = $_POST['id_transaksi'];
    // upload bukti pembayaran
    $buktipembayaran = uploadFotoBuktiPembayaran();
    if (!$buktipembayaran) {
      return false;
    }

    mysqli_query($koneksi, "UPDATE pesanan SET buktipembayaran='$buktipembayaran', status='Pengiriman' WHERE id_transaksi='$id_transaksi' ");
    return mysqli_affected_rows($koneksi);
  }

    function cariProduk($keyword) {
       $query = "SELECT * FROM produk WHERE
                      nama LIKE '%$keyword%' OR 
                      kategori LIKE '%$keyword%'
                       ORDER BY id DESC
                    ";
        return query($query);
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

      $ubah = mysqli_query($koneksi, "UPDATE pelanggan SET username='$username', password='$passwordbaruhash' WHERE id='$id' ");
        return mysqli_affected_rows($koneksi); 
  }

   function ubahDataAkun(){
      global $koneksi;
      $id = $_POST["id"];
      $nama = $_POST["nama"];
      $email = $_POST["email"];
      $alamat = $_POST["alamat"];
      $nohp = $_POST["nohp"];
      $ubah = mysqli_query($koneksi, "UPDATE pelanggan SET nama='$nama', email='$email', alamat='$alamat', nohp='$nohp' WHERE id='$id' ");
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
          $avatar = uploadAvatarBaru();
          // Hapus foto lama
          $cariavatar = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id' ");
          if($hasilavatar = mysqli_fetch_assoc($cariavatar)){
            $hapusavatar = $hasilavatar["avatar"];
          }
          unlink( "img/pelanggan/".$hapusavatar);
        }

        $ubah = mysqli_query($koneksi, "UPDATE pelanggan SET avatar='$avatar' WHERE id='$id' ");
        return mysqli_affected_rows($koneksi); 
    }

  function uploadAvatarBaru(){
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

    move_uploaded_file($tmpname, 'img/pelanggan/'.$namafilebaru);
    return $namafilebaru;

  }

    function uploadFotoBuktiPembayaran(){
    $namafile = $_FILES['buktipembayaran']['name'];
    $ukuranfile = $_FILES['buktipembayaran']['size'];
    $error = $_FILES['buktipembayaran']['error'];
    $tmpname = $_FILES['buktipembayaran']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4 ) {
      echo "<script>
                alert('Silahkan pilih foto terlebih dahulu ! ');
              </script>
              ";
      return false;
    }

    // cek apakah yang akan diupload adalah gambar
    $ekstensibuktipembayaranvalid = ['jpg','jpeg','png'];
    $ekstensibuktipembayaran = explode('.',$namafile);
    $ekstensibuktipembayaran = strtolower(end($ekstensibuktipembayaran));

    if (!in_array($ekstensibuktipembayaran,$ekstensibuktipembayaranvalid)) {
      echo "<script>
                alert('File yang anda pilih bukan foto ! ');
              </script>
              ";
      return false;
    }

    // generate nama file agar unik
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensibuktipembayaran;

    move_uploaded_file($tmpname, 'img/buktipembayaran/'.$namafilebaru);
    return $namafilebaru;

  }




 ?>