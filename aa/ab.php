<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fashion";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $user_type = $conn->real_escape_string($_POST['user_type']);

    // Initialize result variables
    $checkEmailResult = null;
    $checkUsernameResult = null;

    // Check if the email already exists
    $checkEmailSql = "SELECT * FROM users WHERE EMAIL='$email'";
    if ($checkEmailResult = $conn->query($checkEmailSql)) {
        // Check if the username already exists
        $checkUsernameSql = "SELECT * FROM users WHERE USERNAME='$name'";
        if ($checkUsernameResult = $conn->query($checkUsernameSql)) {
            if ($checkEmailResult->num_rows > 0) {
                echo "<p>Email already exists. Please use a different email.</p>";
            } elseif ($checkUsernameResult->num_rows > 0) {
                echo "<p>Username already exists. Please choose a different username.</p>";
            } else {
                // Insert new staff data
                $sql = "INSERT INTO users (USERNAME, EMAIL, USER_TYPE) VALUES ('$name', '$email', '$user_type')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>New staff added successfully!</p>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "Error checking username: " . $conn->error;
        }
    } else {
        echo "Error checking email: " . $conn->error;
    }

    $conn->close();
}
?>
