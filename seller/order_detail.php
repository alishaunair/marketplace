<?php
require '../includes/auth.php'; require_login('penjual'); require '../config/database.php';$id=(int)$_GET['id'];
if(isset($_GET['action'])){$status=$_GET['action']==='terima'?'diproses':($_GET['action']==='selesai'?'selesai':'ditolak');$pdo->prepare("update orders set status=? where id=?")->execute([$status,$id]);header("location: order_detail.php?id=$id");exit;}
$s=$pdo->prepare("select o.*,u.name buyer,u.email from orders o join users u on o.user_id=u.id where o.id=?");$s->execute([$id]);$o=$s->fetch();if(!$o)die('order tidak ditemukan');
include '../includes/header.php';include '../includes/navbar.php';?>
<div class="container py-5"><div class="card p-4"><h2>detail pesanan #<?=$id?></h2><p>pembeli: <b><?=htmlspecialchars($o['buyer'])?></b></p><p>alamat: <?=htmlspecialchars($o['address'])?></p><p>status: <span class="badge badge-status"><?=$o['status']?></span></p><hr><h5>produk</h5>
<?php $s=$pdo->prepare("select oi.*,p.name from order_items oi join products p on oi.product_id=p.id where oi.order_id=?");$s->execute([$id]);while($i=$s->fetch()):?><p><?=htmlspecialchars($i['name'])?> × <?=$i['quantity']?> — rp <?=number_format($i['subtotal'],0,',','.')?></p><?php endwhile;?>
<h4>total: rp <?=number_format($o['total_price'],0,',','.')?></h4>
<?php if($o['payment_proof']):?><p><a href="../uploads/<?=htmlspecialchars($o['payment_proof'])?>" target="_blank">lihat bukti pembayaran</a></p><?php endif;?>
<div class="mt-3"><?php if($o['status']==='menunggu verifikasi'):?><a class="btn btn-primary" href="?id=<?=$id?>&action=terima">terima pesanan</a> <a class="btn btn-outline-danger" href="?id=<?=$id?>&action=tolak">tolak</a><?php elseif($o['status']==='diproses'):?><a class="btn btn-primary" href="?id=<?=$id?>&action=selesai">ubah menjadi selesai</a><?php endif;?></div>
</div></div><?php include '../includes/footer.php';?>
