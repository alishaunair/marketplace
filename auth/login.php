<?php include '../includes/header.php'; include '../includes/navbar.php'; ?>
<div class="container py-5"><div class="row justify-content-center"><div class="col-md-5"><div class="card p-4">
<h2 class="mb-4">masuk ke agriconnect</h2>
<?php if(isset($_GET['error'])): ?><div class="alert alert-danger">username/email atau password salah.</div><?php endif; ?>
<form method="post" action="login_process.php">
<input class="form-control mb-3" name="login" placeholder="email / username" required>
<input class="form-control mb-3" type="password" name="password" placeholder="password" required>
<button class="btn btn-primary w-100">login</button>
</form>
<p class="mt-3 mb-0">belum punya akun? <a href="register.php">daftar</a></p>
</div></div></div></div>
<?php include '../includes/footer.php'; ?>
