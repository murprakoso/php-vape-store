<?php
		if (isset($_GET['page'])){
		  $page = $_GET['page'];
		  switch ($page) {
		    case 'beranda':
		    include "konten/beranda.php";
		    break;
		    case 'produk':
		    include "konten/produk.php";
		    break;
		    case 'pesanan':
		    include "konten/pesanan.php";
		    break;
		    case 'manajemenpelanggan':
		    include "konten/manajemenpelanggan.php";
		    break;
		    case 'pengaturanprofil':
		    include "konten/pengaturanprofil.php";
		    break;

		    default:
		    echo "<br><br><center><h4>Halaman tidak di temukan !</h4></center>";
		    break;
		  }
		}else {
		  include 'konten/beranda.php';
		}
?>
