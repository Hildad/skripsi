<h2>Data Kategori</h2>
<?php 
$hasil_kategori=$kategori->tampil();


 ?>
<!--  <pre><?php print_r($hasil_kategori) ?></pre> -->

 <div class="table-responsive">
 	<table class="table table-bordered" id="thetable">
 		<thead>	
 		<tr>
 			<th>No</th>
 			<th>Nama Kategori</th>
 			<th>Jumlah</th>
 			<th>Aksi</th>
 		</tr>
 		</thead>
 		<tbody>
 			<?php foreach ($hasil_kategori as $key => $value): ?>	
 			<tr>
 				<td><?php echo $key+1; ?></td>
 				<td><?php echo $value['nama_kategori']; ?></td>
 				<td><?php echo $value['jumlah_kategori']; ?></td>
 				<td><a href="index.php?halaman=hapuskategori&id_kategori=<?php echo  $value['id_kategori'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a></td>
 			</tr>
 			<?php endforeach ?>
 		</tbody>


 	</table>
 </div>

