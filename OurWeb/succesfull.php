<?php
session_start();

// Kullanıcı oturum kontrolü. açık değilse login sayfasına yönlendirilir. hesabı yoksa eğer sign up yapabilir gerekli yönlendirme mevcut.
if (!isset($_SESSION['username'])) 
{
    header("Location: login.php");
    exit;
}

include 'connect.php'; // Veritabanı bağlantısı. mysql database, onun için yönlendirme.

// verilerin uyuşup uyuşmamasının kontrolü.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pet_name'], $_POST['answer1'], $_POST['answer2'], $_POST['answer3'])) 
{
    $pet_name = mysqli_real_escape_string($conn, $_POST['pet_name']); //mysqli_real ile verileri güvenli bir şekilde veritabanına gönder.
    $answer1 = mysqli_real_escape_string($conn, $_POST['answer1']);
    $answer2 = mysqli_real_escape_string($conn, $_POST['answer2']);
    $answer3 = mysqli_real_escape_string($conn, $_POST['answer3']);

    // Veritabanına cevapları kaydet
    $sql_insert = "INSERT INTO adoption_responses (pet_name, answer1, answer2, answer3) VALUES (?, ?, ?, ?)"; //yer tutucular cevapları güvenli bir şekilde tutar.
    $stmt = mysqli_prepare($conn, $sql_insert); //cevaplar veritabanında adoption_responses'a kaydolur (mysql workbench/pet_adoption.adoption_responses)
    mysqli_stmt_bind_param($stmt, "ssss", $pet_name, $answer1, $answer2, $answer3);

    if (mysqli_stmt_execute($stmt)) 
    {
        // Hayvanı sahiplendirilmiş olarak işaretle find a pet kısmından kaldırılması için adopted sorgusunu değiştitiriyoruz. (1 yapılıyo)
        $sql_update = "UPDATE pets SET adopted = 1 WHERE name = ? AND adopted = 0";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "s", $pet_name);

        if (mysqli_stmt_execute($stmt_update) && mysqli_stmt_affected_rows($stmt_update) > 0) 
        {
            // Başarı mesajını göster sonra ilanların olduğu sayfaya at. logged in olduğu için findpet.php
            echo "<script>  
                    alert('Pet başarı ile sahiplendirildi!');
                    window.location.href = 'findpet.php';
                  </script>"; //ufak bi jscript sıkıştırdık araya :) gerek yoktu aslında bunun için ayrı bir html ve css hazırlanabilirdi ama bunu bildiğimizi gösterelim dedik.
        } 
        else 
        {
            echo "<h1>Hata: Pet bulunamadı veya zaten sahiplendirilmiş.</h1>"; //hatasız kul olmaz, bu mesaj çıkabilir ama umarım çıkmaz.
        }

        mysqli_stmt_close($stmt_update); //açık sorguları kapatır.
    }
    else 
    {
        echo "<h1>Hata: Cevaplar kaydedilirken bir sorun oluştu.</h1>"; //bu o kadar denemede hiç ekrana gelmedi umarım sunumda da gelmez.
    }

    mysqli_stmt_close($stmt); //sorgu kapatır.
}  

mysqli_close($conn); //veri tabanı ile işimiz bitti.
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a Pet</title>
    <link rel="stylesheet" href="adopted.css">
</head>
<body>
 

<div class="container">
    <div class="background-box">
     <div class="request-are"> 
        <!--<h1>Adopt a Pet</h1> -->
        <form method="POST" action="succesfull.php">
          <p>Answer the questions below for a complete adoption.</p>
            <label for="pet_name">Pet Name:</label>
            <input type="text" id="pet_name" name="pet_name" placeholder="Enter pet's name" required>

            <label for="answer1">Please enter your home address or the address where you will take care of the pet.</label>
            <input type="answer1" name="answer1" placeholder="Enter your address" required></textarea>

            <label for="answer2">Have you owned pets before? If yes, share your experience.</label>
            <input type="answer2" name="answer2" placeholder="Enter your answer" required></textarea>

            <label for="answer3">How much time can you dedicate daily to this pet?</label>
            <input type="answer3" name="answer3" placeholder="Enter your answer" required></textarea>

            <button type="submit">Submit</button>
        </form>
     </div>
    </div>
</div>

    <footer class="footer">
            <div class="footer-link">
                <p><a href="index.html">Go back to Home page!</a></p>
            </div> 
            
            <div class="footer-bottom">
                <p>© 2024 Have Friends. All Rights Reserved.</a></p>
            </div>
    </footer>
</body>
</html>
