<?php

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "messaging_systems";

$connn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// function for search bar functionality

// Check connection
if($connn === false){
    die("ERROR: Could not connect. " . $connn->connect_error);
}

if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM register WHERE UserName LIKE ?";

    if($stmt = $connn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_term);

        // Set parameters
        $param_term = $_REQUEST["term"] . '%';

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();

            // Check number of rows in the result set
            if($result->num_rows > 0){
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    echo "<p>" . $row["UserName"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }

    // Close statement
    $stmt->close();
}

// Close connection
$connn->close();
 ?>