<?php
require '../dbConfig/dbConfig.php';
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    
    try{
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
            header("Location: login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } catch (Exception $e){
        $error = "User already registered!";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration page</title>
    <link rel="icon" href="assets/AASTU Logo 2_title.jpg" type="image/x-icon">
    <link rel="stylesheet" href="auth_main.css">
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
                    <li><a class="btn btn-m btn-outline-primary" href="login.php">LOGIN </a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <main>
            <!-- this is the header of the auth  -->
            <h3 class="error"></h3>
            <div class="register-area">
                <section>
                    <h1 class="login">REGISTER</h1>
                </section>
                <!-- this is the form section  -->
                <form action="registeration.php" method="post" class="form-input">
                    <label for="name">Name</label><br>
                    <input type="text" name="name" id="name" placeholder="Name" required><br>
                    <label for="occupation">Occupation</label>
                    <select name="role" id="occupation">

                        <option value="student" selected>Student</option>
                        <option value="faculty">Faculty member</option>
                    </select>
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email" placeholder="@aastu.edu.et" required><br>

                    <label for="Is Admin"></label>

                    <label for="pwd">Password</label><br>
                    <div class="pwd">
                        <div class="pwdArea">
                            <input type="password" name="password" id="pwd" class="pwds" placeholder="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" required title="Password must be at least 8 characters, at least one lowercase letter, one uppercase letter, and one number.">

                        </div>
                        <div class="v_icons">
                            <span id="vis" class="material-symbols-outlined vis" onclick="togglePwdVisibility()">
                                visibility
                            </span>
                            <span id="not_vis" class="material-symbols-outlined not_vis" onclick="togglePwdVisibility()">
                                visibility_off
                            </span>
                        </div>
                    </div>
                    <br>
                    <label for="c_pwd">Confirm Password</label><br>
                    <div class="pwd">
                        <div class="pwdArea">
                            <input type="password" name="c_password" id="c_pwd" class="pwds" placeholder="confirm password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" title="Password must be at least 8 characters, at least one lowercase letter, one uppercase letter, and one number." oninput="checkPasswords()">
                        </div>
                        <div class="v_icons">
                            <span id="vis_c" class="material-symbols-outlined vis" onclick="toggle_C_PwdVisibility()">
                                visibility
                            </span>
                            <span id="not_vis_c" class="material-symbols-outlined not_vis" onclick="toggle_C_PwdVisibility()">
                                visibility_off
                            </span>
                        </div>
                    </div>
                    <br>
                    <div id="inputError"><?php echo $error ?></div>
                    <button type="submit" class="btn btn-m btn-primary">SUBMIT</button>
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
</body>

</html>