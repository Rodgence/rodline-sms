<?php
// API credentials
$api_key = '7ea69236bb5bbf22';
$secret_key = 'ZWRmM2QzNWQyYWE4M2MwZjlmZDQ2YzdhY2RjN2RiYWVhMDZmZjk4YTY5MzIwMzdiMDQ3ZTA5YTFmMzY0YzBlYw==';

// Sender ID
$sender_id = 'RodLine';

// Collect data from the form
$phone_numbers = $_POST['phone_numbers'];
$message = $_POST['message'];

// Convert the comma-separated phone numbers into an array
$recipients = [];
$phone_array = explode(',', $phone_numbers);
foreach ($phone_array as $index => $phone) {
    $recipients[] = [
        'recipient_id' => (string)($index + 1),
        'dest_addr' => trim($phone)
    ];
}

// API endpoint
$url = 'https://apisms.beem.africa/v1/send';

// Prepare POST data
$postData = [
    'source_addr' => $sender_id,
    'encoding' => 0,
    'schedule_time' => '',
    'message' => $message,
    'recipients' => $recipients
];

// Initialize cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Basic ' . base64_encode("$api_key:$secret_key"),
        'Content-Type: application/json'
    ],
    CURLOPT_POSTFIELDS => json_encode($postData)
]);

// Execute and fetch the response
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    die('cURL error: ' . curl_error($ch));
}

// Close the connection
curl_close($ch);

// Display response
echo "Response from Beem Africa: <pre>$response</pre>";
?>
