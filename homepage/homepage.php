<?php
session_start();
require '../vendor/autoload.php';
require 'dbConfig.php';

use Ramsey\Uuid\Uuid;

$loggedIn = false;
if (isset($_SESSION['name'])) {
    if ($_SESSION["role"] == "user") {
        $loggedIn = true;
    } else {
        header("Location: ../auth_page/login.php");
        exit();
    }
}


if (!isset($_COOKIE['visitor_id'])) {
    // create a new UUID for the visitor
    $visitor_id = Uuid::uuid4()->toString();
    setcookie('visitor_id', $visitor_id, time() + (86400), "/"); // single day because our system is small
} else {
    $visitor_id = $_COOKIE['visitor_id'];
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    // assign 'guest' for generic visitors'
    $role = 'guest';
}

if (!isset($_SESSION['visitor_recorded'])) {
    // Insert visitor data into the database
    $stmt = $conn->prepare("INSERT INTO visitors (visitor_id, role) VALUES (?, ?)");
    $stmt->bind_param("ss", $visitor_id, $role);
    $stmt->execute();
    $stmt->close();

    // Mark the visitor as recorded in the session
    $_SESSION['visitor_recorded'] = true;
}

// Fetch visitor statistics
$studentCount = $conn->query("SELECT COUNT(*) AS count FROM visitors WHERE role = 'student'")->fetch_assoc()['count'];
$facultyCount = $conn->query("SELECT COUNT(*) AS count FROM visitors WHERE role = 'faculty'")->fetch_assoc()['count'];
$guestCount = $conn->query("SELECT COUNT(*) AS count FROM visitors WHERE role = 'guest'")->fetch_assoc()['count'];


