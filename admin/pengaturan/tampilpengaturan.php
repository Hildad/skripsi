<h2>Pengaturan</h2>
<?php 
	$tampil_pengaturan=$pengaturan->tampil();

 ?>
 <!-- <pre><?php print_r($tampil_pengaturan) ?></pre> -->

 <div class="table-responsive">
 	<table class="table table-bordered" id="thetable">
 		<thead>
 			<tr>
 				<th>No</th>
 				<th>Nama Pengaturan</th>
 				<th>Isi Pengaturan</th>
 				<th>Foto Pengaturan</th>
 				<th>Aksi</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php foreach ($tampil_pengaturan as $key => $value): ?>
 				
 			<tr>
 				<td><?php echo $key+1; ?></td>
 				<td><?php echo $value['nama_pengaturan']; ?></td>
 				<td><?php echo $value['isi_pengaturan']; ?></td>
 				<td><?php echo $value['foto_pengaturan']; ?></td>
 				<td>
 					<a href="index.php?halaman=ubahpengaturan&id=<?php echo $value['id_pengaturan'];?>" class="btn btn-warning "><i class="fa fa-pencil"> Edit</i></a>
 				</td>
 			
 			</tr>
 			<?php endforeach ?>

 		</tbody>
 	</table>
 </div>