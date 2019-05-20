<?php 
include'config/class.php';
$tgl_pencarian=$_GET['tgl_pencarian'];
$kata_pencarian=$_GET['kata_pencarian'];
$lama_pencarian=$_GET['lama_pencarian'];
$hasil_pencarian=$_GET['hasil_pencarian'];

$pencarian->tambah($tgl_pencarian,$kata_pencarian,$lama_pencarian,$hasil_pencarian);
 ?>