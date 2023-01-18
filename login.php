<?php 
	error_reporting(0);// oluşabilecek tüm hata kodları gizlenir.
	$_SESSION['uyarı'] = 0; // uyarı mesajının aktifliğine default 0 atanır.
	session_start(); // session başlatılır.
if ($_SESSION['giris'] != "basarili") { // eğer kullanıcı sayfada oturum açtıysa bu sayfayı görmesi engellenir
	require 'header.php';
?>
<section class="ftco-section ftco-project" id="projects-section">
    	<div class="container">
    		<div class="row no-gutters justify-content-center">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Giriş Yapın</h2>
			<span class="subheading">Daha fazlası için giriş yapabilirsiniz.</span>
            <div>
            	<form method="post" action="kullanici.php" class="col-12 text-center">
            	<?php if($_SESSION['uyarı'] == 1){ ?>
            		<div class="alert alert-<?php echo $_SESSION['statu']; ?> text-center" style="font-weight:bold;" role="alert">
			  			<?php echo $_SESSION['mesaj']; ?> <!-- burada sayfa içerisinde yapılan işlemler sonucu oluşan bildirimler bastırılır. -->
					</div>
				<?php 
					$_SESSION['uyarı'] = 0; // sayfanın döngüye girmemesi için 0 atanır.
					header("Refresh: 3; url=login.php"); // sayfa belirtilen url adresine yönlendirilir.
					} 
				?> 	
            		<div class="row p-5" style="border: 1px solid;">
					  <div class="col-md-12 mt-3">
					    <input type="email" name="mail" class="form-control" placeholder="Email" required>
					  </div>
					  <div class="col-md-12 mt-3">
					    <input type="password" name="sifre" class="form-control" placeholder="Şifre" required>
					  </div>
					  <div class="col-md-12 mt-5">
					  	<button type="submit" name="girisyap" class="btn btn-outline-success p-3" style="border-radius: 0;">Giriş Yap</button>
					  </div>
					</div>
					<div class="mt-3">
						<a href="sign.php" class="btn btn-outline-secondary p-2" style="border: 1px solid;border-radius: 0;">Hesabınız Yok mu Bir hesap oluşturun.</a>
					</div>
            	</form>
            </div>
          </div>
        </div>
    </div>
</section>

<?php require 'footer.php'; // footer.php sayfası dahil edilir. ?> 
<?php }
		else
			header("Refresh: 0; url=index.php"); // kullanıcı siteye giriş yaptıysa belirtilen adrese yönlendirilir.
 ?>
