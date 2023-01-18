-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 18 Oca 2023, 01:14:54
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `db_book`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_page`
--

CREATE TABLE `admin_page` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `icons` varchar(256) NOT NULL,
  `yetki` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admin_page`
--

INSERT INTO `admin_page` (`id`, `name`, `url`, `icons`, `yetki`) VALUES
(3, 'Kitaplar', 'kitaplar.php', 'mdi mdi-biohazard', 'Herkes'),
(4, 'Kitap Ekle', 'kitap_ekle.php', 'mdi mdi-bookmark-plus-outline', 'Herkes'),
(9, 'Site İletişim Bilgileri', 'site_iletisim.php', 'mdi mdi-contact-mail', 'Herkes');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_books`
--

CREATE TABLE `tbl_books` (
  `id` int(11) NOT NULL,
  `book_isim` varchar(256) NOT NULL,
  `book_aciklama` varchar(256) NOT NULL,
  `book_foto` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tbl_books`
--

INSERT INTO `tbl_books` (`id`, `book_isim`, `book_aciklama`, `book_foto`) VALUES
(50, 'kitap1', 'denemeee', '/assets/images/kitaplar/kitap1.png'),
(51, 'sooo', 'Dün bitti, hikâyen devam ediyor...', '/assets/images/kitaplar/sooo.png'),
(52, 'Gece Yarısı Kütüphanesi', 'Gece Yarısı Kütüphanesi', '/assets/images/kitaplar/Gece-Yarısı-Kütüphanesi.png'),
(53, 'İyileşmek', 'Dün bitti, hikâyen devam ediyor...', '/assets/images/kitaplar/İyileşmek.png'),
(54, 'happy', 'new year', '/assets/images/kitaplar/happy.png'),
(55, 'soul river', '...', '/assets/images/kitaplar/soul-river.png'),
(56, 'take the risk', 'r', '/assets/images/kitaplar/take-the-risk.png'),
(57, 'kitap 8', 'kitappp', '/assets/images/kitaplar/kitap-8.png'),
(58, 'kitappps', 'bbb', '/assets/images/kitaplar/kitappps.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_footer`
--

CREATE TABLE `tbl_footer` (
  `id` int(11) NOT NULL,
  `telefon` varchar(256) NOT NULL,
  `adres` longtext NOT NULL,
  `mail` varchar(256) NOT NULL,
  `insta` varchar(256) NOT NULL,
  `youtube` varchar(256) NOT NULL,
  `facebook` varchar(256) NOT NULL,
  `footer_aciklama` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tbl_footer`
--

INSERT INTO `tbl_footer` (`id`, `telefon`, `adres`, `mail`, `insta`, `youtube`, `facebook`, `footer_aciklama`) VALUES
(1, '+90 543 442 34 55', 'DPÜ Evliya Çelebi Yerleşkesi, Kütahya Tavşanlı Yolu 10. km, 43100 Kütahya Merkez/Kütahya', 'selcuk.etli5555@gmail.com', '#', '#', '#', 'Grup şirketlerimizin sinerjisinden beslenen ‘Doğuş’ markası özelinde büyük bir bilgi ve verinin ışığında, çevik, yeni deneyimler yaratmaya odaklanan, sürdürülebilirlik ve iş birliğini ilke edindiğimiz ‘Doğuş 3.0’ adını verdiğimiz kültürle çalışıyoruz. 1951 yılından bugüne, kurucumuz Ayhan Şahenk’in memlekete hizmet vizyonuyla topluma fayda sağlamak üzere çok sayıda çalışmanın kurucusu ve destekçiyiz.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_kullanicilar`
--

CREATE TABLE `tbl_kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_isim` varchar(256) NOT NULL,
  `kullanici_soyisim` varchar(256) NOT NULL,
  `kullanici_mail` varchar(256) NOT NULL,
  `kullanici_sifre` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tbl_kullanicilar`
--

INSERT INTO `tbl_kullanicilar` (`id`, `kullanici_isim`, `kullanici_soyisim`, `kullanici_mail`, `kullanici_sifre`) VALUES
(1, 'admin', 'adminn', 'admin@asd', 'asd'),
(8, 'yunus emre', 'canğa', 'canayunus@gmail.com', 'asd'),
(9, 'asd', 'asd', 'adminasd@asd', 'asd'),
(10, 'selçuk', 'etli', 'selcuk.etli5555@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `profile` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `passwd` varchar(256) NOT NULL,
  `yetki` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `profile`, `name`, `passwd`, `yetki`) VALUES
(1, 'face15.jpg', 'admin', 'jJLM6wqT3vJ4wNiyqVrVhA==', 'Admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_yetkiler`
--

CREATE TABLE `tbl_yetkiler` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `yetki_kod` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tbl_yetkiler`
--

INSERT INTO `tbl_yetkiler` (`id`, `name`, `yetki_kod`) VALUES
(1, 'Admin', 1),
(2, 'Herkes', 2);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_page`
--
ALTER TABLE `admin_page`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_footer`
--
ALTER TABLE `tbl_footer`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_kullanicilar`
--
ALTER TABLE `tbl_kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_yetkiler`
--
ALTER TABLE `tbl_yetkiler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_page`
--
ALTER TABLE `admin_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_footer`
--
ALTER TABLE `tbl_footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_kullanicilar`
--
ALTER TABLE `tbl_kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_yetkiler`
--
ALTER TABLE `tbl_yetkiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
