<?php
include 'connect.php'; 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = mysqli_real_escape_string($conn, $_POST['username']); 
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    // Hazırlıklı sorgu
    $sql = "SELECT * FROM users WHERE username = ? AND email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);//sorgu çalışır.
    $result = mysqli_stmt_get_result($stmt); //yapılan işlem için sonuçları alır ve karşılaştırma fazı başlar.

    if ($result && mysqli_num_rows($result) > 0) 
    {                                           //buradaki bilgiler dönerse eğer, row'a atanır.
        $row = mysqli_fetch_assoc($result);

        // şifre doğrulama
        if (password_verify($password, $row['password'])) 
        {
            $_SESSION['username'] = $username;
            header("Location: welcome.php"); // Giriş başarılı, yönlendir
            exit;
        } //hesap varsa ve giriş doğruysa welcome'a atar. index.html'den farklı bir yer orası.
        else 
        {
            $error = "Incorrect password. Please try again.";
        }
    } 
    else 
    {
        $error = "Invalid username or email. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css"> <!-- bu sign up page'den pek de farklı olsun istemedik.-->
</head>
<body>
    <div class="container">
        <div class="background-box">
            <form action="login.php" method="POST" class="login-form">
                <p>Log in to your account to adopt a pet.</p>
                <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
                <label for="username">Username:</label>                 <!-- Required ifadesini bu alanlar boş kalamasın diye ekledik.-->
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                                                                       
                <label for="email">Email:</label>                        <!-- hata olmaması önemli bilgiler database ile kontrolü sağlanarak onaylanıyor.-->
                <input type="email" id="email" name="email" placeholder="Enter your Email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <button type="submit">Log in</button> 
                <!-- yönlendirme kısmı signup.php'ye gider ki ona özel bir css de vardır.-->
                <div class="signup-redirect">
                    Don't have an account? <a href="signup.php">Create One</a>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">  <!-- footer ana sayfadaki ya da site içindeki sayfalardaki kadar detaylı değil. giriş ve kayıt sayfasında farklı yaptık.-->
        <div class="footer-link">
            <p><a href="index.html">Go back to Home page!</a></p>
        </div>  
        <div class="footer-bottom">
            <p>© 2024 Have Friends. All Rights Reserved.</a></p>
        </div>
    </footer>
</body>
</html>
