<?php 
	include 'config/class.php';
 ?>

<!DOCTYPE >
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
	<?php include 'header.php' ?>
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
                <li><a href="index.php"><i class="fa fa-home"> Home</i></a></li>
              
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href=""><i class="fa fa-sign-in"> Login</i></a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="content">
    <div class="container">
		<div class="row">
			<div class="col-md-5 col-md-offset-3">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-pencil"> Login Admin</i></h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label >username</label>
								<input type="text" name="username" class="form-control">
							</div>
							<div class="form-group">
								<label>password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<button class="btn btn-primary" name="login"><i class="fa fa-sign-in"> Login</i></button>
						</form>
						<br>
						<?php 

						if (isset($_POST['login']))
						{
							$hasil= $admin->login($_POST['username'],$_POST['password']);
							if ($hasil=="sukses") {
								echo "<script>location='admin/index.php'</script>";
							} elseif ($hasil=="gagal") {
								echo "<div class='alert alert-danger'>Username dan Password Salah!</div>";
								
							}

						} 




						 ?>

					</div>
					
				</div>
				
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
</div>
</div>
</footer>






<script src="assets/dist/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/owl-carousel/owl.carousel.min.js"></script>
<script src="assets/dist/js/warungtrainit.js"></script>


	
</body>
</html>
