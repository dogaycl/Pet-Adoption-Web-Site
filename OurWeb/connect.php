<?php
$servername = "localhost";
$username = "root"; //workbench gui'da yazan username girilecek (doga sende de root yazar default olarak.)
$password = "Ea66321:D"; //sendeki boştur muhtemelen ben şifre koydum.
$dbname = "pet_adoption";

// Bu sıralama önemli kendi verilerimi gireceğim. senin bilgisayarda çalışmaz doga şifreler farklı. 
$conn = mysqli_connect($servername, $username, $password, $dbname);

// gerekli try catch zımbırtısı.
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
?>
