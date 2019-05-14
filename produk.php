<?php 
include "config/class.php";

error_reporting(0);

include "vendor/autoload.php";
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Classifiers\MultinomialNBClassifier;

unset($_SESSION['bukalapak']);

//Mendapatkan waktu
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
$kata_kunci= $_GET['kata_kunci'];

$kata_kunci_bukalapak = str_replace(" ", "+", $kata_kunci);
if (!isset($_SESSION['bukalapak'][$kata_kunci_bukalapak])) {
    $simpan="ya";
} else {
    $simpan="tidak";
}
if (!isset($_SESSION['bukalapak'][$kata_kunci_bukalapak])) 
{
    for ($i_b=1; $i_b<=2 ; $i_b++) 
    { 
        $url_bukalapak="https://www.bukalapak.com/products/s?from=omnisearch&page".$i_b."&search%5Bhashtag%5D=&search%5Bkeywords%5D=".$kata_kunci_bukalapak;

        $crawling->ambil_halaman($url_bukalapak);
        $ambil_bukalapak=$crawling->ambil_bukalapak();
        $hasil_bukalapak[$i_b]=$ambil_bukalapak;
    }
    $_SESSION['bukalapak'][$kata_kunci_bukalapak]=$hasil_bukalapak;
}
else 
{
    $hasil_bukalapak =$_SESSION['bukalapak'][$kata_kunci_bukalapak];
}

$data_bukalapak=$crawling->tampil_bukalapak($hasil_bukalapak);



$kata_kunci_shopee=str_replace(" ","%20", $kata_kunci);
if (!isset($_SESSION['shopee'][$kata_kunci_shopee])) {
    for ($i_s=1; $i_s<=2 ; $i_s++) { 
        $url_shopee="https://shopee.co.id/search?keyword=".$kata_kunci_shopee."&page=".$i_s."&sortBy=relevancy";
        $crawling->ambil_halaman($url_shopee);
        $hasil_shopee[$i_s]=$crawling->ambil_shopee();
    }
    $_SESSION['shopee'][$kata_kunci_shopee]=$hasil_shopee;
}
else
{
    $hasil_shopee=$_SESSION['shopee'][$kata_kunci_shopee];
}
$data_shopee=$crawling->tampil_shopee($hasil_shopee);

$kata_kunci_lazada = str_replace(" ", "%20", $kata_kunci);
if (!isset($_SESSION['lazada'][$kata_kunci_lazada])) 
{
    for ($i_l=1; $i_l<=2 ; $i_l++) 
    { 
        $url_lazada="https://www.lazada.co.id/catalog/?_keyori=ss&from=input&page=".$i_l."&q=".$kata_kunci_lazada;

        $crawling->ambil_halaman($url_lazada);
        $ambil_lazada=$crawling->ambil_lazada();
        $hasil_lazada[$i_l]=$ambil_lazada;
    }
    $_SESSION['lazada'][$kata_kunci_lazada]=$hasil_lazada;
}
else 
{
    $hasil_lazada =$_SESSION['lazada'][$kata_kunci_lazada];
}

$data_lazada=$crawling->tampil_lazada($hasil_lazada);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Online Shop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="assets/owl-carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owl-carousel/assets/owl.theme.default.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:700" rel="stylesheet">
    <link rel="stylesheet" href="assets/dist/css/style.css">

