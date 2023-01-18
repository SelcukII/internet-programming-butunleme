<?php 
	error_reporting(0); // olası hata durumlarını engellemek için kullanılır.
	$_SESSION['uyarı'] = 0; // Geri bildirimleri aktifleştiren değişkene default olarak 0 değeri atanır aksi halde sayfa döngüye girer.
	session_start(); // giriş yapan kullanıcı oturumuna dair bilgiler geçici olarak tutulur.
if ($_SESSION['giris'] != "basarili") { // Kullanıcı sitede başarılı bir şekilde oturum açtıysa bu sayfayı görmesi engellenir.
	require 'header.php'; // header.php dosyası sayfaya dahil edilir.
?>

<section class="ftco-section ftco-project" id="projects-section">
    	<div class="container">
    		<div class="row no-gutters justify-content-center">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Hesap oluşturun</h2>
            <span class="subheading">Daha fazlası için Hesap Oluşturabilirsiniz.</span>
			        <div>
			          <form method="post" action="kullanici.php" class="col-12 text-center"> 	
			          	<?php if($_SESSION['uyarı'] == 1){ // uyarı bildirimi gelip gelmediği kontrol edilir. ?> 
			            	<div class="alert alert-<?php echo $_SESSION['statu']; ?> text-center" style="font-weight:bold;" role="alert"> <!-- sessin-statu geçici değişkenine atanan değere göre bildirimin hata(kırmızı) ya da başarılı(yeşil) durumlarına ait renk bilgisi gelir. -->
										  <?php echo $_SESSION['mesaj']; ?> <!-- Hata durumunda geçici değişkene atanan mesaj bildirimi ekrana yansıtılır. -->
										</div>
									<?php 
										$_SESSION['uyarı'] = 0; // uyarı değişkenine 0 değeri atanır aksi halde sayfa döngüye girer.
										header("Refresh: 3; url=sign.php"); // verilen url ye 3 saniye sonra yönlendirme ya da yenileme yapar.
										} 
									?>
			            <div class="row p-5  justify-content-center" style="border: 1px solid;">
			            	
									  <div class="col-md-6">
									    <input type="text" name="isim" class="form-control" placeholder="İsim" required>
									  </div>
									  <div class="col-md-6">
									    <input type="text" name="soyisim" class="form-control" placeholder="Soyisim" required>
									  </div>
									  <div class="col-md-12 mt-3">
									    <input type="email" name="mail" class="form-control" placeholder="Email" required>
									  </div>
									  <div class="col-md-6 mt-3">
									    <input type="password" name="sifre" class="form-control" placeholder="Şifre" required>
									  </div>
									  <div class="col-md-6 mt-3">
									    <input type="password" name="sifre2" class="form-control" placeholder="Şifre Tekrar" required>
									  </div>
									  <div class="col-md-12 mt-5">
									  	<button type="submit" name="kayitol" class="btn btn-outline-success p-3" style="border-radius: 0;">Kayıt ol</button>
									  </div>
								</div>
								<div class="mt-3">
									<a href="login.php" class="btn btn-outline-secondary p-2" style="border: 1px solid;border-radius: 0;">Bir hesabınız var mı öyleyse oturum açın.</a>
								</div>
            	</form>
            </div>
          </div>
        </div>
    </div>
</section>
<?php require 'footer.php'; ?> <!-- footer.php sayfası dahil edilir. -->
<?php }
		else
			header("Refresh: 0; url=index.php"); // kullanıcı sayfa da oturum açtıysa sayfayı görmesini engellemek için anlık olarak sayfayı index.php sayfasına yönelndiri.
 ?>
