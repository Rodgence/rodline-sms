<?php
include("includes/header.php");

// Replace with your API key and secret key
$api_key = '7ea69236bb5bbf22';
$secret_key = 'ZWRmM2QzNWQyYWE4M2MwZjlmZDQ2YzdhY2RjN2RiYWVhMDZmZjk4YTY5MzIwMzdiMDQ3ZTA5YTFmMzY0YzBlYw==';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['password'];
    $location = $_POST['confirm_password'];

    // Construct the messages
    $message = "New SMS Customer:\nName: $fullname\nEmail: $email\nPhone: $phone\nAddress: $address\nLocation: $location";

    // Prepare the payload for the SMS
    $postData = array(
        'source_addr' => 'RodLine',
        'encoding' => 0,
        'schedule_time' => '',
        'message' => $message,
        'recipients' => array(
            array('recipient_id' => '1', 'dest_addr' => '+255621764385') // Receiver number
        )
    );

    // API URL
    $Url = 'https://apisms.beem.africa/v1/send';

    // Initialize cURL
    $ch = curl_init($Url);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ' . base64_encode("$api_key:$secret_key"),
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === FALSE) {
        die('Error: ' . curl_error($ch));
    }

    // Close cURL
    curl_close($ch);

    $response_data = json_decode($response, true);
echo '<div class="container mt-4">';
echo '<div class="row">';

// Column for the success or failure message
echo '<div class="col-md-6">';
if (isset($response_data['successful']) && $response_data['successful'] === true) {
    echo '<div class="alert alert-success" role="alert">
            Asante kwa kujisajiri na RodLine SMS!, Account yako Itakua tayari ndani ya dk 5. Login kwenye dashboard ya Rodline SMS kukamirisha uajiri wako. Asante.

            <a href="https://login.easyapps.co/#!/">Login here</a>
          </div>';
} else {
    echo '<div class="alert alert-danger" role="alert">
            Failed to send SMS. Response: ' . htmlspecialchars($response) . '
          </div>';
}
echo '</div>';


echo '</div>'; // Close row
echo '</div>'; // Close container

    
}


// inset into a database

$host = 'localhost';
$username = 'rodlineh_rodlinesms';
$password = '@200r320KK';
$dbname = 'rodlineh_rodlinesms';

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

  

    // Insert data into the database
    $sql = "INSERT INTO bulk_sms_registration (fullname, email, phone, password, confirm_password)
            VALUES ('$fullname', '$email', '$phone', '$password', '$confirm_password')";

    $result = mysqli_query($conn, $sql);

    // Close the database connection
    mysqli_close($conn);
}



include("includes/footer.php");

?>

