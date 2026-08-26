<?php
require '../config/database.php';
session_start();
$login=trim($_POST['login']); $password=$_POST['password'];
$stmt=$pdo->prepare("select * from users where username=? or email=? limit 1");
$stmt->execute([$login,$login]); $user=$stmt->fetch();
if(!$user || !password_verify($password,$user['password'])) { header('location: login.php?error=1'); exit; }
$_SESSION['user']=['id'=>$user['id'],'name'=>$user['name'],'role'=>$user['role']];
if($user['role']==='penjual') header('location: ../seller/dashboard.php');
else header('location: ../buyer/dashboard.php');
exit;
