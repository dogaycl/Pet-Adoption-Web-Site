<?php
session_start(); //Oturumu başlat
session_destroy(); //Oturumu sonlandır
header("Location: login.php"); //tekrar giriş seçeneği için login.php'ye yönlendir
exit;
?>
