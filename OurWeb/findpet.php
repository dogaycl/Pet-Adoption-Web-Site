<?php
include 'connect.php';

// Filtreleme Kriterleri
$breed = isset($_GET['breed']) ? mysqli_real_escape_string($conn, $_GET['breed']) : ''; //kriterler kullanıcıdan alınmış mı, yoksa alınmamış mı kontrol eder.
$age = isset($_GET['age']) ? mysqli_real_escape_string($conn, $_GET['age']) : ''; //eğer değerler yoksa filtreler boş kalır ' '.
$gender = isset($_GET['gender']) ? mysqli_real_escape_string($conn, $_GET['gender']) : ''; 
$district = isset($_GET['district']) ? mysqli_real_escape_string($conn, $_GET['district']) : ''; 


//filtrelere göre SQL Sorgusunu Oluştur
$sql = "SELECT * FROM pets WHERE adopted = 0"; //1 iken gözükmez ki sahiplenilen hayvanlar database'de 1 olarak işaretlenir.
$conditions = [];

if ($breed != '') 
{
    $conditions[] = "breed LIKE '%$breed%'";
}
if ($age != '') 
{
    $conditions[] = "age = $age";
}
if ($gender != '') 
{  
    $conditions[] = "gender = '$gender'";
}
if ($district != '') 
{
    $conditions[] = "district LIKE '%$district%'";
}

if (count($conditions) > 0) 
{
    $sql .= " AND " . implode(" AND ", $conditions); //sorgu tamamlanırken eklenmiş olan kondisyonlar yani filtreler buraya eklenir. and operatörü ile
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a Pet</title>
    <link rel="stylesheet" href="find-pet.css">
</head>
<body>
    <header> <!-- üst barımız burada da diğer sayfalardaki gibi detaylı, ve log out seçeneği ekli. oturum sonlandırmak için.-->
        <nav class="navbar">
            <a href="http://localhost:8000/welcome.php">
                <div class="logo-container">
                    <img src="images/Have.jpg" alt="Have Friends Logo" class="logo">
                </div>
            </a>
            <ul class="nav-links">
                <li><a href="http://localhost:8000/welcome.php">• Home</a></li>
                <li><a href="http://localhost:8000/adopt-pet.php">• Adopt a Pet</a></li>
                <li><a href="http://localhost:8000/aboutus.html">• About Us</a></li>
                <li><a href="helplogged.html">• Help & Advice</a></li>
                <li><a href="logout.php">• Log Out</a></li>  
            </ul>
        </nav>
    </header>

    <div class="filter-container"> <!-- yukarıdaki php burada kendini gösterir. -->
        <form method="GET" action="findpet.php">
            <label for="breed">Breed:</label>
            <input type="text" id="breed" name="breed" placeholder="Enter breed">

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" placeholder="Enter age">

            <label for="district">District:</label>
            <input type="text" id="district" name="district" placeholder="Enter district">

            <label for="gender">Gender:</label>
            <select id="gender" name="gender"> <!-- saçma sapan şeyler yazılamasın diye ekledik.-->
                <option value="">Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <button type="submit" class="filter-button">Filter</button>
        </form>
    </div>

    <div class="pet-container">
        <?php                            ////php tekrar kendini gösterir. veritabanından ekli olan hayvanları çekmek ve listelemek için.
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo 
                "
                <div class='pet-card'>
                    <img src='" . $row['image'] . "' alt='" . $row['name'] . "' class='pet-image'>
                    <h2>" . $row['name'] . "</h2>
                    <p>Breed: " . $row['breed'] . "</p>
                    <p>Age: " . $row['age'] . " years</p>
                    <p>Gender: " . $row['gender'] . "</p>
                    <p>District: " . $row['district'] . "</p>
                    <form method='POST' action='succesfull.php'>
                        <input type='hidden' name='pet_id' value='" . $row['id'] . "'>
                        <button type='submit' class='adopt-button'>Adopt Me</button>
                    </form>
                </div>
                ";
            }
        } 
        else 
        {
            echo "<p>No pets available for adoption at the moment.</p>";  //yazı rengini ayarlamadım gözükmeme ihtimalini kontrol etmeyi unutma.
        }
        ?>
    </div>

    <footer class="footer">
        <div class="footer-container">    <!-- alt bar sitemmizin bitişini simgeler ve hızlı linkler olduğu gibi iletişim bilgileri de olur.-->
            <div class="footer-section">
                <h3>Have Friends</h3>
                <p>Your one-stop destination for adopting furry friends!</p>
            </div>
            <div class="footer-section">  <!-- hepsinde log out seçeeneği var.-->
                <h3>Quick Links</h3>
                <ul>
                <li><a href="http://localhost:8000/welcome.php">• Home</a></li>
                <li><a href="http://localhost:8000/findpet.php">• Find a Pet</a></li>
                <li><a href="adopt-pet.php">• Adopt a Pet</a></li>  
                <li><a href="aboutus.html">• About Us</a></li>
                <li><a href="helplogged.html">• Help & Advice</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Email: furkan.tuc.92@gmail.com</p>
                <p>Phone: +90 537 583 0638</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Have Friends. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
