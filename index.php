<?php include 'includes/header.php'; include 'includes/navbar.php'; ?>
<section class="hero">
<div class="container">
<div class="row align-items-center g-5">
<div class="col-lg-6">
<span class="badge badge-status mb-3">marketplace produk pertanian</span>
<h1>temukan produk pertanian berkualitas</h1>
<p class="lead">belanja produk pertanian dari penjual terpercaya dengan mudah dan praktis.</p>
<a href="/marketplace/buyer/catalog.php" class="btn btn-primary me-2">lihat katalog</a>
<a href="/marketplace/auth/register.php" class="btn btn-outline-primary">daftar sekarang</a>
</div>
<div class="col-lg-6"><div class="bg-white rounded-4 p-5 text-center"><i class="bi bi-basket2-fill display-1 text-primary"></i><h3 class="mt-3">produk pilihan untuk kebutuhanmu</h3></div></div>
</div>
</div>
</section>
<section class="section bg-white">
<div class="container"><h2 class="text-center mb-4">produk unggulan</h2>
<div class="row g-4">
<?php
require 'config/database.php';
$stmt=$pdo->query("select * from products order by id limit 5");
while($p=$stmt->fetch()):
?>
<div class="col-md-4 col-lg">
<div class="card h-100 p-3">
<div class="product-img rounded-3 d-flex align-items-center justify-content-center"><i class="bi bi-box-seam display-5 text-primary"></i></div>
<div class="card-body"><h5><?= htmlspecialchars($p['name']) ?></h5><p class="text-primary fw-bold">rp <?= number_format($p['price'],0,',','.') ?></p><a href="/marketplace/buyer/catalog.php" class="btn btn-primary btn-sm">lihat produk</a></div>
</div>
</div>
<?php endwhile; ?>
</div></div></section>
<?php include 'includes/footer.php'; ?>
