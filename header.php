<header class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo">
                     <a href="index.php"><img src="assets/img/shoes.png" alt="" class="img-responsive" style="margin-top: 20px; margin-bottom: 10px; padding-left: 50px"></a> 
                 </div>
             </div>
             <div class="col-md-9">  
                <div class="search">
                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="kata_kunci" class="form-control" placeholder="Cari Produk ( Sepatu, Merek, Ukuran, Warna)" required="">
                                <select class="form-control text-capitalize" name="kategori">

                                    <option value="">Pilih Kategori</option>
                                    <?php $data_kategori = $kategori->tampil(); ?>
                                    <?php foreach ($data_kategori as $key => $value): ?>
                                        <?php $nama_kategori = str_replace("-", " ", $value['nama_kategori']); ?>
                                    <option value="<?php echo $nama_kategori ?>"><?php echo $nama_kategori; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-color" name="cari">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                    <?php
                        if (isset($_POST['cari'])) 
                        {
                          $kata_kunci = $_POST['kata_kunci']." ".$_POST['kategori'];
                          echo "<script> location='produk.php?kata_kunci=$kata_kunci'</script>";
                        }

                     ?>
                </div>
                <div>
                    <label>Contoh: Sepatu Nike 37 Warna Merah</label>
                </div>
            </div>
        </div>

    </div>
</header>