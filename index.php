<?php require "header.php"; // header.php dosyası sayfaya dahil edilir. ?>
	  <section class="hero-wrap js-fullheight">
      <div class="overlay"></div>
      <div class="container-fluid px-0">
      	<div class="row d-md-flex no-gutters slider-text align-items-center js-fullheight justify-content-end">
	      	<img class="one-third js-fullheight align-self-end order-md-last img-fluid" src="images/undraw_book_lover_mkck.svg" alt="">
	        <div class="one-forth d-flex align-items-center ftco-animate js-fullheight">
	        	<div class="text mt-5">
	        		<span class="subheading">Best Seller Book Of The Week</span>
		  				<h1>Clue Of The Wooden Cottage</h1>
		  				<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
		  				
	          </div>
	        </div>
	    	</div>
      </div>
    </section>

    <section class="ftco-about img ftco-section" id="about-section">
    	<div class="container">
    		<div class="row d-flex no-gutters">
    			<div class="col-md-6 col-lg-6 d-flex">
    				<div class="img-about img d-flex align-items-stretch">
    					<div class="overlay"></div>
	    				<div class="img d-flex align-self-stretch align-items-center" style="background-image:url(images/bg_1.jpg);">
	    				</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-6 pl-md-5">
    				<div class="row justify-content-start pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		            <h2 class="mb-4">Hakkımzıda</h2>
		            <p><?php echo $footer["footer_aciklama"]; // admin panelinden değişebilen hakkımızda açıklaması ekrana bastırılır ?></p>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section ftco-project" id="projects-section">
    	<div class="container">
    		<div class="row no-gutters justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Kitaplar</span>
            <h2 class="mb-4">En Son Çıkan Kitaplarımız</h2>
          </div>
        </div>
    		<div class="row">
    			<?php 
    				$sayac = 0;
    				foreach ($kitap_cek as $kitap_list) {// header.php sayfasıdan çekilen sorguda sondan geriye doğru şekilde kitap bilgileri vt den çekilir.
    				$sayac++;
    				if($sayac <= 8){
    				?>
    			<div class="col-md-3">
    				<div class="project img ftco-animate d-flex justify-content-center align-items-end" style="background-image: url(<?php echo "admin/template".$kitap_list["book_foto"]; ?>);"> <!-- çekilen kitap bilgisine ait fotoğaf bilgisi çekilir. -->
    					<div class="overlay"></div>
	    				<div class="text p-4">
	    					<h3><a href="#"><?php echo $kitap_list["book_isim"]; ?></a></h3> <!-- çekilen kitap bilgisine ait isim bilgisi çekilir. -->
	    					<span><?php echo $kitap_list["book_aciklama"]; ?></span> <!-- çekilen kitap bilgisine ait açıklama bilgisi çekilir. -->
	    				</div>
    				</div>
  				</div>
  			<?php }} ?>
    		</div>
    	</div>
    </section>

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
		            <p><?php echo $footer["adres"]; ?></p> <!-- adres bilgisi vt den çekilir. -->
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
		            <p><a href="tel://<?php echo $footer["telefon"]; ?>"><?php echo $footer["telefon"]; ?></a></p> <!-- telefon bilgisi vt den çekilir. -->
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
		            <p><a href="mailto://<?php echo $footer["mail"]; ?>"><?php echo $footer["mail"]; ?></a></p> <!-- mail bilgisi vt den çekilir. -->
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
<?php require 'footer.php'; // footer.php sayfası dahil edilir. ?>
