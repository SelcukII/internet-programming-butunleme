<?php require 'header.php'; ?> <!-- header.php dosyası sayfaya dahil edilir. -->

    <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Contact Me</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>

        <div class="row d-flex contact-info mb-5">
          <div class="col-md-6 col-lg-4 d-flex ftco-animate">
          	<div class="align-self-stretch box text-center p-4 bg-light">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="fa fa-map-marker"></span>
          		</div>
          		<div>
	          		<h3 class="mb-4">Address</h3>
		            <p><?php echo $footer["adres"]; ?></p><!-- adres bilgisi çekilir -->
		          </div>
	          </div>
          </div>
          <div class="col-md-6 col-lg-4 d-flex ftco-animate">
          	<div class="align-self-stretch box text-center p-4 bg-light">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="fa fa-phone"></span>
          		</div>
          		<div>
	          		<h3 class="mb-4">Contact Number</h3>
		            <p><a href="tel://<?php echo $footer["telefon"]; ?>"><?php echo $footer["telefon"]; ?></a></p> <!-- telefon bilgisi çekilir. -->
	            </div>
	          </div>
          </div>
          <div class="col-md-6 col-lg-4 d-flex ftco-animate">
          	<div class="align-self-stretch box text-center p-4 bg-light">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="fa fa-paper-plane"></span>
          		</div>
          		<div>
	          		<h3 class="mb-4">Email Address</h3>
		            <p><a href="mailto://<?php echo $footer["mail"]; ?>"><?php echo $footer["mail"]; ?></a></p><!-- mail bilgisi çekilir -->
		          </div>
	          </div>
          </div>

        </div>

        <div class="row no-gutters block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form action="#" class="bg-light p-4 p-md-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="İsim soyisim">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Konu">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Mesaj"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Mesaj gönder" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          	<div id="map" class="map"></div>
          </div>
        </div>
      </div>
    </section>
    <hr>
<?php require 'footer.php'; ?> <!-- footer.php dosyası sayfaya dahil edilir. -->