</head>
<body>
    <?php include'header.php' ?>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".naff">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse naff">
                <ul class="nav navbar-nav">
                    <li ><a href="index.php"><i class="fa fa-home"> Home</i></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php"><i class="fa fa-sign-in"> Login</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="box">
                        <span class="box-header">
                            <form class="form-inline" style="margin-left: 850px;" method="POST" onchange="this.form.submit();">
                                <select class="form-control" name="urutkan">
                                    <option value="">Urutkan Berdasarkan Harga</option>
                                    <option value="<?php echo sort($data_produk['harga']) ?>">Harga Termurah</option>
                                    <option value="">Harga Termahal</option>
                                </select>
                            </form>

                        </span>

                    </div> -->

                    <!-- Awal Slider Produk Bukalapak-->

                    <div class="box">
                        <div class="box-header">
                            <img src="assets/img/logo/bukalapak.png">
                            <h3 class="box-title">Produk Bukalapak</h3>
                            
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <?php if (isset($data_bukalapak)): ?>
                                    <?php $no = 0; ?>
                                    <?php foreach ($data_bukalapak['kelompok_bukalapak'] as $index_produk => $data_produk): ?>
                                        <div class="col-md-3">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="text-center">
                                                        <div class="image-product">
                                                            <img src="<?php echo $data_produk['foto'] ?>" alt="" class="img-responsive">
                                                        </div>
                                                        <h3 class="title-produk">
                                                            <a href="<?php echo $data_produk['link'] ?>" title="<?php echo $data_produk['nama'] ?>" target="blank()" ><?php echo substr ($data_produk['nama'],0,40); ?>...</a>

                                                        </h3>
                                                        <span class="price-product"><?php echo $data_produk['harga']; ?></span>
                                                        <a href="<?php echo $data_produk['link'] ?>" target="blank()" class="btn btn-default">Detail</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>  
                                        <?php $no+=1; ?>
                                        <div class='<?php if($no%4 == "0"){echo"clearfix";}?>'></div>
                                    <?php endforeach ?>
                                    <?php else: ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-info">Data Kosong</div>
                                        </div>
                                    <?php endif ?>
                                </div>


                            </div>
                            <div class="text-center">    
                                <ul class="pagination pagination-sm">
                                    <?php for ($i=1; $i <=$data_bukalapak['pagination'] ; $i++) {  
                                        echo '<li><a href="produk.php?kata_kunci='.$kata_kunci_bukalapak.'&halaman_bukalapak='.$i.'">'.$i.'</a></li>';
                                    } ?>


                                </ul>
                            </div>
                        </div>
                        <!-- Akhir Slider Produk Bukalapak -->

                        <!-- Awal Slider Produk Shopee-->

                        <div class="box">
                            <div class="box-header">
                                <img src="assets/img/logo/shopee.png">
                                <h3 class="box-title">Produk Shopee</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <?php if (isset($data_shopee)): ?>
                                        <?php $no= 0; ?>
                                        <?php foreach ($data_shopee['kelompok_shopee'] as $index_produk => $data_produk): ?>
                                            <div class="col-md-3">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="text-center">
                                                            <div class="image-product">
                                                                <img src="<?php echo $data_produk['foto'] ?>" alt="" class="img-responsive">
                                                            </div>
                                                            <h3 class="title-produk">
                                                                <a href="<?php echo $data_produk['link'] ?>" title="<?php echo $data_produk['nama'] ?>" target="blank()" ><?php echo substr ($data_produk['nama'],0,40); ?>...</a>

                                                            </h3>
                                                            <span class="price-product"><?php echo $data_produk['harga']; ?></span>
                                                            <a href="<?php echo $data_produk['link'] ?>" target="blank()" class="btn btn-default">Detail</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> 
                                        <?php $no+=1; ?>
                                        <div class='<?php if($no%4 == "0"){echo"clearfix";}?>'></div>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                            <div class="col-md-12">
                                                <div class="alert alert-info">Data Kosong</div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="text-center">    
                                    <ul class="pagination pagination-sm">
                                        <?php for ($i=1; $i <=$data_shopee['pagination'] ; $i++) {  
                                            echo '<li><a href="produk.php?kata_kunci='.$kata_kunci_shopee.'&halaman_shopee='.$i.'">'.$i.'</a></li>';
                                        } ?>


                                    </ul>
                                </div>
                            </div>

                            <!-- Akhir Slider Produk Shopee -->
                            <!-- Awal Slider Produk Lazada Indonesia-->
                            <div class="box">
                                <div class="box-header">
                                    <img src="assets/img/logo/lazada.png">
                                    <h3 class="box-title">Produk Lazada</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <?php $no= 0; ?>
                                        <?php if (isset($data_lazada)): ?>
                                            <?php foreach ($data_lazada['kelompok_lazada'] as $index_produk => $data_produk): ?>
                                                <div class="col-md-3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <div class="text-center">
                                                                <div class="image-product">
                                                                    <img src="<?php echo $data_produk['foto'] ?>" alt="" class="img-responsive">
                                                                </div>
                                                                <h3 class="title-produk">
                                                                    <a href="<?php echo $data_produk['link'] ?>" title="<?php echo $data_produk['nama'] ?>" target="blank()" ><?php echo substr ($data_produk['nama'],0,40); ?>...</a>

                                                                </h3>
                                                                <span class="price-product"><?php echo $data_produk['harga']; ?></span>
                                                                <a href="<?php echo $data_produk['link'] ?>" target="blank()" class="btn btn-default">Detail</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>  
                                                <?php $no+=1; ?>
                                             <div class='<?php if($no%4 == "0"){echo"clearfix";}?>'></div>
                                            <?php endforeach ?>
                                            <?php else: ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-info">Data Kosong</div>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="text-center">    
                                        <ul class="pagination pagination-sm">
                                            <?php for ($i=1; $i <=$data_lazada['pagination'] ; $i++) {  
                                                echo '<li><a href="produk.php?kata_kunci='.$kata_kunci_lazada.'&halaman_lazada='.$i.'">'.$i.'</a></li>';
                                            } ?>

                                        </ul>
                                    </div>
                                </div>

                                <!-- Akhir Slider Produk Lazada Indonesia -->

                            </div>


                        </div> 
                    </div> 

                </main>
                <footer class="footer">
                    <div class="footer-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <h3 class="footer-title">Tentang Bukalapak</h3>
                                    <h4>Bukalapak</h4>
                                    <br>
                                    <p>
                                        Bukalapak merupakan situs belanja online terpercaya di Indonesia yang menjual beragam produk yang dibutuhkan seluruh masyarakat Indonesia. Seiring berkembangnya teknologi, semakin banyak aktivitas yang dilakukan secara digital, lebih mudah dan praktis, termasuk kegiatan pembelanjaan yang kini semakin marak dilakukan secara digital, baik melalui komputer, laptop, hingga smartphone yang bisa diakses kapan saja dan di mana saja. Bukalapak hadir sebagai toko online terpercaya dengan sistem konsumen ke konsumen. Hal ini memungkinkan setiap orang untuk menjual dan juga membeli produk dengan mudah secara online. Sarana jual beli online Bukalapak memiliki visi untuk menjadi marketplace nomor satu di Indonesia dengan misi untuk memberdayakan UKM di seluruh penjuru Indonesia. Setiap orang di Indonesia dapat memasarkan produk unggulannya di Bukalapak dengan membuka toko online murah dengan pilihan sistem belanja satuan dan juga grosir.
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="footer-title">Tentang Lazada</h3>
                                    <h4>Lazada</h4>
                                    <br>
                                    <p>
                                        Lazada adalah perintis e-commerce (online shopping) di beberapa negara dengan pertumbuhan tercepat di dunia yang menawarkan pengalaman belanja online cepat, aman dan nyaman dengan produk-produk dalam kategori mulai dari fashion, peralatan elektronik, peralatan rumah tangga, mainan anak-anak dan peralatan olahraga. Lazada selalu berjuang untuk memberikan pelanggan yang terbaik termasuk dengan menawarkan beberapa metode pembayaran, pengembalian gratis, layanan konsumen yang baik dan garansi komitmen. Sebagai situs belanja online terbaik di Indonesia, Lazada.co.id selalu menyediakan deretan produk tak terhitung jumlahnya yang selalu di update tiap hari. Kami selalu memastikan bahwa anda mendapatkan penawaran terbaru dan terbaik lewat promo-promo kami.
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="footer-title">Tentang Shopee</h3>
                                    <h4>Shopee</h4>
                                    <br>
                                    <p>
                                        Shopee adalah mobile-platform pertama di Asia Tenggara (Indonesia, Filipina, Malaysia, Singapura, Thailand, Vietnam) dan Taiwan yang menawarkan transaksi jual beli online yang menyenangkan, gratis, dan terpercaya via ponsel. Bergabunglah dengan jutaan pengguna lainnya dengan mulai mendaftarkan produk jualan dan berbelanja berbagai penawaran menarik kapan saja, di mana saja. Keamanan transaksi kamu terjamin - Terima pesanan kamu atau dapatkan uang kamu kembali dengan Garansi Shopee. Ayo gabung dalam komunitas Shopee dan mulai belanja sekarang!
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="footer-title">Kontak Kami</h3>
                                    <ul>
                                        <li>Telp: 085877190393</li>
                                        <li>Email: hildautari.hu@gmail.com</li>
                                        <li>Alamat: Dusun Gebang RT 005 RW 045, Wedomartani, Ngemplak, Sleman, Yogyakarta</li>
                                    </ul>
                                    <hr>

                                    <span>
                                        <img src="assets/img/logo/shopee.png" class="img-thumbnail">
                                    </span>
                                    <span>
                                        <img src="assets/img/logo/bukalapak.png" class="img-thumbnail">
                                    </span>
                                    <span>
                                        <img src="assets/img/logo/lazada.png" class="img-thumbnail">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="footer-bottom">
                        <div class="container">Copyright &copy; <strong>2019</strong> All Right Reserved </div>
                    </div>
                </footer>

                <?php 
                $time = microtime();
                $time = explode(' ', $time);
                $time = $time[1] + $time[0];
                $finish = $time;
                $total_time = round(($finish - $start),4);

                $tgl_pencarian = date("Y-m-d H:i:s");
                $kata_pencarian = $kata_kunci;
                $lama_pencarian = $total_time;

                if ($simpan=="ya") {
                    $pencarian->tambah($tgl_pencarian, $kata_pencarian, $lama_pencarian);
                    $kategori->tambah();
                    
                }

                ?>

                <script src="assets/dist/js/jquery.min.js"></script>
                <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                <script src="assets/owl-carousel/owl.carousel.min.js"></script>
                <script src="assets/dist/js/warungtrainit.js"></script>
            </body>
            </html> 