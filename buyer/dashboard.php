<?php require '../includes/auth.php'; require_login('pembeli'); include '../includes/header.php'; include '../includes/navbar.php'; ?>
<div class="container py-5"><h2>dashboard pembeli</h2><p>selamat datang, <?= htmlspecialchars($_SESSION['user']['name']) ?>.</p>
<div class="row g-4 mt-2"><div class="col-md-6"><div class="card p-4"><h4>belanja produk</h4><p>lihat produk dan tambahkan ke keranjang.</p><a href="catalog.php" class="btn btn-primary">lihat katalog</a></div></div><div class="col-md-6"><div class="card p-4"><h4>pesanan saya</h4><p>lihat status pesanan yang dibuat.</p><a href="orders.php" class="btn btn-outline-primary">lihat pesanan</a></div></div></div></div>
<?php include '../includes/footer.php'; ?>
