<?php require '../config/database.php'; include '../includes/header.php'; include '../includes/navbar.php'; ?>
<div class="container py-5"><div class="row justify-content-center"><div class="col-md-7"><div class="card p-4">
<h2 class="mb-4">daftar akun</h2>
<?php if(isset($_GET['success'])): ?><div class="alert alert-success">pendaftaran berhasil, silakan login.</div><?php endif; ?>
<form method="post" action="register_process.php">
<input class="form-control mb-3" name="name" placeholder="nama lengkap" required>
<input class="form-control mb-3" name="username" placeholder="username" required>
<input class="form-control mb-3" type="email" name="email" placeholder="email" required>
<input class="form-control mb-3" type="password" name="password" placeholder="password" required>
<select class="form-select mb-3" name="role" required><option value="">daftar sebagai</option><option value="pembeli">pembeli</option><option value="penjual">penjual</option></select>
<button class="btn btn-primary w-100">daftar</button>
</form>
<p class="mt-3 mb-0">sudah punya akun? <a href="login.php">login</a></p>
</div></div></div></div>
<?php include '../includes/footer.php'; ?>
