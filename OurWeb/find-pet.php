<?php
include 'connect.php';

// Filtreleme Kriterleri
$breed = isset($_GET['breed']) ? mysqli_real_escape_string($conn, $_GET['breed']) : '';
$age = isset($_GET['age']) ? mysqli_real_escape_string($conn, $_GET['age']) : '';
$gender = isset($_GET['gender']) ? mysqli_real_escape_string($conn, $_GET['gender']) : '';
$district = isset($_GET['district']) ? mysqli_real_escape_string($conn, $_GET['district']) : '';

//filtrelere göre SQL Sorgusunu Oluştur.
$sql = "SELECT * FROM pets WHERE adopted = 0";
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

if (count($conditions) > 0)   //aynı şeyler burada da geçerli.
{
    $sql .= " AND " . implode(" AND ", $conditions);
}
    //iki tane find-pet olması, log in seçenekleri ile alakalı. bir tanesi log in yaptıktan sonra üst bara log out kısmını eklemek için kullanıldı. 
$result = mysqli_query($conn, $sql);   //2 find-pet.php de aynı görevi görür ve css'leri aynıdır.
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
    <header>
        <nav class="navbar">
            <a href="index.html">
                <div class="logo-container">
                    <img src="images/Have.jpg" alt="Have Friends Logo" class="logo">
                </div>
            </a>
            <ul class="nav-links">
                <li><a href="index.html">&bull; Home</a></li>
                <li><a href="http://localhost:8000/find-pet.php">&bull; Find a Pet</a></li>
                <li><a href="http://localhost:8000/adopt-pet.php">&bull; Adopt a Pet</a></li>
                <li><a href="about-us.html">&bull; About Us</a></li>
                <li><a href="help.html">&bull; Help & Advice</a></li>
            </ul>
        </nav>
    </header>

    <div class="filter-container">
        <form method="GET" action="find-pet.php">
            <label for="breed">Breed:</label>
            <input type="text" id="breed" name="breed" placeholder="Enter breed">

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" placeholder="Enter age">

            <label for="district">District:</label>
            <input type="text" id="district" name="district" placeholder="Enter district">

            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="">Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <button type="submit" class="filter-button">Filter</button>
        </form>
    </div>

    <div class="pet-container">
        <?php
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "
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
            echo "<p>No pets available for adoption at the moment.</p>";
        }
        ?>
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
                    <li><a href="index.html">&bull; Home</a></li>
                    <li><a href="http://localhost:8000/find-pet.php">&bull; Find a Pet</a></li>
                    <li><a href="http://localhost:8000/adopt-pet.php">&bull; Adopt a Pet</a></li>
                    <li><a href="about-us.html">&bull; About Us</a></li>
                    <li><a href="help.html">&bull; Help & Advice</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Email: furkan.tuc.92@gmail.com</p>
                <p>Phone: +90 537 583 0638</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Have Friends. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>