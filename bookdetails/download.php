<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = ""; 
$db_name = "library";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT path FROM books WHERE bid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($filepath);
    $stmt->fetch();
    echo"$filepath";
    if(file_exists($filepath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "Error: File not found.";
    }
    $stmt->close();
}
$conn->close();
?>


