<h2>Ubah Pengaturan</h2>
<hr>

<?php 
	
	$data_pengaturan=$pengaturan->detail($_GET['id']);
 ?>


<form method="post">
	<div class="form-group">
		<label>Nama Pengaturan</label>
		<input type="text" name="nama_pengaturan" class="form-control" value="<?php echo $data_pengaturan['nama_pengaturan'] ?>">
	</div>
	<div class="form-group">
		<label>Isi Pengaturan</label>
		<textarea class="form-control" name="isi_pengaturan" rows="5" value="<?php echo $data_pengaturan['isi_pengaturan'] ?>"></textarea>
	</div>
	<div class="form-group">
		<label>Foto Pengaturan</label>
		<img src="img/<?php echo $data_pengaturan['foto_pengaturan']?>" width=100px;>
		<input class="form-control" type="file" name="foto_pengaturan">
	</div>
	<button class="btn btn-primary">Simpan</button>
</form>
