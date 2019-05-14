<h3>Grafik</h3>
<?php 
if (isset($_POST['tampil'])) {
    $tahun= $_POST['tahun'];
    $bulan = $_POST['bulan'];
} else {
    $tahun = date("Y");
    $bulan = date("m");
}
$data_semua = $pencarian->jumlah_pertanggal($tahun."-".$bulan);
foreach ($data_semua as $key => $value) {
    $array_waktu=explode(" ", $value['tgl_pencarian']);
    $data_pertanggal[$array_waktu[0]][]=$value;

}
foreach ($data_pertanggal as $tanggal => $value) {
    $jumlah[$tanggal]=count($value);
}
 ?>
<form class="form-inline" method="post" >
    <div class="form-group">
        <select class="form-control" name="tahun">
            <?php for($i=2017; $i<=date("Y"); $i++){
                ?>
                <option value="<?php echo $i ?>"<?php if ($i==$tahun) {echo "selected";} ?>><?php echo $i; ?></option>
                <?php } ?>
        </select>
    </div>   
    <div class="form-group">
        <select class="form-control" name="bulan">
            <option value="01"<?php if($bulan=="01") { echo "selected";} ?>>Januari</option>
            <option value="02"<?php if($bulan=="02") { echo "selected";} ?>>Februari</option>
            <option value="03"<?php if($bulan=="03") { echo "selected";} ?>>Maret</option>
            <option value="04"<?php if($bulan=="04") { echo "selected";} ?>>April</option>
            <option value="05"<?php if($bulan=="05") { echo "selected";} ?>>Mei</option>
            <option value="06"<?php if($bulan=="06") { echo "selected";} ?>>Juni</option>
            <option value="07"<?php if($bulan=="07") { echo "selected";} ?>>Juli</option>
            <option value="08"<?php if($bulan=="08") { echo "selected";} ?>>Agustus</option>
            <option value="09"<?php if($bulan=="09") { echo "selected";} ?>>September</option>
            <option value="10"<?php if($bulan=="10") { echo "selected";} ?>>Oktober</option>
            <option value="11"<?php if($bulan=="11") { echo "selected";} ?>>November</option>
            <option value="12"<?php if($bulan=="12") { echo "selected";} ?>>Desember</option>
        </select>
    </div>
    <button class="btn btn-info" name="tampil">Lihat Grafik</button>
</form>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
