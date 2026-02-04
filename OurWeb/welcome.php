<?php
// Oturumu başlat
session_start();

// Kullanıcı oturum açmış mı kontrol et
if (!isset($_SESSION['username'])) 
{
    header("Location: login.php"); // Giriş yapmadıysa login.php'ye yönlendir
    exit;
}

//oturumdan kullanıcı adını al. bu giriş yapılıp yapılmadığını gösterir.
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="welcome.css"> <!-- index.html ve welcome.php neredeyse aynı lakin bazı değişiklikler için ayrı bir css yaptık-->
</head>
<body>
    <!-- üst bar bütün sekmelerde aynı görevi görüyor. bi kere giriş yapınca log out seçeneği ekleniyor tabii ki. -->
    <header>
        <nav class="navbar">
            <a href="http://localhost:8000/welcome.php" target="_blank">
                <div class="logo-container">
                    <img src="images/Have.jpg" alt="Have Friends Logo" class="logo">
                </div>
            </a>
            <ul class="nav-links">
                <li><a href="http://localhost:8000/findpet.php">• Find a Pet</a></li>
                <li><a href="adopt-pet.php">• Adopt a Pet</a></li>
                <li><a href="aboutus.html">• About Us</a></li>
                <li><a href="http://localhost:8000/helplogged.html">• Help & Advice</a></li>
                <li><a href="logout.php">• Log Out</a></li>
            </ul>
        </nav>
    </header>

    

    <main>
        <section class="auth-section">
            <!-- İlk Kutu (find a pet kısmı) -->
            <div class="auth-container">
                <h><b>Hi there!</b></h>
                <p> <?php echo htmlspecialchars($username); ?> , Welcome to the place where you can adopt our furry friends!</p>
                <p class="welcome-text">Find a pet or Adopt a pet.</p>
                <div class="auth-buttons">
                    <a href="http://localhost:8000/findpet.php" class="auth-btn login-btn">Find a Pet</a>
                    <a href="http://localhost:8000/adopt-pet.php" class="auth-btn signup-btn">Adopt a Pet</a>
                </div>
            </div>

            <!-- İkinci Kutu (fotoğrafı koyduğumuz yer.) -->
            <div class="image-container">
                <img src="images/Main-Background.jpg" alt="Adorable pets">
            </div>

           
        </section>
    </main>

    <footer class="footer"> <!-- alt bar log in ve signup kısmındaki gibi değil. sitenin kalan kısmında daha detaylı.-->
        <div class="footer-container">
            <div class="footer-section">
                <h3>Have Friends</h3> <!-- her şeyi etkilememesi adına, bir şey için bile ayrı ayrı stil oluşturduk welcome.css'de görünüyor.-->
                <p>Your one-stop destination for adopting furry friends!</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>  <!-- hızlı linkler, log out seçeneğinin olduğu linklere gönderir kullanıcıyı çünkü artık giriş yapıldı.-->
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
                <p>Phone: +90 537 583 0638</p> <!-- önemsiz şeyler için aramazsanız sevinirim :)-->
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Have Friends. All Rights Reserved.</p>
        </div>
    </footer>
    </body>
</html>
