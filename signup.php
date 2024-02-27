

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST['email'];
    $password =password_hash($_POST["password"], PASSWORD_DEFAULT);
    

    // Hash the password
    

    // Database connection 
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "tesst";

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO details (name, email, Password) VALUES (?, ? , ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
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
            
            <p> Thank you for your submission. Redirecting...</p>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'tt.html';
            }, 1000); // Redirect after 1.8 seconds (adjust as needed)
        </script>
    </body>
    </html>";
}
?>

