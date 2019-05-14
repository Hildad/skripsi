<h2>Dataset</h2>

<?php 
 $hasil_tampil=$pencarian->tampil();

 ?>

 <div class="table-responsive">
 	<table class="table table-bordered" id="thetable">
 		<thead>
 			<tr>
 				<th>No</th>
 				<th>ID Hasil</th>
 				<th>Nama Sepatu</th>
 				<th>Link </th>
 				<th>Foto </th>
 				<th>Aksi</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php foreach ($hasil_tampil as $key => $value): ?>	
 			<tr>
 				<td><?php echo $key+1; ?></td>
 				<td><?php echo $value['id_hasil']; ?></td>
 				<td><?php echo $value['nama_sepatu']; ?></td>
 				<td><?php echo $value['link']; ?></td>
 				<td><?php echo $value['foto']; ?></td>
 				<td><a href="" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a></td>
 			</tr>
 			<?php endforeach ?>
 		</tbody>
 	</table>
 </div>