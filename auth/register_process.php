<?php
require '../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('location: register.php'); exit; }
$name=trim($_POST['name']); $username=trim($_POST['username']); $email=trim($_POST['email']); $password=$_POST['password']; $role=$_POST['role'];
if (!in_array($role,['pembeli','penjual'])) die('role tidak valid');
$check=$pdo->prepare("select id from users where username=? or email=?");
$check->execute([$username,$email]);
if($check->fetch()){ die('username atau email sudah digunakan. <a href="register.php">kembali</a>'); }
$hash=password_hash($password,PASSWORD_DEFAULT);
$stmt=$pdo->prepare("insert into users(name,username,email,password,role) values(?,?,?,?,?)");
$stmt->execute([$name,$username,$email,$hash,$role]);
header('location: register.php?success=1'); exit;
