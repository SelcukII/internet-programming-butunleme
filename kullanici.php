<?php
	error_reporting(0); // olası tüm hata mesajları gizlenir.
	session_start(); // session başlatılır.
if ($_SESSION['giris'] != "basarili") { // kullanıcı sayfaya giriş yaptıysa bu sayfayı görmesi engellenir.
	require 'admin/ayar.php'; // vt bağlantısı sayfaya dahil edilir.

	$isim 	 = $_POST['isim']; // formdan gelen isim bilgisi değişkene atanır.
	$soyisim = $_POST['soyisim']; // formdan gelen soyisim bilgisi değişkene atanır.
	$mail 	 =  $_POST['mail']; // formdan gelen mail bilgisi değişkene atanır.
	$sifre 	 = $_POST['sifre']; // formdan gelen şifre bilgisi değişkene atanır.
	$sifre2  = $_POST['sifre2']; // formdan gelen tekrar şfire kontrolü değişkene atanır.

	$btnKayit = $_POST['kayitol']; // kayit ol butonu dinlenir.
	$btngiris = $_POST['girisyap']; // giriş yap butonu dinlenir.

	$kontrol_Say = 0; // kayıt yapmaya çalışılan mail bilgisinin vt tarafında sorgusu yapılır daha önceden kayıtlı olup olmadığına dair değer tutulur.

	if (isset($btnKayit)){ // kayıt butonu dinlenir.

		$mail_kontrol = $db->query("SELECT * FROM tbl_kullanicilar WHERE kullanici_mail='$mail'"); //girilen mail bilgisi vt de sorgulanır.
		$kontrol_Say = $mail_kontrol->fetchColumn(); // sorgu sonucu ortaya veri çıkarsa veri sayısı çıkmazsa 0 değeri değişkene atanır.
		if ($kontrol_Say < 1) { // dönen değer 1 den küçük bir değerse koşul çalışır.
			if ($sifre == $sifre2) { // girilen şifrelerin aynı olup olmadığı konrol edilir.
				$kullanici_ekle = $db->query("INSERT INTO tbl_kullanicilar(kullanici_isim, kullanici_soyisim, kullanici_mail, kullanici_sifre) VALUES ('$isim','$soyisim','$mail','$sifre')"); // tüm şartlar sağlanıyora vt tarafında gelen bilgiler kaydedilir.
				if ($kullanici_ekle) {
					$_SESSION['uyarı'] = 1;$_SESSION['statu'] = "success";$_SESSION['mesaj'] = "Kullanıcı Başarıyla Eklendi. !";
				}else{
					$_SESSION['uyarı'] = 1;$_SESSION['statu'] = "danger";$_SESSION['mesaj'] = "Kullanıcı Eklenirken Bir Sorun Oluştu. !";
				}// işlem sonuçlarına göre mesaj bildirimleri geçici değişkenlere atanır ve ekrana bastırılır.
			}
			else{
				$_SESSION['uyarı'] = 1;$_SESSION['statu'] = "danger";$_SESSION['mesaj'] = "Şifreler Aynı Olmalıdır. !"; // şifrelerin hatalı olması durumudna geçici değişkene hata mesajı hata statusu atanır ve uyarı bildirimleri aktif edilir.
			}
		}else{
			$_SESSION['uyarı'] = 1;$_SESSION['statu'] = "danger";$_SESSION['mesaj'] = "Bu Mail Adresi Kullanılıyor. !"; // mail adresine dair yapılan sorgu sonucu kullanıcıya bildirim verilir.
		}
		header("Refresh: 0; url=sign.php"); // tüm işlemler sonucunda belirtilen adrese yönlendirme yapılır.
	}
	if (isset($btngiris)) { // giriş yap butonu dinlenir.
		
		$kullanici_kontrol = $db->query("SELECT * FROM tbl_kullanicilar WHERE kullanici_mail = '$mail'")->fetch(PDO::FETCH_ASSOC); // giriş yapan kullanıcıya ait bilgiler çekilir.
		if($kullanici_kontrol){ // kullanıcı bulunduysa şart sağlanır.
			if($sifre == $kullanici_kontrol["kullanici_sifre"]){ // form tarafında girilen veri ile vt tarafındaki şifre ile eşleşmesi kotnrol edilir.
				$_SESSION['giris']= "basarili"; // şifre bilgisi uyuşuysa geçici session değişkenine giriş durumu bildirilir.
				$_SESSION['isim'] = $kullanici_kontrol["kullanici_isim"]; // geçici session değişkenine giriş yapan kullanıcı ismi atanır.
				header("Refresh: 0; url=index.php"); // belirtilen adrese yönlendirme yapılır.
			}else{
				$_SESSION['uyarı'] = 1;$_SESSION['statu'] = "danger";$_SESSION['mesaj'] = "Parola yada Mail Adresi Hatalı. !";
				header("Refresh: 0; url=login.php"); // yapılan işlem sonucu oluşan hata durumu kullanıcıya bildirilir.
			}
		}else{
			$_SESSION['uyarı'] = 1;$_SESSION['statu'] = "danger";$_SESSION['mesaj'] = "Bu bilgilere Ait Bir Kullanıcı Bulunamadı. !";
			header("Refresh: 0; url=login.php");// yapılan işlem sonucu oluşan hata durumu kullanıcıya bildirilir.
		}
	}
	if (!$_POST) {
		header("Refresh: 0; url=index.php"); // eğer yetkisiz bir giriş yapılmak istenirse girişi engellemek için sayfa index.php sayfasına otomatik olarak yönlendirilir.
	}
}else
	header("Refresh: 0; url=index.php"); // site içeriğinde kullanıcı oturumu başarılı bir şekilde açtıysa bu sayfaya girmesi engellenir.
 ?>
