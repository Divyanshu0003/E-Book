<?php
// Assuming this PHP code is within a file named "connect.php"
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Loading Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .loading-container {
            text-align: center;
        }

        .loading-spinner {
            border: 8px solid rgba(255, 255, 255, 0.3);
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .progress-bar-container {
            width: 100%;
            height: 20px;
            background-color: #eee;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            width: 0;
            background-color: #3498db;
            animation: fill 3s ease-in-out forwards; /* Adjust the duration as needed */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fill {
            0% { width: 0; }
            100% { width: 100%; }
        }
    </style>
</head>
<body>
    <div class='loading-container'>
        <div class='loading-spinner'></div>
        
        <p>  Record inserted successfully!; </p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'tt.html';
        },1000); // Redirect after 1.8 seconds (adjust as needed)
    </script>
</body>
</html>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $subject_name = isset($_POST["subject"]) ? $_POST["subject"] : '';
    $topic = isset($_POST["topic"]) ? $_POST["topic"] : '';
    $link = isset($_POST["link"]) ? $_POST["link"] : '';

    // Ensure that subject_name is not null before processing the form
    if ($subject_name !== null) {
        $link = "http://localhost/EBook/doc/" . $link;

        // Use the retrieved data as needed (e.g., store in the database, send an email, etc.)
        // Remember to validate and sanitize user input before using it in any database operations

        // For example, to store data in a database using mysqli:
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tesst";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO connectt (subject_name, topic, link) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $subject_name, $topic, $link);

        if ($stmt->execute()) {
            // Success
           
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        // Handle the case when subject_name is null
        echo "Error: Subject is not set.";
    }
}
?>
