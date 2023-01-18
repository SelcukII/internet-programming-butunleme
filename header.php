<?php 
	require "admin/ayar.php"; // vt bağlantısının yapıldığı dosya sayfaya dahil edilir.
	$kitap_cek = $db->query("SELECT * FROM tbl_books GROUP BY id DESC")->fetchAll(PDO::FETCH_ASSOC); // son çıkan kitaplar kısmı için en sondan en başa doğru şekilde kitab bilgileri vt den çekilir.
	$satır_say = $db->query("SELECT * FROM tbl_books")->fetchAll(PDO::FETCH_ASSOC); // kaç ader kitap bilgisi vt de kayıtlı olduğuna dair sayaç oluşturmak için veri çekilir.
	$satir = 0;
	foreach ($satır_say as $satır_say) {$satir++;} // veri sayısı kadar $satir değişkeni artar buradan elde edilen değer product.php sayfasındaki ürünlerin sayfalaması amaçlı kullanılır.
	 $footer = $db->query("SELECT * FROM tbl_footer")->fetch(PDO::FETCH_ASSOC); // admin panelinden düzenlenebilen veriler için vt den veri çekilir.
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Book Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
	  
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Book<span> Store</span></a>
	      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link"><span>Anasayfa</span></a></li>
	          <li class="nav-item"><a href="about.php" class="nav-link"><span>Hakkımızda</span></a></li>
	          <li class="nav-item"><a href="product.php" class="nav-link"><span>Ürünler</span></a></li>
	          <li class="nav-item"><a href="contact.php" class="nav-link"><span>İletişim</span></a></li>
	          <?php session_start(); // session başlatılır. ?>
	          
	          <li class="nav-item">
	          	<div class="btn-group">	  
						<?php if($_SESSION['giris']=="basarili"){ ?> <!-- giriş işlemi başarılı bir şekilde gerçekleştiyse kullanıcı adının görünmesi için hazırlanan alan aktif edilir. -->
							<button type="button" class="nav-link dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="background-color:transparent; color: #000; text-transform: uppercase; font-weight: bold;">
	          	<?php echo $_SESSION['isim']; ?> <!-- geçici değişkene atanan kullanıcı adı ekrana bastrılır. -->
	          	</button>
	          	<div class="dropdown-menu">
							    <a class="dropdown-item" href="logout.php" style="color: red;">ÇIKIŞ YAP</a>
							  </div>
							</div>
	          <?php 
	          }else{ ?> <!-- kullanıcı henüz giriş yapmadıysa oturum aç butonu aktifleştirilir. -->
	          	<li class="nav-item"><a href="login.php" class="nav-link" style="border: 1px solid; text-transform: uppercase;"><span>Oturum Aç</span></a></li>
	          <?php } ?>
	          </li>
	        </ul>
	      </div>
	    </div>
	  </nav>
