<h2>Data Kategori</h2>
<?php 
$kategori_nlp=$kategori->tampil_nlp();


 ?>
<!--  <pre><?php print_r($kategori_nlp) ?></pre> -->

 <div class="table-responsive">
 	<table class="table table-bordered" id="thetable">
 		<thead>	
 		<tr>
 			<th>No</th>
 			<th>Nama Produk</th>
 			<th>kategori</th>
 			<th>Aksi</th>
 		</tr>
 		</thead>
 		<tbody>
 			<?php foreach ($kategori_nlp as $key => $value): ?>	
 			<tr>
 				<td><?php echo $key+1; ?></td>
 				<td><?php echo $value['nama_produk']; ?></td>
 				<td><?php echo $value['kategori']; ?></td>
 				<td><a href="index.php?halaman=hapusnlp&id_nlp=<?php echo  $value['id_nlp'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a></td>
 			</tr>
 			<?php endforeach ?>
 		</tbody>


 	</table>
 </div>

