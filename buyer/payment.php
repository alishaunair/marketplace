<?php require '../includes/auth.php'; require_login('pembeli'); require '../config/database.php'; include '../includes/header.php'; include '../includes/navbar.php';
$id=(int)$_GET['id'];$stmt=$pdo->prepare("select * from orders where id=? and user_id=?");$stmt->execute([$id,$_SESSION['user']['id']]);$o=$stmt->fetch();
if(!$o)die('pesanan tidak ditemukan');
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_FILES['proof']) && $_FILES['proof']['error']===0){$dir=__DIR__.'/../uploads/';if(!is_dir($dir))mkdir($dir,0777,true);$ext=strtolower(pathinfo($_FILES['proof']['name'],PATHINFO_EXTENSION));$name='proof_'.$id.'_'.time().'.'.$ext;move_uploaded_file($_FILES['proof']['tmp_name'],$dir.$name);$pdo->prepare("update orders set payment_proof=?,status='menunggu verifikasi' where id=?")->execute([$name,$id]);header("location: orders.php");exit;}
?>
<div class="container py-5"><div class="card p-4"><h2>pesanan #<?=$id?></h2><p>total pembayaran: <b>rp <?=number_format($o['total_price'],0,',','.')?></b></p><p>status: <span class="badge badge-status"><?=$o['status']?></span></p><form method="post" enctype="multipart/form-data"><label class="form-label">upload bukti pembayaran</label><input type="file" name="proof" class="form-control mb-3" required><button class="btn btn-primary">upload bukti pembayaran</button></form></div></div>
<?php include '../includes/footer.php'; ?>
