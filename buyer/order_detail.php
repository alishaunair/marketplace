<?php
require '../includes/auth.php';
require_login('pembeli');
require '../config/database.php';

$id=(int)($_GET['id']??0);
$stmt=$pdo->prepare("select * from orders where id=? and user_id=?");
$stmt->execute([$id,$_SESSION['user']['id']]);
$order=$stmt->fetch();

if(!$order) die('pesanan tidak ditemukan.');

$stmt=$pdo->prepare("select oi.*,p.name from order_items oi join products p on oi.product_id=p.id where oi.order_id=?");
$stmt->execute([$id]);
$items=$stmt->fetchAll();

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container py-5">
    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h2>detail pesanan #<?=$order['id']?></h2>
            <span class="badge badge-status align-self-start"><?=$order['status']?></span>
        </div>
        <p>tanggal: <?=$order['created_at']?></p>
        <p>alamat: <?=htmlspecialchars($order['address'])?></p>
        <hr>
        <?php foreach($items as $item): ?>
            <div class="d-flex justify-content-between border-bottom py-2">
                <span><?=htmlspecialchars($item['name'])?> × <?=$item['quantity']?></span>
                <span>rp <?=number_format($item['subtotal'],0,',','.')?></span>
            </div>
        <?php endforeach; ?>
        <h4 class="text-end mt-3">total: rp <?=number_format($order['total_price'],0,',','.')?></h4>
        <?php if($order['status']==='menunggu pembayaran'): ?>
            <a href="payment.php?id=<?=$order['id']?>" class="btn btn-primary mt-2">upload bukti pembayaran</a>
        <?php endif; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
