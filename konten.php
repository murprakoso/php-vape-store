<?php
		if (isset($_GET['page'])){
		  $page = $_GET['page'];
		  switch ($page) {
		    case 'beranda':
		    include "beranda.php";
		    break;
		    case 'produk':
		    include "konten/produk.php";
		    break;
		    case 'keranjang':
		    include "konten/keranjang.php";
		    break;
		    case 'konfirmasi':
		    include "konten/konfirmasi.php";
		    break;
		    case 'historypesanan':
		    include "konten/historypesanan.php";
		    break; 
		    case 'pembayaran':
		    include "konten/pembayaran.php";
		    break;
		    case 'uploadbuktipembayaran':
		    include "konten/uploadbuktipembayaran.php";
		    break;
		    case 'detail':
		    include "konten/detail.php";
		    break;
		    case 'daftar':
		    include "daftar.php";
		    break;
		    case 'login':
		    include "login.php";
		    break;
		    case 'tentang':
		    include "konten/tentang.php";
		    break;
		    case 'kontak':
		    include "konten/kontak.php";
		    break;
		    case 'pengaturan':
		    include "konten/pengaturanAkun.php";
		    break;

		    default:
		    echo "<br><br><center><p style='margin-top: 15vh;' class='font-weight-bold f30'>Error 404</p></center>";
		    echo "<br><br><center><p style='min-height: 30vh;' class='font-weight-bold'>Maaf, halaman tidak di temukan !</p></center>";
		    break;
		  }
		}else {
		  include 'beranda.php';
		}
?>
