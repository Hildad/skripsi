<h3>Detail Pencarian</h3>
<?php $detail_pencarian=$pencarian->detail($_GET['id_pencarian']) ?>

<!-- <pre><?php print_r($detail_pencarian) ?></pre> -->

<table class="table table-bordered">
	<tr>
		<th>Tanggal</th>
		<th>:</th>
		<td><?php echo $detail_pencarian['tgl_pencarian']; ?></td>
	</tr><tr>
		<th>Kata Pencarian</th>
		<th>:</th>
		<td><?php echo $detail_pencarian['kata_pencarian']; ?></td>
	</tr><tr>
		<th>Lama Pencarian</th>
		<th>:</th>
		<td><?php echo $detail_pencarian['lama_pencarian']; ?></td>
	</tr><tr>
		<th>Hasil Pencarian</th>
		<th>:</th>
		<td><?php echo $detail_pencarian['hasil_pencarian']; ?></td>
	</tr>
</table>