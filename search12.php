<?php
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Search data</title>
</head>
<body>";

if(isset($_GET['query'])){
    $search = $_GET['query'];

    // Replace these connection details with your actual database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Use an empty string if there is no password
    $dbname = "tesst"; // Replace with the actual database name

    // Create connection
    $con = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Corrected SQL query using backticks around table and column names
    $query = "SELECT * FROM `connectt` WHERE CONCAT(Subject_name) LIKE '%$search%'";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        if(mysqli_num_rows($query_run) > 0) {
            echo '<table border="1">';
            echo '<thead>
                    <tr>
                        <th>Subject</th>
                        <th>Topic</th>
                        <th>Action</th>
                    </tr>
                </thead>';
            while($row = mysqli_fetch_assoc($query_run)) {
                echo '<tr>
                        <td>'.$row['subject_name'].'</td>
                        <td>'.$row['Topic'].'</td>
                        <td><p> <a href='.$row['link'].'>View</a> | <a href='.$row['link'].' Download > Download</p></a> </td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo "No results found for query: '$search'";
        }
    } else {
        echo "Error in query: " . mysqli_error($con);
    }

    $con->close();
}

echo "</body></html>";
?>
