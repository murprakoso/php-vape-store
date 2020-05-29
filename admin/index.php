<?php 
    session_start();
    include 'function.php';

    if (!isset($_SESSION['loginAdmin'])) {
        header("Location: login.php");
        exit;
    }else{
        $userid = $_SESSION['userid'];
        $dataAdmin = mysqli_query($koneksi, "SELECT * FROM admin WHERE id=$userid ");
        if ($row = mysqli_fetch_assoc($dataAdmin)) {
            $avatar = $row['avatar'];
            $username = $row['username'];
        }
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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fontawesome/css/font-awesome.css">
    </head>
    <body>

       <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img src="../img/admin/<?= $avatar; ?>" class="rounded-circle" style="width: 50%; height: 50%; margin: 10px 50px; border: 3px solid #333; padding: 1px; object-fit: cover; object-position: top;">
                    <h3 class="text-center text-capitalize"><?= $username ?></h3>
                </div>

                <ul class="list-unstyled components f14">
                    <?php if(isset($_GET['page'])) : ?>
                     <li>
                        <a href="index.php">Beranda</a>
                    </li>
                    <li <?php if($_GET['page'] == 'produk') {echo "class='active' ";} ?>>
                        <a href="index.php?page=produk">Produk</a>
                    </li>
                    <li <?php if($_GET['page'] == 'pesanan') {echo "class='active' ";} ?>>
                        <a href="index.php?page=pesanan">Pesanan</a>
                    </li>
                    <li <?php if($_GET['page'] == 'manajemenpelanggan') {echo "class='active' ";} ?>>
                        <a href="index.php?page=manajemenpelanggan">Pelanggan</a>
                    </li>
                    <li <?php if($_GET['page'] == 'pengaturanprofil') {echo "class='active' ";} ?>>
                        <a href="index.php?page=pengaturanprofil">Pengaturan</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                    <?php else : ?>
                    <li class="active">
                        <a href="index.php">Beranda</a>
                    </li>
                    <li>
                        <a href="index.php?page=produk">Produk</a>
                    </li>
                    <li>
                        <a href="index.php?page=pesanan">Pesanan</a>
                    </li>
                    <li>
                        <a href="index.php?page=manajemenpelanggan">Pelanggan</a>
                    </li>
                    <li>
                        <a href="index.php?page=pengaturanprofil">Pengaturan</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="fa fa-bars"></i>
                                <span></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <?php include 'konten.php'; ?>
            </div>
        </div>

         <script type="text/javascript" src="js/bootstrap.min.js"></script>
         <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
         <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>
