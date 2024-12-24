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
                <h4 class="mb-0">Send SMS via Beem Africa</h4>
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
                    <button type="submit" class="btn btn-success w-100">Send SMS</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
