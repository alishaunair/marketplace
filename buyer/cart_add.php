<?php
require '../includes/auth.php'; require_login('pembeli'); require '../config/database.php';
$uid=$_SESSION['user']['id']; $pid=(int)$_GET['id'];
$cart=$pdo->prepare("select id from carts where user_id=?"); $cart->execute([$uid]); $c=$cart->fetch();
if(!$c){$pdo->prepare("insert into carts(user_id) values(?)")->execute([$uid]); $cid=$pdo->lastInsertId();}else{$cid=$c['id'];}
$check=$pdo->prepare("select id from cart_items where cart_id=? and product_id=?");$check->execute([$cid,$pid]);
if($check->fetch()) $pdo->prepare("update cart_items set quantity=quantity+1 where cart_id=? and product_id=?")->execute([$cid,$pid]);
else $pdo->prepare("insert into cart_items(cart_id,product_id,quantity) values(?,?,1)")->execute([$cid,$pid]);
header('location: cart.php'); exit;
