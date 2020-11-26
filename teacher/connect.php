<?php



$mysqlsunucu = "localhost";
$mysqlkullanici = "phpmyadmin";
$mysqlsifre = "kadıkoy";
try {
    $conn = new PDO("mysql:host=$mysqlsunucu;dbname=exam;charset=utf8", $mysqlkullanici, $mysqlsifre);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  echo "Bağlantı başarılı";
} catch (PDOException $e) {
   // echo "Bağlantı hatası: " . $e->getMessage();
}


