<?php 
  
  include 'header.php'; // header.php dosyası sayfaya dahil edilir. 
    
  $iletisim_cek = $db->query("SELECT * FROM  tbl_footer"); // footer bilgisi vt tarafından çekilir.

  $updaciklama = $_POST['updaciklama'];
  $aciklama = $_POST['aciklama'];
  $btnUpdate = $_POST['btnUpdate'];
  $gelenİd = $_POST['gelenİd'];
  $upadres = $_POST['upadres'];
  $uptel = $_POST['uptel'];
  $upmail = $_POST['upmail'];
  $upinstagram = $_POST['upinstagram'];
  $uptiktok = $_POST['uptiktok'];
  $upyoutube = $_POST['upyoutube'];
  $upfacebook = $_POST['upfacebook'];
// tüm güncelleme formu tarafından gelen input değerleri değişkenlere atanır.

  if (isset($btnUpdate)) { // güncelleme butonu dinlenir.
    $adres_update = $db->query("UPDATE tbl_footer SET telefon='$uptel',adres='$upadres',mail='$upmail',insta='$upinstagram',youtube='$upyoutube',facebook='$upfacebook' WHERE id = '1'"); // adres bilgisine dair olan tüm bilgiler güncellenir.
    if ($adres_update)// işlem sonucuna göre olumlu yada olumsuz şekilde bildirim kullanıcıya verilir.
      $yanit = "<b style='color:green; font-weight:bold;'>Güncelleme İşlemi Başarıyla Gerçekleşti. !</b>";
    else
      $yanit = "<b style='color:red; font-weight:bold;'>Güncelleme İşlemi Gerçekleşirken Bir Sorun Oluştu. !</b>";
    ?>
    <!-- işlem sonucunda sayfa 2 saniye sonra belirtilen adrese yönlendirilir. -->
      <script type="text/javascript">
          setTimeout(function(){   
          window.location.assign("site_iletisim.php");}, 2000);
      </script>
    <?php
  }

  if (isset($updaciklama)) {// açıklama bilgisi güncelleme butonu dinlenir.
    $aciklama_update = $db->query("UPDATE tbl_footer SET footer_aciklama='$aciklama' WHERE id = '1'");// girilen açıklama bilgisi vt tarafında güncellenir.
    if ($aciklama_update)// işlem sonucuna göre olumlu yada olumsuz mesaj bildirimi kullanıcıya verilir.
      $yanit = "<b style='color:green; font-weight:bold;'>Açıklama Güncelleme İşlemi Başarıyla Gerçekleşti. !</b>";
    else
      $yanit = "<b style='color:red; font-weight:bold;'>Açıklama Güncelleme İşlemi Gerçekleşirken Bir Sorun Oluştu. !</b>";
    ?>
    <!-- işlem sonucunda sayfa 2 saniye sonra belirtilen adrese yönlendirilir. -->
      <script type="text/javascript">
          setTimeout(function(){   
          window.location.assign("site_iletisim.php");}, 2000);
      </script>
    <?php
  }

