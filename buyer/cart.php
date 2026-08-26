<?php require '../includes/auth.php'; require_login('pembeli'); require '../config/database.php'; include '../includes/header.php'; include '../includes/navbar.php';
$uid=$_SESSION['user']['id']; $stmt=$pdo->prepare("select ci.*,p.name,p.price,p.stock from cart_items ci join carts c on ci.cart_id=c.id join products p on ci.product_id=p.id where c.user_id=?"); $stmt->execute([$uid]); $items=$stmt->fetchAll(); $total=0;
?>
<div class="container py-5"><h2>keranjang</h2><div class="card p-4 mt-3">
<?php foreach($items as $i): $sub=$i['price']*$i['quantity']; $total+=$sub; ?>
<div class="d-flex justify-content-between border-bottom py-3"><span><?=htmlspecialchars($i['name'])?> × <?=$i['quantity']?></span><b>rp <?=number_format($sub,0,',','.')?></b></div>
<?php endforeach; ?>
<h4 class="text-end mt-3">total: rp <?=number_format($total,0,',','.')?></h4>
<?php if($items): ?><form method="post" action="checkout.php"><textarea name="address" class="form-control my-3" placeholder="alamat pengiriman" required></textarea><button class="btn btn-primary">lanjut checkout</button></form><?php else: ?><p>keranjang masih kosong.</p><?php endif; ?>
</div></div><?php include '../includes/footer.php'; ?>
