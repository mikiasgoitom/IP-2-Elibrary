<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the form
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($query) {
    // SQL query to search for books by title or author
    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ?");
    $searchTerm = "%$query%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // SQL query to fetch all books from the database
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="bookstyleprogress.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="onprogress.js" defer></script>
</head>

<body>
    <header>
        <div class="navbar">
            <a href="javascript:history.back()" class="back-button">
                <i class="las la-angle-left"></i>
            </a>
            <div class="links">
                <ul>
                    <li><a href="homepage.php">HOME</a></li>
                    <li><a href="DiscussionPage.php">DISCUSSION</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <div class="main-content">
            <div class="book-details-container">
                <!-- This is the search section -->
                <section class="search-bar-container">
                    <form action="bookrender.php" method="get" class="search-bar">
                        <input type="text" name="q" placeholder="Search by title or author" value="<?php echo htmlspecialchars($query); ?>" >
                        <button type="submit">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </form>
                </section>
                
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="book-container">';
                        echo '    <div class="book-img">';
                        echo '        <img src="images/' . htmlspecialchars($row['img']) . '" alt="Book Cover" class="book-cover">';
                        echo '    </div>';
                        echo '    <div class="book-details">';
                        echo '        <h2 class="book-title">' . htmlspecialchars($row['title']) . '</h2>';
                        echo '        <p class="book-author">Author: ' . htmlspecialchars($row['author']) . '</p>';
                        echo '        <p class="Genre">Genre: ' . htmlspecialchars($row['genre']) . '</p>';
                        echo '        <div class="rating">';
                        echo '            Rating: ';
                        for ($i = 1; $i <= 5; $i++) {
                            echo '            <input type="checkbox" id="star' . $i . '" checked>';
                            echo '            <label for="star' . $i . '"></label>';
                        }
                        echo '        </div>';
                        echo '        <br><br>';
                        echo '        <button class="des">Description</button>';
                        echo '        <div class="discription hidden">';
                        echo '          <p id="description1">' . htmlspecialchars($row['description']) . '</p>';
                        echo '        </div>';
                        echo '        <br><br>';
                        echo '        <a href="download.php?id=' . urlencode($row['bid']) . '" class="download-button">Download</a>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No books found.</p>";
                }
                ?>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy;2024 AASTU | Developed Software Savants&trade;</p>
            </div>
        </div>
    </footer>
</body>

</html>
