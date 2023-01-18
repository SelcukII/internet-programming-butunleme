<?php   
  include 'header.php'; // header.php dosyası sayfaya dahil edilir. 

  $user_cek = $db->query("SELECT * FROM tbl_user"); // kullanıcı bilgisinin yer aldığı veriler vt tarafından çekilir.
  $aktif_profil = $db->query("SELECT * FROM tbl_user WHERE name = '$session_name'")->fetch(PDO::FETCH_ASSOC); // giriş yapan kullanıcıya ait bilgiler çekilir.

  $username = $_POST['username'];
  $userpass = $_POST['userpass'];
  $userpass2 = $_POST['userpass2'];
  $usergen = $_POST['usergen'];
  $userperm = $_POST['userperm'];
  $btnEkle = $_POST['btnEkle'];
  $btnDelete = $_POST['btnDelete'];
  $gelenİd = $_POST['gelenİd'];
  $btnUpdate = $_POST['btnUpdate'];
  $updName = $_POST['updName'];
  $foto = $_POST['foto'];
  $updyetki = $_POST['updyetki'];
  $pass = $_POST['pass'];
  $pass2 = $_POST['pass2'];
  $logoEkle = $_POST['logoEkle'];
// tüm form elementlerinden gelecek olan değerler değişkenlere atılır.

  if (isset($btnUpdate)) { // güncelleme butonu dinlenir.
    if ($pass != $pass2)// güncelleme alanında girilen şireler eşleşmemesi durumunda hata bildirilir.
      $yanit3 = "<b style='color:red; font-weight:bold;'>Kullanıcı Şifreleriniz Eşleşmiyor. !</b>";
    else{// güncelleme işlemi sırasında veriler doğru şekilde işlenebiliyorsa şart sağlanır.
        $gelenPasswd = $pass;
        $encrypt_method = 'AES-256-CBC';
        $secret_key = '11*_33';
        $secret_iv = '22-=**_';
        $key = hash('sha256', $secret_key); 
        $iv = substr(hash('sha256', $secret_iv), 0, 16); 

        $sifrelendi = openssl_encrypt($gelenPasswd,$encrypt_method, $key, false, $iv);
        // gelen yeni şifre md5 ile şifrelenir.
        $user_update = $db->query("UPDATE tbl_user SET profile='$foto', passwd='$sifrelendi' WHERE id = '$gelenİd'");// güncel bilgiler (yeni şifre bilgisi, foto bilgisi vt tarafında güncellenir.)
        if($user_update)// işlem sonucuna göre olumlu yada olumsuz mesaj bildirilir.
          $yanit3 = "<b style='color:green; font-weight:bold;'>Kullanıcı Bilgileriniz Başarıyla Güncellendi. !</b>";
        else
          $yanit3 = "<b style='color:red; font-weight:bold;'>Kullanıcı Bilgileriniz Güncellenirken Bir Hata Oluştu. !</b>";
    }
    ?>
      <!-- belirtilen adrese 1.5 sn sonra yönlendirilir. -->
      <script type="text/javascript">
          setTimeout(function(){   
          window.location.assign("panel_ayarlar.php");}, 1500);
      </script>
    <?php
  }

