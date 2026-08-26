<?php require '../config/database.php'; if(session_status()===PHP_SESSION_NONE)session_start(); include '../includes/header.php'; include '../includes/navbar.php'; ?>
<div class="container py-5"><h2 class="mb-4">katalog produk</h2><div class="row g-4">
<?php $stmt=$pdo->query("select p.*,u.name seller_name from products p join users u on p.seller_id=u.id order by p.id"); while($p=$stmt->fetch()): ?>
<div class="col-md-4 col-lg"><div class="card h-100 p-3"><div class="product-img rounded-3 d-flex align-items-center justify-content-center"><i class="bi bi-box-seam display-5 text-primary"></i></div><div class="card-body"><h5><?=htmlspecialchars($p['name'])?></h5><small>penjual: <?=htmlspecialchars($p['seller_name'])?></small><p class="text-primary fw-bold mt-2">rp <?=number_format($p['price'],0,',','.')?></p><p>stok: <?=$p['stock']?></p>
<?php if(!empty($_SESSION['user']) && $_SESSION['user']['role']==='pembeli' && $p['stock']>0): ?><a class="btn btn-primary w-100" href="cart_add.php?id=<?=$p['id']?>">tambah ke keranjang</a><?php else: ?><a class="btn btn-outline-primary w-100" href="../auth/login.php">login untuk membeli</a><?php endif; ?>
</div></div></div>
<?php endwhile; ?></div></div>
<?php include '../includes/footer.php'; ?>
