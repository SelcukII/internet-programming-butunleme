<?php 
  session_start(); // sessiın başlatılır.
  include 'ayar.php'; // vt bağlantısı sayfaya dahil edilir.

  $giris = $_POST['giris']; // giriş butonu dinlenir.
  $username = $_POST['username']; // isim bilgisi değişkene atanır.
  $passwd = $_POST['passwd']; // şifre bilgisi değişkene atanır.
  $kontrol = 0;

  if (isset($giris)) {
    $girisSor = $db->query("SELECT * FROM tbl_user WHERE name = '$username'")->fetch(PDO::FETCH_ASSOC); // girilen isime ait bilgi olup olmadığı sorgulanır bilgi elde edilirse kişi bilgisi çekilir.

    if ($girisSor) { // giriş bilgisi bulunduysa şart sağlanır.

      $gelenPasswd = $passwd; // formdan girilen şifre bilgisi geçici değişkene atanır.
      $encrypt_method = 'AES-256-CBC';
      $secret_key = '11*_33';
      $secret_iv = '22-=**_';
      $key = hash('sha256', $secret_key); 
      $iv = substr(hash('sha256', $secret_iv), 0, 16); 

      $sifrelendi = openssl_encrypt($gelenPasswd,$encrypt_method, $key, false, $iv);
      // buraya kadar olan kısımda giriş yapmak isteyen kullanıcı bilgileri md5 diye isimlendirilen şifreleme yöntemiyle forma girilen şifre bilgisi şifrelenir. bu şifreleme vt tarafında kullanıcıya ait olan şifrelemesiyle karşılaştırılır.
      if ($girisSor['passwd'] == $sifrelendi) { // formdan gelen şifrenin şifrelenmiş hali ile vt tarafındaki şifreleme karşılaştırılır eğer eşleşiyorsa şart sağlanır.
        $kontrol = 1; // burada giriş işleminin başarılı olduğuna dair değişkene 1 değeri atanır.
      }

      switch ($kontrol) { // switch-case yapısında $kontrol değişkenine gelen değer dinlenir. Girilen değere göre kod blokları çalışır.

      case '1': // girilen değer 1 ise;
        $_SESSION["login"] = "true";
        $_SESSION['user_name'] = $username;

        header("Location:admin.php");
        break;// login geçici değişkenine true değeri atanır ve kullanıcının giriş yaptığı onaylanır. username değişkenine kullanıcı adı atanır. akabinde sayfa belirtilen adrese yönlendirilir.

      case '0':// girilen değer 0 ise
        
        break;// kullanıcı girişi başarısız olmuştur ve hiç bir işlem yapılmaz.
      }
    }
  }

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="template/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="template/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="template/assets/css/style.css">
    <!-- End layout styles -->

  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Login</h3>

                <form action="" method="post">
                  <div class="form-group"> 
                    <label>Username *</label>
                    <input type="text" class="form-control p_input" name="username">
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="Password" class="form-control p_input" id="pass" name="passwd">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <input type="checkbox" id="passshow" name="" class="form-check-input" onclick="sifre_göster()"> Şifreyi Göster
                    </div>
                    <!--
                    <a href="#" class="forgot-pass">Forgot password</a>
                  -->
                  </div>
                  <div class="text-center">
                    <input type="submit" style="height: 50px;" class="btn btn-primary btn-block enter-btn" name="giris">
                  </div>
                </form>

              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <script type="text/javascript">
      var passshow = document.getElementById("passshow");
      var pass = document.getElementById("pass");

      function sifre_göster(){
      if (passshow.checked)
          pass.type = "text";  
      if(!passshow.checked)
        pass.type = "password";
      }
      
    </script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>
