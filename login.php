<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "tesst";

// Create connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name= $_POST["name"];
    $Password = $_POST["Password"];

    // Fetch user data from the database
    $stmt = $conn->prepare("SELECT * FROM details WHERE name = ? AND Password = ?");
    $stmt->bind_param("ss", $name, $Password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >= 0) {
        // Login successful
        $_SESSION['user'] = $result->fetch_assoc();
        header("Location: Book.html");
        exit();
    } else {
        $_SESSION['message'] = 'Invalid email or password. Please try again.';
    }

    $stmt->close();
}

$conn->close();
?>  