-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 08 Oca 2021, 12:43:22
-- Sunucu sürümü: 8.0.22-0ubuntu0.20.04.3
-- PHP Sürümü: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `exam`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `examTable`
--

CREATE TABLE `examTable` (
  `examId` varchar(10) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `examName` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `maxMark` smallint NOT NULL,
  `maxEntry` smallint NOT NULL,
  `maxTime` int NOT NULL,
  `activation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `examTable`
--

INSERT INTO `examTable` (`examId`, `startTime`, `endTime`, `examName`, `maxMark`, `maxEntry`, `maxTime`, `activation`) VALUES
('YMH-452', '2020-12-31 08:00:00', '2021-01-09 10:00:00', 'Algoritma Analizi', 100, 3, 120, 1),
('YMH-453', '2021-01-06 08:00:00', '2021-01-10 10:00:00', 'Veri tabanı', 100, 2, 40, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `questionTable`
--

CREATE TABLE `questionTable` (
  `examId` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `index` int NOT NULL,
  `question` text COLLATE utf8_turkish_ci,
  `trueQuestion` text COLLATE utf8_turkish_ci,
  `falseQuestion1` text COLLATE utf8_turkish_ci,
  `falseQuestion2` text COLLATE utf8_turkish_ci,
  `falseQuestion3` text COLLATE utf8_turkish_ci,
  `falseQuestion4` text COLLATE utf8_turkish_ci,
  `trueFalse` tinyint(1) DEFAULT NULL,
  `answer` text COLLATE utf8_turkish_ci,
  `image` text COLLATE utf8_turkish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `questionTable`
--

INSERT INTO `questionTable` (`examId`, `index`, `question`, `trueQuestion`, `falseQuestion1`, `falseQuestion2`, `falseQuestion3`, `falseQuestion4`, `trueFalse`, `answer`, `image`) VALUES
('YMH-452', 101, 'Resim deki ifade doğrumu', NULL, NULL, NULL, NULL, NULL, 1, NULL, '../teacher/image/5fedbd8036078.png'),
('YMH-452', 102, 'Boşluğa ne gelecektir', NULL, NULL, NULL, NULL, NULL, NULL, 'boşluk', '../teacher/image/5fedbdd2a5190.png'),
('YMH-452', 103, 'Yazılım Hakkındaki d&uuml;ş&uuml;nceleri yazınız?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('YMH-452', 104, '5=6 ifadesi doğrumu', NULL, NULL, NULL, NULL, NULL, 0, NULL, ''),
('YMH-453', 114, 'Doğru cevabı se&ccedil;iniz', NULL, NULL, NULL, NULL, NULL, 1, NULL, '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `examTable`
--
ALTER TABLE `examTable`
  ADD PRIMARY KEY (`examId`);

--
-- Tablo için indeksler `questionTable`
--
ALTER TABLE `questionTable`
  ADD PRIMARY KEY (`index`),
  ADD KEY `examId` (`examId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `questionTable`
--
ALTER TABLE `questionTable`
  MODIFY `index` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `questionTable`
--
ALTER TABLE `questionTable`
  ADD CONSTRAINT `questionTable_ibfk_1` FOREIGN KEY (`examId`) REFERENCES `examTable` (`examId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
