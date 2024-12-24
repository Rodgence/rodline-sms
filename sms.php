<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send SMS via Beem Africa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Send SMS On RodLine </h4>
            </div>
            <div class="card-body">
                <form action="send_sms.php" method="post">
                    <div class="mb-3">
                        <label for="phone_numbers" class="form-label">Phone Numbers</label>
                        <input type="text" id="phone_numbers" name="phone_numbers" class="form-control" 
                               placeholder="Enter phone numbers separated by commas (e.g., 255700000001,255700000011)" required>
                        <div class="form-text">Use a comma to separate multiple phone numbers.</div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" rows="5" class="form-control" placeholder="Enter your message here" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Send SMS Now</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$consumer_key = 'ck_b3050299a18857eb3740eceee699c8cc46927486';
$consumer_secret = 'cs_401bf55b89c12958f5faf52b9717f6ba6f898742';
$store_url = 'https://rodline.shop/wp-json/wc/v3/orders';

// Fetch only completed orders
$params = [
    'status' => 'completed',
    'per_page' => 100 // Adjust as needed
];

$url = $store_url . '?' . http_build_query($params);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$consumer_key:$consumer_secret");

$response = curl_exec($ch);

if ($response === false) {
    die('Error: ' . curl_error($ch));
}

curl_close($ch);

// Decode the JSON response
$orders = json_decode($response, true);

// Start outputting the table
echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
    <thead>
        <tr>
            <th style='padding: 10px; text-align: left;'>#</th>
            <th style='padding: 10px; text-align: left;'>First Name</th>
            <th style='padding: 10px; text-align: left;'>Phone Number</th>
            <th style='padding: 10px; text-align: left;'>Product Name</th>
        </tr>
    </thead>
    <tbody>";

if (!empty($orders)) {
    $counter = 1;
    foreach ($orders as $order) {
        $first_name = $order['billing']['first_name'] ?? 'N/A';
        $phone_number = $order['billing']['phone'] ?? 'N/A';
        $products = [];
        
        // Fetch product names from the order
        foreach ($order['line_items'] as $item) {
            $products[] = $item['name'];
        }
        $product_names = implode(', ', $products);

        echo "<tr>
            <td style='padding: 10px;'>$counter</td>
            <td style='padding: 10px;'>$first_name</td>
            <td style='padding: 10px;'>$phone_number</td>
            <td style='padding: 10px;'>$product_names</td>
        </tr>";
        $counter++;
    }
} else {
    echo "<tr>
        <td colspan='4' style='padding: 10px; text-align: center;'>No data found</td>
    </tr>";
}

echo "</tbody>
</table>";
?>
