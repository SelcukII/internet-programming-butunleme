<?php
session_start(); // session başlatılır.

if(!isset($_SESSION["login"])){
 header("Location:index.php");// kullanıcı oturum açamadıysa belirtilen adrese yönlendirilir
}else{// kullanıcı başarılı bir şekilde oturum açtıysa belirtilen adrese yönlendirilir.
    header("Location:template/index.php");
}
 
?>
