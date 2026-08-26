<?php require '../includes/auth.php'; require_login('penjual'); require '../config/database.php'; include '../includes/header.php'; include '../includes/navbar.php';
$pc=$pdo->prepare("select count(*) from products where seller_id=?");$pc->execute([$_SESSION['user']['id']]);$products=$pc->fetchColumn();
?>
<div class="container py-5"><h2>dashboard penjual</h2><p>selamat datang, <?=htmlspecialchars($_SESSION['user']['name'])?>.</p><div class="row g-4 mt-2"><div class="col-md-4"><div class="card p-4"><h5>total produk</h5><h2><?=$products?></h2></div></div><div class="col-md-4"><div class="card p-4"><h5>kelola katalog</h5><a href="products.php" class="btn btn-primary">kelola produk</a></div></div><div class="col-md-4"><div class="card p-4"><h5>pesanan masuk</h5><a href="orders.php" class="btn btn-primary">lihat pesanan</a></div></div></div></div>
<?php include '../includes/footer.php'; ?>
