<?php
include 'connect.php'; // Veritabanı bağlantısı

if ($_SERVER["REQUEST_METHOD"] == "POST") //burası en zoru.
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $breed = mysqli_real_escape_string($conn, $_POST['breed']);
    $age = (int)$_POST['age']; //yaşı integer'a çevir sözel yazılmasın.
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $district = mysqli_real_escape_string($conn, $_POST['district']); //adres bilgisi alınıyor ama detaylı değil.
    $image = $_FILES['image']; //bu yüklenen dosyayı alır. resmi yaani

    //Resim yükleme ayarları
    $targetDir = "uploads/";
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    //uploads klasörünün var olup olmadığını kontrol et
    if (!is_dir($targetDir)) 
    {
        mkdir($targetDir, 0777, true); //Klasör yoksa oluştur
    }

    //Dosya uzantısını ve boyutunu kontrol et
    $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $allowedTypes))  //buralar ne hatalar verdi allah kahretsin.
    {
        die("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");//başka uzantı ekleyemezler.
    }
    if ($image["size"] > $maxFileSize) 
    {
        die("Error: File size exceeds 2MB limit."); //bu değişkeni yukarıda oluşturdum = 2*1024*1024
    }

    //Benzersiz dosya ismi oluştur
    $uniqueFileName = uniqid("pet_", true) . "." . $imageFileType;
    $targetFile = $targetDir . $uniqueFileName;

    //Resmi yükle
    if (move_uploaded_file($image["tmp_name"], $targetFile)) 
    {
        //Veritabanına Ekle - Prepared Statement kullanarak
        $sql = "INSERT INTO pets (name, breed, age, gender, district, image, adopted) VALUES (?, ?, ?, ?, ?, ?, 0)";   //0 adopted için kullanıldı.
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) 
        {
            mysqli_stmt_bind_param($stmt, "ssisss", $name, $breed, $age, $gender, $district, $targetFile);

            if (mysqli_stmt_execute($stmt)) 
            {
                echo "Pet added successfully!";
                header("Location: findpet.php"); //burada güncel görünür.
                exit();
            } 
            else 
            {
                echo "Database Error: " . mysqli_error($conn); //umarım olmaz bu. henüz hiç yaşanmadı.
            }
            mysqli_stmt_close($stmt);
        } 
        else 
        {
            echo "Error: Failed to prepare SQL statement."; 
        }
    } 
    else 
    {
        echo "Error: Failed to upload the image. Please check folder permissions."; //dosya izinleri yüzünden başta yapamadık istediğimiz olayı.
    }
}

mysqli_close($conn); //işlemi sonlandırır.
?>
