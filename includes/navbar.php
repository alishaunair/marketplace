<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
<div class="container">
<a class="navbar-brand fw-bold text-primary" href="/marketplace/">agriconnect</a>
<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">☰</button>
<div class="collapse navbar-collapse" id="nav">
<ul class="navbar-nav ms-auto align-items-lg-center">
<li class="nav-item"><a class="nav-link" href="/marketplace/">beranda</a></li>
<li class="nav-item"><a class="nav-link" href="/marketplace/buyer/catalog.php">katalog</a></li>
<?php if (!empty($_SESSION['user'])): ?>
    <?php if ($_SESSION['user']['role'] === 'pembeli'): ?>
        <li class="nav-item"><a class="nav-link" href="/marketplace/buyer/cart.php">keranjang</a></li>
        <li class="nav-item"><a class="nav-link" href="/marketplace/buyer/orders.php">pesanan</a></li>
    <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="/marketplace/seller/products.php">produk</a></li>
        <li class="nav-item"><a class="nav-link" href="/marketplace/seller/orders.php">pesanan</a></li>
    <?php endif; ?>
    <li class="nav-item ms-lg-2"><a class="btn btn-primary btn-sm" href="/marketplace/auth/logout.php">logout</a></li>
<?php else: ?>
    <li class="nav-item"><a class="nav-link" href="/marketplace/auth/login.php">login</a></li>
    <li class="nav-item"><a class="btn btn-primary btn-sm ms-lg-2" href="/marketplace/auth/register.php">daftar</a></li>
<?php endif; ?>
</ul>
</div>
</div>
</nav>
