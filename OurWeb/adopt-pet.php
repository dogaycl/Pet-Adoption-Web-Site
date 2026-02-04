<?php
// Oturum başlat
session_start();

//outurum kontrolü yapar ve değilse kullanıcıyı login.php'ye yönlendirir
if (!isset($_SESSION['username'])) 
{
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a Pet</title>
    <link rel="stylesheet" href="adopt-pet.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="http://localhost:8000/welcome.php" class="logo-container">
                <img src="images/Have.jpg" alt="Logo" class="logo">
            </a>
            <ul class="nav-links">
                <li><a href="http://localhost:8000/welcome.php">• Home</a></li>
                <li><a href="http://localhost:8000/findpet.php">• Find a Pet</a></li>
             <!--  <li><a href="adopt-pet.php">• Adopt a Pet</a></li> (ne gerek var bunun burada olmasına) -->
                <li><a href="aboutus.html">• About Us</a></li>
                <li><a href="helplogged.html">• Help & Advice</a></li>
                <li><a href="logout.php">• Log Out</a></li>  
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Adopt a Pet</h1>
        <form action="adopt-pet-mech.php" method="POST" enctype="multipart/form-data">
            <label for="name"><b>Pet Name:</b></label>
            <input type="text" id="name" name="name" placeholder="Enter your pet's name" required>

            <label for="breed"><b>Breed:</b></label>
            <input type="text" id="breed" name="breed" placeholder="Enter its breed" required>

            <label for="age"><b>Age:</b></label>
            <input type="number" id="age" name="age" placeholder="Enter the pet's age" required>

            <label for="district"><b>District:</b></label>
            <input type="text" id="district" name="district" placeholder="Enter your district" required>

            <label for="gender"><b>Gender:</b></label>
            <select name="gender" id="gender" required>
                <option value="" disabled selected>Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select> <!-- yine option ekleyerek yaptık çünkü farklı şeyler yazılsın istemiyoruz.-->

            <label for="image"><b>Pet Image:</b></label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit">Submit</button>
        </form>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Have Friends</h3>
                <p>Your one-stop destination for adopting furry friends!</p>
            </div>
            <div class="footer-section">
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
