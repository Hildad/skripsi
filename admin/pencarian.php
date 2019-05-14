<h2>Hasil Pencarian</h2>

<?php 

	$hasil_tampil=$pencarian->tampil();


 ?>
  <!-- <pre><?php print_r($hasil_tampil); ?> </pre>  -->

<div class="table-responsive">
	<table class="table table-bordered" id="thetable">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal Pencarian</th>
				<th>Kata Pencarian </th>
				<th>Lama Pencarian</th>
				<!-- <th>Kategori</th>
				<th>Dataset</th> -->
				<th>Detail</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($hasil_tampil as $key => $value): ?>	
			<tr>
				<td><?php echo $key+1; ?></td>
				<td><?php echo $value['tgl_pencarian']; ?></td>
				<td><?php echo $value['kata_pencarian']; ?></td>
				<td><?php echo $value['lama_pencarian']; ?></td>
				<td><a href="index.php?halaman=detail&id_pencarian=<?php echo  $value['id_pencarian'] ?>" class="btn btn-info"><i class="fa fa-search"></i> Detail</a></td>
				<td><a href="index.php?halaman=hapuspencarian&id_pencarian=<?php echo  $value['id_pencarian'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a></td>
			</tr>
			<?php endforeach ?>
		</tbody>

	</table>
</div>

