<?php
require '../includes/auth.php'; require_login('penjual'); require '../config/database.php';
$id=(int)($_GET['id']??0);$p=['name'=>'','description'=>'','price'=>'','stock'=>0,'status'=>'tersedia'];
if($id){$s=$pdo->prepare("select * from products where id=? and seller_id=?");$s->execute([$id,$_SESSION['user']['id']]);$p=$s->fetch();if(!$p)die('produk tidak ditemukan');}
if($_SERVER['REQUEST_METHOD']==='POST'){
$name=trim($_POST['name']);$desc=trim($_POST['description']);$price=(float)$_POST['price'];$stock=(int)$_POST['stock'];$status=$stock>0?'tersedia':'habis';
if($id)$stmt=$pdo->prepare("update products set name=?,description=?,price=?,stock=?,status=? where id=? and seller_id=?");
else $stmt=$pdo->prepare("insert into products(name,description,price,stock,status,seller_id) values(?,?,?,?,?,?)");
if($id)$stmt->execute([$name,$desc,$price,$stock,$status,$id,$_SESSION['user']['id']]);else $stmt->execute([$name,$desc,$price,$stock,$status,$_SESSION['user']['id']]);
header('location: products.php');exit;
}
include '../includes/header.php';include '../includes/navbar.php';?>
<div class="container py-5"><div class="card p-4"><h2><?=$id?'edit':'tambah'?> produk</h2><form method="post"><input class="form-control my-2" name="name" value="<?=htmlspecialchars($p['name'])?>" placeholder="nama produk" required><textarea class="form-control my-2" name="description" placeholder="deskripsi"><?=htmlspecialchars($p['description'])?></textarea><input class="form-control my-2" type="number" name="price" value="<?=$p['price']?>" placeholder="harga" required><input class="form-control my-2" type="number" name="stock" value="<?=$p['stock']?>" placeholder="stok" required><button class="btn btn-primary mt-2">simpan</button></form></div></div><?php include '../includes/footer.php';?>
