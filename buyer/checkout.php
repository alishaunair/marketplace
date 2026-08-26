<?php
require '../includes/auth.php'; require_login('pembeli'); require '../config/database.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){header('location: cart.php');exit;}
$uid=$_SESSION['user']['id']; $address=trim($_POST['address']);
$pdo->beginTransaction();
try{
$stmt=$pdo->prepare("select ci.*,p.name,p.price,p.stock from cart_items ci join carts c on ci.cart_id=c.id join products p on ci.product_id=p.id where c.user_id=?");$stmt->execute([$uid]);$items=$stmt->fetchAll();$total=0;
foreach($items as $i){if($i['quantity']>$i['stock'])throw new Exception('stok tidak cukup');$total+=$i['price']*$i['quantity'];}
$pdo->prepare("insert into orders(user_id,address,total_price) values(?,?,?)")->execute([$uid,$address,$total]);$oid=$pdo->lastInsertId();
foreach($items as $i){$pdo->prepare("insert into order_items(order_id,product_id,quantity,price,subtotal) values(?,?,?,?,?)")->execute([$oid,$i['product_id'],$i['quantity'],$i['price'],$i['price']*$i['quantity']]);$pdo->prepare("update products set stock=stock-? where id=?")->execute([$i['quantity'],$i['product_id']]);}
$pdo->prepare("delete ci from cart_items ci join carts c on ci.cart_id=c.id where c.user_id=?")->execute([$uid]);$pdo->commit();header("location: payment.php?id=$oid");exit;
}catch(Exception $e){$pdo->rollBack();die($e->getMessage());}
