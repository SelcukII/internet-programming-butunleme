<?php 
	require 'header.php'; // header.php sayfası dahil edilir.

	$ara = $_POST['ara']; // arama çubuğundaki ara butonu dinlenir ve değişkene atanır.
	$araBook = $_POST['araBook']; // arama çubuğuna girilen aram değeri değişkene atanır.
	$kitap_sor = 0; // kitap sayısını tutan değişkene default 0 atanır.
	$page = empty($_GET['page']) ? 1 : $_GET['page']; // get ile link dinlenir page= kısmından değer gelmesi beklenir eğer boş bir değer dönerse default olarak 1 değeri atanır aksi halde gelen değer değişkene atanır.
	$limit = 8; // bir sayfada görünmesini istediğimiz kitap sayısı
	$startlimit = ($page*$limit) - $limit; // burada yapılan hesap sayesinde her sayfada kitapların devamı listelenir.
	$pageCount = ceil($satir/$limit); // $satir değişkeninden gelen vt de kayıtlı olan kitap sayısı sayfada görünecek kitap sayısına bölünerek toplam kaç sayfa oluşması gerektiğini hesaplar.

	if(isset($araBook) && !empty($ara)){ // arama butonuna basıldıysa ve arama çubuğu boş değilse çalışır.
		$kitap_sor = $db->query("SELECT * FROM tbl_books WHERE book_isim='$ara'")->fetchAll(PDO::FETCH_ASSOC); // vt den aranan kitap bilgisi çekilir.
		if ($kitap_sor) // eğer bir sonuç döndüyse ekrana mesaj basılır.
			$sonuc = "<div class='container text-center mb-3'>Şu sonuçlar bulundu: </div>";
	}
	else{
		$kitap_sor = $db->query("SELECT * FROM tbl_books GROUP BY id DESC LIMIT $startlimit, $limit")->fetchAll(PDO::FETCH_ASSOC); // eğer herhangi bir arama işlemi yapılmadıysa başlangıç değerinden bitiş değerine kadar olan kitap bilgileri çekilir. (Sayfalama yapısı burada devreye girer.)
	}

?>
    <section class="ftco-section ftco-project" id="projects-section">
    	<div class="container">
    		<div class="row no-gutters justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">My Other Books</h2>
            <div>
            	<form method="post" action="#ara?"> 	
            		<input class="form-group" type="text" name="ara" placeholder=" Ara">
            		<button name="araBook" class="btn btn-outline-success">Ara</button>
            	</form>
            </div>
          </div>
        </div>
    		<div class="row">
    			<?php 
    				$sayac = 0;
    				echo $sonuc;
    				foreach ($kitap_sor as $kitap_list) { // kitap bilgileri tablodaki veri sayısı kadar çalışır.
    				$sayac++;
    				?>
    			<div class="col-md-3">
    				<div class="project img ftco-animate d-flex justify-content-center align-items-end" style="background-image: url(<?php echo "admin/template".$kitap_list["book_foto"]; ?>);"> <!-- o an ki kitabın fotoğraf bilgisi çekilir. -->
    					<div class="overlay"></div>
	    				<div class="text p-4">
	    					<h3><a href="#"><?php echo $kitap_list["book_isim"]; ?></a></h3> <!-- o an ki kitap ismi -->
	    					<span><?php echo $kitap_list["book_aciklama"]; ?></span> <!-- o an ki kitap açıklaması -->
	    				</div>
    				</div>
  				</div>
  			<?php }
  				if ($sayac < 1) {?> <!-- eğer sayaç değeri artmadıysa yukarıdaki foreach döngsü çalışmamış demektir bu da herhangi bir veri çekilmediği anlamına gelir. -->
  					<div class='container text-center'>
								<label style='font-weight: bold; font-size: 20px;'>Sonuç Bulunamadı. !</label>
						</div>
					<?php } ?>

    		</div>
    	</div>
				<nav aria-label="Page navigation example">
				  <ul class="pagination justify-content-center">
				  	<li class="page-item <?php if($page == 1){?> disabled <?php } ?>"><a href="product.php?page=<?php echo $page-1; ?>" class="page-link" style="font-weight: bold; <?php if($page != 1){?> color: green; <?php } ?>">Öceki Sayfa</a></li> <!-- burada önceki sayfaya gitmek için atanan tuşa eğer ilk sayfaya ulaştıysa disabled değeri aktif edilir ve otomatik olarak buton devredışı kalır önceki sayfa da bulunduğu sayfa numarasından 1 azaltarak ulaşır. -->
				  	&nbsp;
				    <?php 
				    	$i = 0;
				    	while ($i < $pageCount) {// burada yukarıda hesabını yapmış olduğumuz sayfa sayısı kadar sayfa oluşturulur.
				    	$i++;
				     	?>
				     		<li class="page-item <?php if($page == $i){?> disabled <?php } ?>"><a class="page-link" href="product.php?page=<?php echo $i; ?>" >Sayfa <?php echo $i; ?></a></li>
			   		<?php } ?><!-- burada döngü boyunca oluşturulacak olan sayfa butonları -->
			   		&nbsp;
				  	<li class="page-item <?php if($page == $i){?> disabled <?php } ?>"><a href="product.php?page=<?php echo $page+1; ?>" class="page-link" style="font-weight: bold; <?php if($page != $i){?> color: green; <?php } ?>">Sonraki Sayfa</a></li><!-- burada sonraki sayfaya gitmek istendiğinde en son sayfaya ulaşıldıysa eğer disabled değeri atanır ve buton devredışı kalır. Buton sonraki sayfaya gitmek için bulunduğu sayfa numarsını 1 arttırarak sonraki sayfaya ulaşır. -->
				  </ul>
				</nav>
    </section>

<?php require 'footer.php'; ?> <!-- footer.php sayfası dahil edilir. -->
