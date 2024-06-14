<?php
session_start();

require '../dbConfig/dbConfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $error = '';
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['name'] = $row['name'];
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $row["role"];
            $_SESSION["visitor_recorded"] = false;
            if ($row["role"] == "admin") {
                header("Location: ../Adminpage/admin.php");
            } else {
                header("Location: ../homepage/homepage.php");
            }
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "user not registered!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="auth_main.css">
    <link rel="icon" href="assets/AASTU Logo 2_title.jpg" type="image/x-icon">
    <!-- Google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Google icons  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header>
        <nav>
            <div class="logo-bg">
                <div class="logo">
                    <img src="assets/AASTU_Logo_2-removebg-preview.png" alt="">
                </div>
            </div>

            <div class="navg">
                <ul>
                    <div class="inner-link">
                        <li><a href="../homepage/homepage.php">HOME</a></li>
                    </div>
                    <li><a class="btn btn-m btn-outline-primary" href="registeration.php">REGISTER </a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <main>

            <!-- this is the header of the auth  -->
            <div class="login-area">
                <section>
                    <h1 class="login">LOG IN</h1>
                </section>
                <!-- this is the form section  -->
                <form action="login.php" method="post" class="form-input">
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email" placeholder="@aastu.edu.et" required><br>
                    <label for="pwd">Password</label><br>
                    <div class="pwd">
                        <div class="pwdArea">
                            <input type="password" name="password" id="pwd" class="pwds" placeholder="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" required title="Password must contain at least one lowercase letter, one uppercase letter, one digit, and be at least 8 characters long.">

                        </div>
                        <div class="v_icons">
                            <span id="vis" class="material-symbols-outlined vis" onclick="togglePwdVisibility()">
                                visibility
                            </span>
                            <span id="not_vis" class="material-symbols-outlined not_vis" onclick="togglePwdVisibility()">
                                visibility_off
                            </span>
                        </div>
                    </div> <br>
                    <div id="error">
                        <h4 class="error"><?php echo $error ?></h4>
                    </div>
                    <button class="btn btn-m btn-primary">SUBMIT</button>
                </form>
            </div>
        </main>
    </div>
    <main></main>
    </div>
    <footer>
        <!--the bottom last footer of the page -->
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; 2024 AASTU | Developed Software Savants&trade;</p>
            </div>
        </div>
    </footer>
    <script src="auth.js"></script>
    <!-- <script src="/homepage/loggedIn.js"></script> -->
</body>

</html>