<?php 
  include '../../ayar.php';// vt bağlantısı dahil edilir.
  session_start();// session başlatılır.

if(!isset($_SESSION["login"])){// giriş başarılı değilse belirtilen adrese yönlendirme yapılır.
 header("Location:../../index.php");
}else{
  $session_name = $_SESSION['user_name'];// geçici değişkene giriş yapan kullanıcı ismi atanır.
  $user_check = $db->query("SELECT * FROM tbl_user WHERE name = '$session_name'")->fetch(PDO::FETCH_ASSOC); // kullanıcı tablosundan giriş yapan kullanıcı verileri çekilir.
 ?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.php -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <style type="text/css">
            .sidebar .sidebar-brand-wrapper .sidebar-brand:hover{
              color: #00AC4A !important;
            }
          </style>
          <a class="sidebar-brand brand-logo" href="../index.php" style="color:#fff; text-decoration: none;">Admin Panel</a>
          <a class="sidebar-brand brand-logo-mini" href="../index.php"></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="../assets/images/faces/<?php echo $user_check['profile']; ?>" alt=""><!-- kullanıcya ait fotoğraf bilgisi çekilir. -->
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal" style="text-transform:uppercase"><?php echo $session_name; ?></h5><!-- giriş yapan kullanıcıya ait isim bilgisi çekilir. -->
                  <span><?php echo $user_check['yetki']; ?></span> <!-- giriş yapan kullanıcı yetkisi çekilir. -->
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="panel_ayarlar.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Hesap Ayarları</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Sayfalar</span>
          </li>
          <?php
            $session_yetki = $user_check['yetki'];// kullanıcı yetkisi değişkene atanır.
            if($session_yetki != "Admin"){// atanan değer "Admin" değerine karşılık gelmiyorsa şart sağlanır.
              $sayfaCek = $db->query("SELECT * FROM admin_page WHERE yetki = '$session_yetki' GROUP BY id ASC"); // burada amaçlanan şey admin kullanıcısı her panel sayfasına erişim sağlayabilirken User rolündeki bir kişi sadece izin verilen sayfalara erişim sağlayabilir.
            }
            else{
              // şart sağlanmıyorsa sayfa bilgisi çekilir
              $sayfaCek = $db->query("SELECT * FROM admin_page GROUP BY id ASC");
            }

           ?>
           <li class="nav-item menu-items">
            <a class="nav-link" href="panel_ayarlar.php">
              <span class="menu-icon">
               <!-- <i class="mdi mdi-speedometer"></i>-->
                <i class="mdi mdi-settings"></i>
              </span>
              <span class="menu-title">Ayarlar</span>
            </a>
          </li>
          <?php 
            foreach ($sayfaCek as $sayfaCek) {// sorgudan dönen değer kadar döngü çalışır.
           ?>
          <li class="nav-item menu-items">
            <a class="nav-link" href="<?php echo $sayfaCek['url']; ?>"><!-- sayfa buton linki vt tarafından çekilir. -->
              <span class="menu-icon">
               <!-- <i class="mdi mdi-speedometer"></i>-->
                <i class="<?php echo $sayfaCek['icons']; ?>"></i><!-- sayfa iconu vt tarafından çekilir. -->
              </span>
              <span class="menu-title"><?php echo $sayfaCek['name']; ?></span><!-- sayfa isim bilgisi vt tarafından çekilir. -->
            </a>
          </li>
        <?php } ?>

        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.php -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.php" style="color:#fff;">Admin Panel</a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="İçerik Ara">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="../assets/images/faces/<?php echo $user_check['profile']; ?>" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name" style="text-transform:uppercase"><?php echo $session_name ?></p><!-- giriş yapan kullanıcı adı ekrana bastırılır. -->
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="panel_ayarlar.php">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Ayarlar</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="../../logout.php">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Çıkış Yap</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
<?php } ?>
