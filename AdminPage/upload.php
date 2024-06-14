<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "uploads/";

    // Handle PDF file upload
    $pdfFile = $_FILES["bookFile"];
    $targetPdfFile = $targetDir . basename($pdfFile["name"]);
    $pdfUploadSuccess = false;

    // Check for errors before moving uploaded file
    if ($pdfFile["error"] == 0) {
        $pdfUploadSuccess = move_uploaded_file($pdfFile["tmp_name"], $targetPdfFile);
    } else {
        echo "Error uploading PDF file.";
    }

    // Handle Image file upload
    $targetDir = "images/";
    $imgFile = $_FILES["bookImage"];
    $targetImgFile = $targetDir . basename($imgFile["name"]);
    $tr = basename($imgFile["name"]);
    $imgUploadSuccess = false;

    // Check for errors before moving uploaded file
    if ($imgFile["error"] == 0) {
        $imgUploadSuccess = move_uploaded_file($imgFile["tmp_name"], $targetImgFile);
    } else {
        echo "Error uploading image file.";
    }

    if ($pdfUploadSuccess && $imgUploadSuccess) {
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "library";
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data
        $bookId = $_POST['bookId'];
        $bookTitle = $_POST['bookTitle'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];
        $description = $_POST['description'];

        // Prepare the statement
        $stmt = $conn->prepare("INSERT INTO books (bid, title, author, img, path, description, genre) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $bookId, $bookTitle, $author, $tr, $targetPdfFile, $description, $genre);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "The file " . htmlspecialchars(basename($pdfFile["name"])) . " and image " . htmlspecialchars(basename($imgFile["name"])) . " have been uploaded and their paths have been stored in the database.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your files.";
    }
} else {
    echo "Error: No file uploaded or invalid request method.";
}
?>
