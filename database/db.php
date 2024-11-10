<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection (replace with your actual DB details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rodlinesms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form inputs
    $first_name = mysqli_real_escape_string($conn, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($conn, trim($_POST['last_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone_number = mysqli_real_escape_string($conn, trim($_POST['phone_number']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    // Basic form validation (check for empty fields)
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone_number) || empty($password)) {
        echo "All fields are required.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $sql = "INSERT INTO users (first_name, last_name, email, phone_number, password)
                VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            echo "Registration successful.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Close the connection
mysqli_close($conn);
?>