// $sql = "SELECT * FROM books ORDER BY created_at DESC LIMIT 10";
// $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="icon" href="assets/AASTU Logo 2_title.jpg" type="image/x-icon">
    <link rel="stylesheet" href="main.css">
    <!-- Google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Google up_arrow icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Google menu icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>

    <div class="menu-toggled" onclick="toggleBack()">
        <ul>
            <?php if ($loggedIn) {
                echo '<li id = "wecome_menu">Welcome, ' . htmlspecialchars($_SESSION["name"]) . '</li>';
            } ?>
            <li class="discussion1"><a href="../DiscussionPage/DiscussionPage.html">DISCUSSION</a></li>
            <li class="book-link"><a href="../bookdetails/bookrender.php">BOOKS</a></li>
            <li><a href="../about_us/about_us.html">ABOUT US </a></li>
            <li><a href="../contact_us/contact_us.html">CONTACT US </a></li>

            <?php if ($loggedIn) {
                echo '<div id="nav_welcome">';
                echo '<a href="logout.php" class="btn btn-lgn btn-log-out">LOG OUT</a>';
                echo '</div>';
            } else {
                echo '<li class="register"><a href="../auth_page/registeration.php">REGISTER </a></li>';
                echo '<li class="signin"><a href="../auth_page/login.php">SIGN IN</a></li>';
            } ?>
        </ul>
    </div>
    <header>
        <div class="container">
            <nav>
                <div class="logo-bg">
                    <div class="logo">
                        <img src="assets/AASTU_Logo_2-removebg-preview.png" alt="">
                    </div>
                </div>

                <div class="navg">

                    <ul>
                        <div class="inner-link">
                            <li class="discussion1"><a href="../DiscussionPage/DiscussionPage.html">DISCUSSION</a></li>
                            <li class="book-link"><a href="../bookdetails/bookrender.php">BOOKS</a></li>
                            <li id="about-h"><a href="../about_us/about_us.html">ABOUT US </a></li>
                            <li id="contact-h"><a href="../contact_us/contact_us.html">CONTACT US </a></li>
                            <li class="register" id="register"><a href="../auth_page/registeration.php">REGISTER </a>
                            </li>
                        </div>
                        <?php if (!$loggedIn) {
                            echo '<li class="signin" id="signin"><a class="btn btn-m btn-sign-in" href="../auth_page/login.php">SIGN IN</a></li>';
                        }
                        ?>
                    </ul>


                </div>
                <?php if ($loggedIn) {
                    echo '<div id="nav_welcome">';
                    echo '<p>Welcome, ' . htmlspecialchars($_SESSION["name"]) . '</p>';
                    echo '<a href="logout.php" class="btn btn-lgn btn-log-out">LOG OUT</a>';
                    echo '</div>';
                } ?>
                <button id="menu-button" class="menu-button hidden-checkbox" onclick="toggle()">
                    <label for="menu-button" class="menu-label"><span class="material-symbols-outlined">
                            menu
                        </span>
                    </label>
                </button>


            </nav>
        </div>
    </header>
    <div class="nextToHeader">

    </div>
    <div class="container">

        <main>
            <!-- this is the search section  -->
            <section class="search-bar-container">
                <form action="" class="search-bar">
                    <input type="text" name="q" placeholder="search library">
                    <button type="submit"><img src="assets/search_icon.svg"></button>
                </form>
            </section>

            <!-- this the book list section  -->
            <section class="books-store">
                <div class="books-shelf">
                    <div class="books-row1">
                        <div class="book">
                            <img src="assets/1000 Examples Programming In Python.jpg" alt="1000 Examples Programming In Python">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                        <div class="book">
                            <img src="assets/Advanced TypeScript Programming Projects - Build 9 different apps with TypeScript 3 and JavaScript.jpg" alt="Advanced TypeScript Programming Projects - Build 9 different apps with TypeScript 3 and JavaScript">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                        <div class="book">
                            <img src="assets/Complete Guide to Modern JavaScript.jpg" alt="Complete Guide to Modern JavaScript">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                        <div class="book">
                            <img src="assets/Javascript in the Indsutry.jpg" alt="Javascript in the Indsutry"></td>
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                        <div class="book">
                            <img src="assets/JavaScript for Impatient Programmers.jpg" alt="JavaScript for Impatient Programmers">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>

                        <div class="book">
                            <img src="assets/Functional Programming in JavaScript.jpg" alt="Functional Programming in JavaScript">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                    </div>
                    <div class="books-row2">

                        <div class="book">
                            <img src="assets/Graphic JavaScript Algorithms - Graphic learn Data Structure and Algorithm for JavaScript.jpg" alt="Graphic JavaScript Algorithms - Graphic learn Data Structure and Algorithm for JavaScript">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                        <div class="book">
                            <img src="assets/Instant Interactive Map Designs with Leaflet JavaScript Library How-to.jpg" alt="Graphic JavaScript Algorithms - Graphic learn Data Structure and Algorithm for JavaScript">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                        <div class="book">
                            <img src="assets/Javascript - Novice to Ninja.jpg" alt="Javascript - Novice to Ninja">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                        <div class="book">
                            <img src="assets/Javascript 3 books in 1.jpg" alt="Javascript 3 books in 1">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                        <div class="book">
                            <img src="assets/JavaScript Crash Course.jpg" alt="JavaScript Crash Course">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                        <div class="book">
                            <img src="assets/JavaScript Everywhere.jpg" alt="JavaScript Everywhere">
                            <a class="btn btn-sm btn-outline-download">DOWNLOAD</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- This is our goal section  -->
            <section>
                <div class="goal">
                    <div class="goal-img">
                        <img src="https://images.unsplash.com/photo-1526243741027-444d633d7365?q=80&w=871&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="books">
                    </div>
                    <div class="goaltxt">
                        <h2>Our Goal</h2>
                        <p>Welcome to AASTU eLibrary, the digital heartbeat of Addis Ababa Science and Technology
                            University. Our mission is simple yet powerful: to empower AASTU's students and staff with
                            easy access to a rich tapestry of academic resources. Dive into our extensive digital
                            collection, available 24/7 for your convenience. We're not just a library; we're a dynamic
                            hub fostering academic excellence. Join us on this journey of knowledge exploration and
                            innovation at AASTU eLibrary.</p>
                    </div>
                </div>
            </section>
    </div>
    <!-- The banner  -->

    <section>
        <div class="banner">
            <!-- <img src="assets/banner_2.svg" alt=""> -->
        </div>
    </section>

    <!-- New arrival section  -->
    <div class="container">
        <h2 class="arrive-heading">New Arrivals</h2>
        <section class="arrive-store">

            <?php
            // SQL query to fetch books from the database
            $sql = "SELECT * FROM books ORDER BY created_at DESC LIMIT 10";
            $result = $conn->query($sql);
            foreach ($result as $book) {
                echo '<div class="book arrive-book">';
                echo '<img src="../images/' . htmlspecialchars($book['img']) . '" alt="' . htmlspecialchars($book['title']) . '">';
                echo '<p>New Arrival</p>';
                // echo '<a class="btn btn-sm btn-primary" href="bookrend.php' . htmlspecialchars($book['id']) . '">LEARN MORE</a>';
                echo '</div>';
            }
            ?>
        </section>
    </div>
    </main>

    <div class="container">


    </div>

    <!-- this is the footer    -->

    <footer>
        <div class="footer-upper-container">
            <div class="note">
                <p>READY FOR YOUR <br><span class="primary-txt">NEXT</span> E-BOOK <span class="primary-txt">?</span>
                </p>
            </div>
            <div class="upper-links">
                <ul>
                    <li class="signin"><a href="../auth_page/login.php">SIGN IN</a></li>
                    <li class="register"><a href="../auth_page/registeration.php">REGISTER</a></li>
                    <li><a href="../about_us/about_us.html">ABOUT US</a></li>
                    <li><a href="../contact_us/contact_us.html">CONTACT US</a></li>

                </ul>
            </div>
        </div>
        <!--the bottom last footer of the page -->
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; 2024 AASTU | Software Savants&trade;</p>
            </div>
        </div>
    </footer>
    <!-- Scroll top  -->
    <button id="scroll-to-top" onclick="scrollToTop()"><img src="assets/go_top.svg" alt=""></button>
    <script src="app.mjs"></script>
    <script src="loggedIn.js"></script>
    <?php $conn->close();?>
</body>

</html>