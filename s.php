<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Dynamic Dropdown</title>
</head>
<body>
<img src="/xampppp/htdocs/EBook/Screenshot_2024-02-20_155143-removebg-preview.png" style="width: 500px; height: 500px; margin: 10px;">

<form action="notesdrop.php" method="post">
    <label for="subject">Subject:</label>
    <select id="subject" name="subject" class="subject_name">
        <?php
            // Connect to your database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tesst";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from the database
            $sql = "SELECT subject_name FROM connectt";
            $result = $conn->query($sql);

            // Generate options based on database query results
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['subject_name'] . '">' . $row['subject_name'] . '</option>';
                }
            } else {
                echo '<option value="">No subjects found</option>';
            }

            // Close the database connection
            $conn->close();
        ?>
    </select>
    <input type="submit">
</form>

</body>
</html>
