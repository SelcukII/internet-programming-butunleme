<?php // veri tabanı bağlantısı

error_reporting(0); // oluşabilecek tüm hata mesajlarını gizlemek için kullanılır.

$dsn = "mysql:host=localhost;dbname=db_book;charset=utf8mb4"; // veritabanına dair bilgiler girilir.
$user = "root"; // vt kullanıcı adı bilgisi.
$passwd = ""; // vt kullanıcı şifresi bilgisi.

try {// burada bağlantı aşamasında oluşabilecek hatalara karşı önlem alınır giriş işlemi başarısız olursa catch tarafından hata işleme alınır.
    $db = new PDO($dsn, $user, $passwd); 
    $db-> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // PDO kullanılarak vt bağlantısı sağlanır.
} catch (PDOException $e) {// oluşan hata durumuna dair hata mesajı ekrana bastırılır.
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>
