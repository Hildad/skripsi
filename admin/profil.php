<h2>Profil</h2>
<hr>


<form method="post">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $_SESSION['admin']['username'] ?>">
    </div>  
    <div class="form-group">
        <label>Password Lama</label>
        <input type="password" name="password_lama" class="form-control">
        <small class="text-danger">*Kosongkan jika tidak mengubah password</small>
    </div>
    <div class="form-group">
        <label>Password Baru</label>
        <input type="password" name="password_baru" class="form-control">
        <small class="text-danger">*Kosongkan jika tidak mengubah password</small>
    </div>
    <div class="form-group">
        <label>Konfirmasi Password </label>
        <input type="password" name="konfirmasi_password" class="form-control">
        <small class="text-danger">*Kosongkan jika tidak mengubah password</small>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" name="ubah">Ubah Profil</button>
    </div>

</form>

<?php 
if (isset($_POST['ubah'])) {
    if (empty($_POST['password_lama'])) {
        //Maka yang diubah hanya username
        $admin->ubah_profil($_POST['username'], $_SESSION['admin']['password'],$_SESSION['admin']['id_admin']);
        echo "<script>location='index.php?halaman=profil'</script>";
    }
    else
    {
        //Jika username dan password diubah
        //cara
        //1. Mencocokkan password lamanya dengan session $_POST['password_lama'] dengan data di session
        if ($_POST['password_lama']==$_SESSION['admin']['password']) {
            //2. Memastika password barunya gak kosong
            if (!empty($_POST['password_baru'])) {
                //maka dicoockkan password baru dengan konfirmasi password
                if ($_POST['password_baru']==$_POST['konfirmasi_password']) {
                    //ubah username dan passwordnya
                    $admin->ubah_profil($_POST['username'],$_POST['password_baru'],$_SESSION['admin']['password']);
                }
                else
                {
                    echo "<div class='alert alert-danger'>Konfirmasi Password Salah</div>";
                }

            }else
            {
                 echo "<div class='alert alert-danger'>Password Baru Tidak Boleh Kosong</div>";
            }
        }else
        {
             echo "<div class='alert alert-danger'>Password Lama Salah</div>";
        }
    }
}



 ?>