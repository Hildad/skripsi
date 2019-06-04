<?php 
include "../config/class.php";
if (!isset($_SESSION['admin'])) {
  echo "<script>location='../login.php'</script>";
error_reporting(0);
include "../vendor/autoload.php";

}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menu Admin</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet"  href="../assets/dist/css/sendiri.css">
</head>
<body>
  <div id="wrapper">
    <nav class="navbar navbar-default">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".sidebar-collapse" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Shoes Studio</a>
      </div>     
    </nav>
    <nav class="navbar-default navbar-side">
      <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
          <li><a href="index.php"><i class="fa fa-home"></i>  Home</a></li>
          <li><a href="index.php?halaman=profil"><i class="fa fa-user"></i> Profil</a></li>
          <li><a href="index.php?halaman=pencarian"><i class="fa fa-tags"></i> Hasil Pencarian</a></li>
          <li><a href="index.php?halaman=kategori"><i class="fa fa-tags"></i>  Hasil Kategori</a></li>
          <li><a href="index.php?halaman=kategorisasi"><i class="fa fa-tags"></i>  Kategorisasi NLP</a></li>
          <li><a href="index.php?halaman=grafik"><i class="fa fa-cube"></i>  Grafik</a></li>
          <!-- <li><a href="index.php?halaman=pengaturan"><i class="fa fa-cog"></i>  Pengaturan</a></li> -->
          <li><a href="index.php?halaman=logout"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
      </div>
    </nav>
    <div id="page-wrapper">
      <div id="page-inner">
        <?php 
          // jika tidak ada parameter halaman (index.php aja)
        if (!isset($_GET['halaman'])) 
        {
          //panggil file home.php
          include 'home.php';
        }
        else
        {
          //jika halaman sama dengan kategori, maka panggil folder kategori/tampilkategori.php
          if ($_GET['halaman']=="profil") 
          {

            include 'profil.php';

          }
          elseif ($_GET['halaman']=="pencarian")
          {
            include 'pencarian.php';
          }
           elseif ($_GET['halaman']=="hasil")
          {
            include 'hasil.php';
          }
          elseif ($_GET['halaman']=="detail") {
            include'detail.php';
          }
          elseif ($_GET['halaman']=="kategori") 
          {
            include 'kategori.php';
          }
          elseif ($_GET['halaman']=="kategorisasi") {
            include 'kategorisasi.php';
          }
          elseif ($_GET['halaman']=="hapusnlp") {
            $id_nlp=$_GET['id_nlp'];
            $kategori->hapusnlp($id_nlp);
            echo "<script> location='index.php?halaman=kategorisasi'</script>";
          }
          elseif ($_GET['halaman']=="hapuskategori") {
            $id_kategori=$_GET['id_kategori'];
            $kategori->hapuskategori($id_kategori);
            echo "<script> location='index.php?halaman=kategori'</script>";
          }
          elseif ($_GET['halaman']=="hapuspencarian")
          {
            $id_pencarian=$_GET['id_pencarian'];
            $pencarian->hapuspencarian($id_pencarian);
            echo "<script> location='index.php?halaman=pencarian'</script>";

          }
          elseif ($_GET['halaman']=="grafik")
          {
            include 'tampilgrafik.php';
          }
           elseif ($_GET['halaman']=="ubahpengaturan")
          {
            include 'pengaturan/ubahpengaturan.php';
          }
          elseif ($_GET['halaman']=="logout")
          {
            unset($_SESSION['admin']);
            echo "<script>location='../login.php'</script>";
          }

        }

        ?>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/dist/js/sendiri.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script >
    $(document).ready(function() {
      $('#thetable').DataTable();
    } );
  </script>
  <script src="../assets/ckeditor/ckeditor.js"></script>
  <script >
    CKEDITOR.replace("theeditor");
  </script>

  <script type="text/javascript">
$(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Pencarian'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: [
                <?php foreach ($jumlah as $key => $value): ?>
                  '<?php echo $key ?>',
                <?php endforeach ?>
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Tanggal',
            data: [
            <?php foreach ($jumlah as $key => $value): ?>
              <?php echo $value; ?>,
            <?php endforeach ?>
            ]

        } ]
    });
});
    </script>

</body>
</html>