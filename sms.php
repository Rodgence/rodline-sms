
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send SMS</title>
</head>
<body>
    <h2>Send SMS via Beem Africa</h2>
    <form action="send_sms.php" method="post">
        <label for="phone_numbers">Phone Numbers (comma-separated):</label><br>
        <input type="text" id="phone_numbers" name="phone_numbers" placeholder="255700000001,255700000011" required><br><br>
        
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="5" cols="30" placeholder="Enter your message here" required></textarea><br><br>
        
        <button type="submit">Send SMS</button>
    </form>
</body>
</html>

