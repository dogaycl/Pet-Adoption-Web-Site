<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") //post yöntemini kontorl eder. post yöntemi yoksa bu kod bloğu hata verecek.
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password']; 

    // şifre doğrulama
    if ($password !== $confirm_password) 
    {
        $error = "Passwords do not match!"; //bu hata mesajı önemli
    }
    else 
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); //doğrulanan şifre buraya atanır. burada gizlilik ve güvenlik eklenir.

        //hazırlıklı sorgu
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

        if (mysqli_stmt_execute($stmt)) //sorgu başlatılır. eğer database'e kayıt geçerli olduysa.
        {
            $success = "Account created successfully! You can now <a href='login.php'>log in</a>."; //login page yönlendirmesi.
        }
        else 
        {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <div class="arkadakikutu">
            <div class="signup-container">
                <p>Create an account to adopt your furry friend!</p>
                <?php
                if (isset($error)) 
                {
                    echo "<p style='color: red;'>$error</p>";
                } 
                elseif (isset($success)) 
                {
                    echo "<p style='color: green;'>$success</p>";
                }
                ?>
                <form action="signup.php" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required> <!-- required kısımlar boş bırakamaması için-->

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>

                    <label for="confirm-password">Confirm Password:</label> <!-- type password oluyor ki şifre ekran da gösterilmesin.-->
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>

                    <button type="submit">Sign Up</button>
                </form>
                <div class="login-redirect">
                    Already have an account? <a href="http://localhost:8000/login.php">Log in</a>
                </div>
            </div>
        </div>
    </div>
        <footer class="footer">
                <div class="footer-link">
                    <p><a href="http://localhost:8000/index.html">Go back to Home page!</a></p>
                </div>  
                <div class="footer-bottom">
                        <p>© 2024 Have Friends. All Rights Reserved.</a></p>
                </div>
        </footer>
 
</body>
</html>