?>
        <div class='main-panel'>
          <div class='content-wrapper'>
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Profiliniz</h4>
                    <?php echo $yanit3."<br>"; ?>
                    <table class="table table-dark">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Kullanıcı Adınız</th>
                          <th>Profil Resminiz</th>
                          <th>Yetkiniz</th>
                          <th>Şifreniz</th>
                          <th>İşlem</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php

                        $encrypt_method = 'AES-256-CBC';
                        $secret_key = '11*_33';
                        $secret_iv = '22-=**_';
                        $key = hash('sha256', $secret_key); 
                        $iv = substr(hash('sha256', $secret_iv), 0, 16); 

                        $sifre_cozuldu = openssl_decrypt($aktif_profil['passwd'],$encrypt_method, $key, false, $iv);
                        // kullanıcı şifresi normal şekilde görüntülenebilmesi için şifreleme çözülür.
                      ?>

                        <tr>
                          <td>1</td>
                          <td><?php echo $aktif_profil['name']; ?></td>
                          <td><?php echo $aktif_profil['profile']; ?></td>
                          <td><?php echo $aktif_profil['yetki']; ?></td>
                          <td><?php echo "Maskelendi."; ?></td>
                          <!-- buraya kadar olan alanda oturum açan kullanıcı bilgisi tablo şeklinde listelenir. -->
                          <td>
                            <!-- güncelleme işlemi için kullanıcı verileri pop-up ekranına aktarılması istenen veriler jquery yardımıyla form içerisine yerleştirilir. -->
                            <button type="button" class="btn btn-outline-success editpage" data-toggle="modal" data-name="<?php echo $aktif_profil['name']; ?>" data-foto="<?php echo $aktif_profil['profile']; ?>" data-yetki="<?php echo $aktif_profil['yetki']; ?>" data-pass = "<?php echo $sifre_cozuldu; ?>" data-id="<?php echo $aktif_profil['id']; ?>" data-target="#exampleModal"> 
                                <i class="mdi mdi-table-edit"></i>Düzenle
                              </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <br><br>
                    
                  <!-- Modal UPDATE-->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Bilgilerinizi Güncelleyin</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <div class="modal-body">
                            <div class="card">
                              <div class="card-body">
                                <form class="forms-sample" action="" method="post">
                                  <input type="hidden" name="gelenİd" id="value">
                                  <div class="form-group row">
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kullanıcı Adınız</label>
                                    <div class="col-sm-9">
                                      <input id="name" type="text" class="form-control" name="updName"  placeholder="Kullanıcı Adınız" required disabled style="background-color:#191C24;">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kullanıcı Resminiz</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" id="profil" name="foto">
                                        <option value="face1.jpg">Kadın-1</option>
                                        <option value="face2.jpg">Erkek-2</option>
                                        <option value="face3.jpg">Kadın-3</option>
                                        <option value="face4.jpg">Erkek-4</option>
                                        <option value="face5.jpg">Erkek-5</option>
                                        <option value="face6.jpg">Erkek-6</option>
                                        <option value="face7.jpg">Erkek-7</option>
                                        <option value="face8.jpg">Kadın-8</option>
                                        <option value="face9.jpg">Kadın-9</option>
                                        <option value="face10.jpg">Kadın-10</option>
                                        <option value="face11.jpg">Kadın-11</option>
                                        <option value="face12.jpg">Erkek-12</option>
                                        <option value="face13.jpg">Erkek-13</option>
                                        <option value="face14.jpg">Erkek-14</option>
                                        <option value="face15.jpg" selected>Erkek-15</option>
                                        <option value="face16.jpg">Erkek-16</option>
                                        <option value="face17.jpg">Erkek-17</option>
                                        <option value="face18.jpg">Erkek-18</option>
                                        <option value="face19.jpg">Erkek-19</option>
                                        <option value="face20.jpg">Kadın-20</option>
                                        <option value="face21.jpg">Erkek-21</option>
                                        <option value="face22.jpg">Erkek-22</option>
                                        <option value="face23.jpg">Kadın-23</option>
                                        <option value="face24.jpg">Erkek-24</option>
                                        <option value="face25.jpg">Erkek-25</option>
                                        <option value="face26.jpg">Kadın-26</option>
                                        <option value="face27.jpg">Erkek-27</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kullanıcı Yetkiniz</label>
                                    <div class="col-sm-9">
                                     <input type="text" id="yetki" class="form-control" placeholder="Kullanıcı Yetkiniz" name="updyetki" disabled style="background-color:#191C24;">
                                    </div>
                                  </div>
                                   <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kullanıcı Şifreniz</label>
                                    <div class="col-sm-9">
                                     <input type="text" id="pass" class="form-control" placeholder="Kullanıcı Şifreniz" name="pass" required>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kullanıcı Şifreniz Tekrar</label>
                                    <div class="col-sm-9">
                                     <input type="text" id="pass2" class="form-control" placeholder="Kullanıcı Şifreniz Tekrar" name="pass2" required>
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
                                    <div class="modal-body" style="height:120px">
                                        <form class="form-control" method="POST" action="">
                                            <input type="hidden" id="socid" name="gelenİd">
                                            <p>
                                              Bu Kullanıcıyı Silmek İstediğinize Emin Misiniz ?
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
                      </div>
                    </div>
                  </div>
                </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $('.editpage').click(function (event) {
        var name = $(this).attr("data-name");
        var foto = $(this).attr("data-foto");
        var yetki = $(this).attr("data-yetki");
        var pass = $(this).attr("data-pass");
        var id = $(this).attr("data-id");

        $("#name").val(name);
        $("#profil").val(foto);
        $("#yetki").val(yetki);
        $("#pass").val(pass);
        $("#pass2").val(pass);
        $("#value").val(id);
    })

    $('.deletepage').click(function (event) {
        var name = $(this).attr("data-name");
        var socid = $(this).attr("data-id");

        $("#myModalLabel").text(name);
        $("#socid").val(socid);
        $("#gelenName").val(name);
    })

</script>
          <!-- content-wrapper ends -->
          <!-- Footer -->
      <?php include 'footer.php'; ?> <!-- footer.php dosyası sayfaya dahil edilir. -->
