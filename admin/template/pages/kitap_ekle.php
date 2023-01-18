<?php 

  include "header.php"; // header.php dosyası sayfaya dahil edilir.
  
  $ekle = $_POST['btnEkle'];
  $cik = $_POST['btnCancel'];
  $kitapAd = $_POST['kitapAd'];
  $kitapAciklama = $_POST['kitapAciklama'];
  $fotoAd = $kitapAd;
  $btnUpdate = $_POST['btnUpdate'];
// değişken atamaları yapılır.
  $fotoAd = str_replace(" ", '-', $fotoAd);// fotoğraf ismi düzenlenir.
  $kitapAciklama = str_replace("'","&#96",$kitapAciklama); // açıklama kısmındaki metin içerisinde tek tırnak ibaresi yer alıyorsa unicode olarak değiştirilir aksi halde veri vt tarafına yüklenirken hata verir.

  if (isset($ekle)) {// ekleme butonu dinlenir.

    $kitapSor = $db->query("SELECT * FROM tbl_books WHERE book_isim = '$kitapAd'"); // kitap ismi vt tarafında daha önce olup olmadığı sorgulanır.
    $say = $kitapSor->fetchColumn();

    if ($say > 0) {// kitap bilgisi sorgulanır ve duruma göre olumlu yada olumsuz mesaj bildirilir.
      $yanit = "<b style= 'color:red;'> Aynı İsimde Bir Kitap Bulunuyor. '$fotoAd' !</b>";
    }
    else{// şart sağlanıyorsa fotoğraf dosya konumu belirtilir. Ve vt tarafına veri eklemesi yapılır.
      $kitapFoto = "/assets/images/kitaplar/$fotoAd.png";
      $kitapEkle = $db->query("INSERT INTO tbl_books( book_isim, book_aciklama, book_foto) VALUES ('$kitapAd','$kitapAciklama','$kitapFoto')");

    if ($kitapEkle){

      if ($_FILES["kitapFoto"]) {// güncelleme butonu dinlenir.

        $yol = "../assets/images/kitaplar";// fotoğraf dosya konumu tanımlanır.
        
        $_FILES["kitapFoto"]["name"] = "$fotoAd.png";// fotoğraf dosya isimlendirmesi yapılır.

        $yuklemeYeri = __DIR__ . DIRECTORY_SEPARATOR . $yol . DIRECTORY_SEPARATOR . $_FILES["kitapFoto"]["name"];// yükleme yeri işlenir.

            if ($_FILES["kitapFoto"]["size"]  > 1000000) {// yüklenen dosya boyutu istenileni aşmadığı sürece şart sağlanır.

                $yanit = "<p style='color: red; font-weight:bold;'>Dosya Boyutu Sınırı Aşıldı !</p>";

            } else {

                $dosyaUzantisi = pathinfo($_FILES["kitapFoto"]["name"], PATHINFO_EXTENSION);// dosya uzantısı bir değişkene atanır.

                if ($dosyaUzantisi != "jpg" && $dosyaUzantisi != "png") {// dosya uzantısının istenilen biçimde olup olmadığı kontrol edilir.

                    $yanit = "<p style='color:#e1a237; font-weight:bold;'>Sadece jpg ve png uzantılı dosyalar yüklenebilir ! </p>";

                } else {

                    $sonuc = move_uploaded_file($_FILES["kitapFoto"]["tmp_name"], $yuklemeYeri);// belirtilen dosya yoluna dosya yüklenir.

                    $yanit = $sonuc ? "<p style='color:green; font-weight:bold;'>Dosya başarıyla yüklendi !</p>" : "<p style='color: red; font-weight:bold;'>Hata oluştu !</p>";                  
            }

        }

// şartlar sağlanmadı ise mesaj bildirimleri yapılır.
      } else {

        $yanit = "Lütfen bir dosya seçin";

      }
      $yanit = "<b style= 'color:green;'> İşlem Başarılı. !</b>";
    }
    else
      $yanit = "<b style= 'color:red;'> İşlem Başarısız. !</b>";

    }
    ?>
      <!-- belirtilen adrese 2.5 saniye sonra yönlendirme yapılır. -->
      <script type="text/javascript">
          setTimeout(function(){   
          window.location.assign("kitap_ekle.php");}, 2500);
      </script>
    <?php

  }
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
             <div class="page-header">
              <h3 class="page-title"><?php echo $yanit; ?></h3>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Kitap Ekleme</h4>
                    <?php echo $tut; ?>
                    <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Kitap Adı</label>
                        <input type="text" class="form-control"  placeholder="Kitap Adı" name="kitapAd" required>
                      </div>
                      <div class="form-group">
                        <label>Kitap Foto</label>
                        <input type="file" name="kitapFoto" class="file-upload-default" required>
                        <div class="input-group col-xs-12">
                          <input type="text" name="bitkiFoto" class="form-control file-upload-info" disabled placeholder="Fotoğraf Yükleyin. (Zorunlu Alan)">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Kitap Açıklama</label>
                        <textarea class="form-control"  placeholder="Kitap Açıklama" name="kitapAciklama" required ></textarea>
                      </div>
                      <button type="submit" name="btnEkle" class="btn btn-success mr-2">Ekle</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- Footer -->
<?php include "footer.php"; ?>
