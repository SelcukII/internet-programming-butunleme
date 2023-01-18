<?php include "header.php"; ?> <!-- header.php dosyası sayfaya dahil edilir. -->
<head>
    <link rel="stylesheet" href="../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  </head>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><a href="kitaplar.php" style="text-decoration:none;">Kitaplar</a></h3>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-book icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Kitapları Görmek İçin Tıklayın.</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><a href="kitap_ekle.php" style="text-decoration:none;">Kitap Ekle</a></h3>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="icon icon-box-danger ">
                          <span class="mdi mdi-bookmark-plus-outline icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Yeni Kitap Eklemek İçin Tıklayınız.</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><a href="panel_ayarlar.php" style="text-decoration:none;">Ayarlar</a></h3>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-settings icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Ayarları Görmek İçin Tıklayınız.</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><a href="site_iletisim.php" style="text-decoration:none;">Site Bilgileri</a></h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger ">
                          <span class="mdi mdi-eye icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Site Bilgilerini Görmek İçin Tıklayınız.</h6>
                  </div>
                </div>
              </div>
            </div>

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
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $counter = 0;
                            $socSor = $db->prepare("SELECT * FROM tbl_books GROUP BY id ASC"); // kitap bilgisi vt tarafından çekilir.
                            $socSor->execute();
                            $socCek = $socSor->FetchAll(PDO::FETCH_ASSOC);
                            foreach ($socCek as $socCek) {// sorgu veri sayısı kadar çalışır.
                                $counter++;
                            if($counter <= 5){// sorgudan gelen veri sayısını 5 adet olarak sabitler
                          ?>
                          <tr>
                            <td>
                              <?php echo $counter; ?>
                            </td>
                            <td class="py-1">
                              <img src="../<?php echo $socCek['book_foto']; ?>" alt="image" /><?php echo $socCek["book_foto"]; ?><!-- kitap bilgisine ait fotoğraf dosyası çağırılır. -->
                            </td>
                            <td id="isim" style="text-transform:uppercase; font-weight: bold; color:#fff; font-size:12px;"> <?php echo $socCek['book_isim']; ?> </td>
                            <!-- kitao bilgisine ait kitap ismi çekilir. -->
                            <td > <textarea class="form-control" disabled style="background-color:#191C24;"><?php echo $socCek['book_aciklama']; ?></textarea> </td>
                            <!-- kitap bilgisine ait açıklama bilgisi çekilir. -->
                          </tr>
                          <?php }} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
<?php include "footer.php"; ?> <!-- footer.php dosyası dahil edilir. -->
