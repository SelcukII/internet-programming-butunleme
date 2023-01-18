<?php
session_start(); // session bilgisi sayfaya çağırılır.
ob_start();
session_destroy(); // tüm bilgiler yok edilir ve kullanıcı çıkış yapmış olur.
?>
	<script type="text/javascript">
		setTimeout(function(){   
        window.location.assign("index.php");
        });</script>
        <!-- burda girilen url ye yönlendirme yapılır. -->
	<?php 
?>
