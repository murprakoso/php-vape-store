<?php
  require "../function.php";
  $keyword = $_GET["keyword"];
  
  $query = "SELECT * FROM produk WHERE
                nama LIKE '%$keyword%' OR kategori LIKE '%$keyword%'
                 ORDER BY id DESC
              ";
  $dataProduk = query($query);

?>

<?php foreach ($dataProduk as $row) : ?>
    <div class="col-md-3 col-xs-4">
      <!-- product -->
      <div class="product">
        <div class="product-img">
          <img src="img/produk/<?php echo $row['foto']; ?>">
        </div>
        <div class="product-body">
          <p class="product-category text-uppercase"><?php echo $row['kategori'] ?></p>
          <h3 class="product-name"><a href="index.php?page=detail&&id=<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></a></h3>
          <h4 class="product-price"><?php echo rupiah($row['harga']); ?></h4>
        </div>
        <div class="add-to-cart">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="masukkanKeranjang" class="add-to-cart-btn 12">Tambah ke keranjang</button>
          </form>
        </div>
      </div>
      <!-- /product -->
    </div>
<?php endforeach; ?>