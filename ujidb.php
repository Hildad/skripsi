<?php 
include'config/class.php';
$username=$_GET['username'];
$password=$_GET['password'];

$admin->tambah($username,$password);
 ?>