?>
        <div class='main-panel'>
          <div class='content-wrapper'>
          <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">İletişim Bilgileriniz</h4>
                    <p class="card-description"><?php echo $yanit; ?></p>
                    <div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Adres </th>
                            <th> Telefon </th>
                            <th> Mail Adresi </th>
                            <th> İnstagram </th>
                            <th> Youtube </th>
                            <th> Facebook </th>
                            <th> İşlem </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($iletisim_cek as $iletisim_cek) {?><!-- iletişim bilgilerinin yer aldığı vt tablsoundan veriler çekilir ve listelenir. -->
                          <tr>
                            <td> 1 </td>
                            <td> <?php echo $iletisim_cek['adres']; ?> </td>
                            <td> <?php echo $iletisim_cek['telefon']; ?> </td>
                            <td> <?php echo $iletisim_cek['mail']; ?> </td>
                            <td> <?php echo $iletisim_cek['insta']; ?> </td>
                            <td> <?php echo $iletisim_cek['youtube']; ?> </td>
                            <td> <?php echo $iletisim_cek['facebook']; ?> </td>
                            <td>
                              <!-- burada yer alan php alanlarında özet olarak şöyle işler; tüm bilgiler vt tarafından alınır düzenleme ksımı için açılan pop-up ekranında görüntülenmek için jquery yardımıyla gerekli alanlara yerleştirilir.-->
                              <button type="button" class="btn btn-outline-success editpage" data-toggle="modal" data-adres="<?php echo $iletisim_cek['adres']; ?>" data-tel="<?php echo $iletisim_cek['telefon']; ?>" data-mail="<?php echo $iletisim_cek['mail']; ?>" data-insta="<?php echo $iletisim_cek['insta']; ?>" data-youtube="<?php echo $iletisim_cek['youtube']; ?>" data-facebook="<?php echo $iletisim_cek['facebook']; ?>" data-id="<?php echo $iletisim_cek['id']; ?>" data-target="#exampleModal"> 
                                <i class="mdi mdi-table-edit"></i> Düzenle
                              </button>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">Footer Açıklaması</h4>
                    <div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Açıklama </th>
                            <th> İşlem </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> <?php echo $iletisim_cek['footer_aciklama']; ?> </td> <!-- açıklaam bilgisi vt tarafından çekilir. -->
                            <td>
                              <button type="button" class="btn btn-outline-success editfooter" data-toggle="modal" data-aciklama="<?php echo $iletisim_cek['footer_aciklama']; ?>" data-target="#myModal"> 
                                <i class="mdi mdi-table-edit"></i> Düzenle
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>

          <!-- Modal UPDATE-->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"> İletişim Bilgilerini Güncelle</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <div class="modal-body">
                            <div class="card">
                              <div class="card-body">
                                <form class="forms-sample" action="" method="post">
                                  <input type="hidden" name="gelenİd" id="upid">
                                  <div class="form-group row">
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Adres</label>
                                    <div class="col-sm-9">
                                      <textarea id="adres" class="form-control" name="upadres"  placeholder="Adres" required></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Telefon</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="tel" name="uptel" placeholder="Telefon Numarası" required>
                                     </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Mail Adresi</label>
                                    <div class="col-sm-9">
                                     <input type="text" id="mail" class="form-control" placeholder="Mail Adresi" name="upmail">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">İnstagram</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="instagram" name="upinstagram" placeholder="instagram Adresi" required>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Youtube</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="youtube" name="upyoutube" placeholder="Youtube Adresi" required>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Facebook</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="facebook" name="upfacebook" placeholder="Facebook Adresi" required>
                                    </div>
                                  </div>
                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Kapat</button>
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
                                      <div class="card">
                              <div class="card-body">
                                <form class="forms-sample" action="" method="post">
                                  <div class="form-group row">
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Açıklama</label>
                                    <div class="col-sm-9">
                                      <textarea id="aciklama" class="form-control" name="aciklama"  placeholder="Adres" required></textarea>
                                    </div>
                                  </div>
                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Kapat</button>
                                    <button type="submit" class="btn btn-outline-primary" name="updaciklama" id="btnUpdateSubmit">Değişiklikleri Kaydet</button>
                                </form>
                              </div></div>
                              </div>
                            </div>
                                  </div>
                                  <!-- /.modal-content -->
                              </div>
                          
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $('.editpage').click(function (event) {

        // adres tel mail insta tiktok youtube facebook
        var id = $(this).attr("data-id");
        var adres = $(this).attr("data-adres");
        var tel = $(this).attr("data-tel");
        var mail = $(this).attr("data-mail");
        var instagram = $(this).attr("data-insta");
        var tiktok = $(this).attr("data-tiktok");
        var youtube = $(this).attr("data-youtube");
        var facebook = $(this).attr("data-facebook");

        $("#id").val(id);
        $("#adres").val(adres);
        $("#tel").val(tel);
        $("#mail").val(mail);
        $("#instagram").val(instagram);
        $("#tiktok").val(tiktok);
        $("#youtube").val(youtube);
        $("#facebook").val(facebook);
    })

    $('.editfooter').click(function (event) {
        var aciklama = $(this).attr("data-aciklama");

        $("#aciklama").text(aciklama);
    })

</script>

          <!-- content-wrapper ends -->
          <!-- Footer -->
<?php include 'footer.php'; ?>
