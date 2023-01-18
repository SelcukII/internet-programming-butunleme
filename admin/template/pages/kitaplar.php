<?php include "header.php"; 

    $btnSil = $_POST['btnDelete'];
    $gelenİd = $_POST['gelenİd'];
    $gelenName = $_POST['gelenName'];
    $ExfotoUrl = $_POST['fotoUrl'];
    $NewFotoUrl = "../assets/images/kitaplar/";
    $btnUpdate = $_POST['btnUpdate'];
    $updFoto = $_POST['updFoto'];
    $updName = $_POST['updName'];
    $updAciklama = $_POST['updAciklama'];
    $updDetay = $_POST['updDetay'];
    $namefile = $_POST['namefile'];
    $updBitkiler = $_POST['updBitkiler'];
    $fotoName = $updName;
// tüm form elementleri ve butonlar değişkenlere atanır.
    $fotoName = str_replace(" ", '-', $fotoName);// burada eklenen kitap bilgisine ait olan fotoğraf ismini tutacak değişken içerisinde boşluk(space) değeri "-" değeri ile değiştirilir böylece dosyanın hatalı olması durumu önlenir.
    
    if (isset($btnUpdate)) {// güncelleme butonu dinlenir.

      if (!empty($_FILES["kitapFoto"])) {// fotoğraf yüklendiyse şart sağlanır.

        $yol = "../assets/images/kitaplar";// fotoğraf dosya konumu tanımlanır.
        
        $_FILES["kitapFoto"]["name"] = "$fotoName.png";// fotoğraf dosya isimlendirmesi yapılır.

        $yuklemeYeri = __DIR__ . DIRECTORY_SEPARATOR . $yol . DIRECTORY_SEPARATOR . $_FILES["kitapFoto"]["name"];// yükleme yeri işlenir.

            if ($_FILES["kitapFoto"]["size"]  > 1000000) {// yüklenen dosya boyutu istenileni aşmadığı sürece şart sağlanır.

                $yanit = "<p style='color: red; font-weight:bold;'>Dosya Boyutu Sınırı Aşıldı !</p>";

            } else {

                $dosyaUzantisi = pathinfo($_FILES["kitapFoto"]["name"], PATHINFO_EXTENSION);// dosya uzantısı bir değişkene atanır.

                if ($dosyaUzantisi != "jpg" && $dosyaUzantisi != "png") { // dosya uzantısının istenilen biçimde olup olmadığı kontrol edilir.

                    $yanit = "<p style='color:#e1a237; font-weight:bold;'>Sadece jpg ve png uzantılı dosyalar yüklenebilir ! </p>";

                } else {

                    $sonuc = move_uploaded_file($_FILES["kitapFoto"]["tmp_name"], $yuklemeYeri);// belirtilen dosya yoluna dosya yüklenir.

                    $yanit = $sonuc ? "<p style='color:green; font-weight:bold;'>Dosya başarıyla yüklendi !</p>" : "<p style='color: red; font-weight:bold;'>Hata oluştu !</p>";

                    $kitapFoto = "/assets/images/kitaplar/$fotoName.png";// dosya konumu değişkene atanır.
            }

            $islem = rename("../assets/images/kitaplar/$namefile.png", "../assets/images/kitaplar/$fotoName.png");// dosya yeniden isimlendirilir.
            if ($islem)// işlem sonucuna göre olumlu yada olumsuz mesaj bildirimi verilir.
              $yanit = "<b style= 'color:green;'> İşlem Başarılı. !</b>";
            else
              $yanit = "<b style= 'color:red;'> İşlem Başarısız. !</b>";
            $kitap_update = $db->query("UPDATE tbl_books SET book_isim='$updName', book_aciklama='$updAciklama',book_foto='$kitapFoto' WHERE id = '$gelenİd'");
            // fotoğraf bilgisi güncellendikten sonra girilen diğer inputlar da vt tarafına işlenir.
        }
  }

    else
    {
        // eğer bir dosya yüklenmemişse dosya ismi değişikliğine karşı olarak güncellenen isim ile dosya adı güncellenir.
        $islem = rename("../assets/images/kitaplar/$namefile.png", "../assets/images/kitaplar/$fotoName.png");
        if ($islem)// işlem sonucuna göre olumlu yada olumsuz mesaj bildirilir.
          $yanit = "<b style= 'color:green;'> İşlem Başarılı. !</b>";
        else
          $yanit = "<b style= 'color:red;'> İşlem Başarısız. !</b>";

    }

    ?>
      <!-- belirtilen adrese 2.5 saniye sonra yönlendirme yapılır. -->
      <script type="text/javascript">
          setTimeout(function(){   
          window.location.assign("kitaplar.php");}, 2500);
      </script>
    <?php

  }


    if (isset($btnSil)) {// silme butonu dinlenir.
      $kitap_sil = $db->query("DELETE FROM tbl_books WHERE id='$gelenİd'"); // seçilen kitap verisi vt tarafından kalıcı olarak silinir.
      if ($kitap_sil){// işlem sonucuna göre olumlu yada olumsuz mesaj bildirilir.
        $sonuc = unlink("..".$ExfotoUrl);// kitap bilgisine ait olan fotoğraf dosyası silinir.
        $yanit = "<b style= 'color:green;'> İşlem Başarılı. !</b>";
      }
      else
        $yanit = "<b style= 'color:red;'> İşlem Başarısız. !</b>";
      ?>
      <!-- belirtilen adrese 2.5 saniye sonra yönlendirilir. -->
      <script type="text/javascript">
          setTimeout(function(){   
          window.location.assign("kitaplar.php");}, 2500);
      </script>
    <?php
    }
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> <?php echo $yanit." ".$yanit2; ?> </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">KİTAPLAR</h4>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Kitap Foto </th>
                            <th> Kitap Adı </th>
                            <th> Kitap Açıklama </th>
                            <th> İşlem </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $counter = 0;
                            $socSor = $db->prepare("SELECT * FROM tbl_books GROUP BY id ASC");// kitap bilgisi id sıralamasına göre vt tarafından çekilir ve tablo içerisinde listelenir.
                            $socSor->execute();
                            $socCek = $socSor->FetchAll(PDO::FETCH_ASSOC);
                            foreach ($socCek as $socCek) { // döngü veri sayısı kadar çalışır.
                                $counter++;
                          ?>
                          <tr>
                            <td>
                              <?php echo $counter; ?>
                            </td>
                            <td class="py-1">
                              <img src="../<?php echo $socCek['book_foto']; ?>" alt="image" /><?php echo $socCek["book_foto"]; ?><!-- çekilen kitap bilgisine ait fotoğraf dosyası çağırılır. -->
                            </td>
                            <td id="isim" style="text-transform:uppercase; font-weight: bold; color:#fff; font-size:12px;"> <?php echo $socCek['book_isim']; ?> </td> <!-- çekilen kitap bilgisine göre isim bilgisi çekilir. -->

                            <td > <textarea class="form-control" disabled style="background-color:#191C24;"><?php echo $socCek['book_aciklama']; ?></textarea> </td> <!-- çekilen kitao bilgisine göre açıklama bilgisi çeklir. -->
                           
                            <td>
                              <!-- kitap bilgisi düzenlenmek istenirse kitaba ait veriler pop-up penceresine jquery yardımıyla aktarılır. -->
                                <button type="button" class="btn btn-outline-success editbook" data-toggle="modal" data-name="<?php echo $socCek["book_isim"]; ?>" data-aciklama="<?php echo $socCek["book_aciklama"]; ?>" data-foto="<?php echo $socCek["book_foto"]; ?>"data-id="<?php echo $socCek["id"]; ?>" data-target="#exampleModal"> 
                                <i class="mdi mdi-table-edit"></i>Düzenle
                              </button>

                              <!-- kitap bilgisi silinmek istenirse silme pop-up penceresine jquery yardımıyla aktarılır. -->
                              <button class="btn btn-outline-danger deleteBook" data-name="<?php echo $socCek["book_isim"] ?>" data-foto="<?php echo $socCek["book_foto"] ?>" data-id="<?php echo $socCek["id"] ?>" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-delete-forever"></i> Sil
                              </button>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <!-- Modal UPDATE-->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"> Kitap Bilgilerini Güncelle</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <div class="modal-body">
                            <div class="card">
                              <div class="card-body">
                                <form class="forms-sample" action="" method="POST"enctype="multipart/form-data">
                                  <input type="hidden" name="gelenİd" id="value">
                                  <div class="form-group row">
                                    <label for="exampleInputUsername2" id="veri2" class="col-sm-3 col-form-label">Kitap Foto</label>
                                    <div class="col-sm-9">
                                      <input type="hidden"  id="foto" class="form-control" name="updFoto">
                                      <input type="hidden"  id="namefile" class="form-control" name="namefile">
                                      <input type="file" class="form-control" placeholder="Bitki Foto" name="kitapFoto">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kitap Adı</label>
                                    <div class="col-sm-9">
                                      <input id="name" type="text" class="form-control" name="updName"  placeholder="" required>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kitap Açıklama</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="aciklama" name="updAciklama" placeholder="" required>
                                    </div>
                                  </div>
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kapat</button>
                                    <button type="submit" class="btn btn-outline-primary" name="btnUpdate" id="btnUpdateSubmit">Değişiklikleri Kaydet</button>
                                </form>
                              </div>
                            </div>
                                </div>
                              </div>
                            </div>
                          </div>
                           
                          <!-- Modal DELETE-->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4  style="text-transform:uppercase;" class="modal-title" id="myModalLabel"></h4>
                                      </div>
                                      <div class="modal-body" style="height:120px">
                                          <form class="form-control" method="POST" action="">
                                              <input type="hidden" id="socid" name="gelenİd">
                                              <input type="hidden" id="fotoUrl" name="fotoUrl">
                                              <input type="hidden" id="gelenName" name="gelenName">
                                              <p>
                                                Bu Kitabı Silmek İstediğinize Emin Misiniz ?

                                              </p>
                                              <br>
                                                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Kapat</button>
                                                  <button type="submit" name="btnDelete" class="btn btn-outline-danger">SİL</button>
                                          </form>
                                      </div>
                                  </div>
                                  <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->
                      </td>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $('.editbook').click(function (event) {
        var name = $(this).attr("data-name");
        var foto = $(this).attr("data-foto");
        var aciklama = $(this).attr("data-aciklama");
        var bitkiler = $(this).attr("data-bitkiler");
        var id = $(this).attr("data-id");
        var imgfoto = document.getElementById("imgfoto");

        $("#name").val(name);
        $("#aciklama").val(aciklama);
        $("#value").val(id);
        $("#foto").val(foto);
        $("#fotoUrl").val(foto);
        $("#namefile").val(name);
    })

    $('.deleteBook').click(function (event) {
        var name = $(this).attr("data-name");
        var foto = $(this).attr("data-foto");
        var socid = $(this).attr("data-id");
        var fotoUrl = document.getElementById("fotoUrl");

        $("#myModalLabel").text(name);
        fotoUrl.value = foto;
        $("#socid").val(socid);
        $("#gelenName").val(name);
    })

</script>

<?php include "footer.php"; ?>
