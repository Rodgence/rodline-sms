<?php
 include("includes/header.php");
?>

<body class="bg-light">
    <section class="container mt-3">
        <div class="row justify-content-md-center">
            <form action="mail.php" method="POST" class="col-md-6 col-sm-12 bg-light p-4 rounded shadow">
                <div class="col-12 text-center">
                    <h3 class="text-primary"><strong>Register for Bulk SMS</strong></h3>
                </div>
                <div class="mb-2">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-2">
                    <label for="phone" class="form-label">phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="+255" required>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" id="address" required>
                </div>
                <div class="mb-2">
                    <label for="confirm_password" class="form-label">Confirm-Password</label>
                    <input type="text" class="form-control" id="location" name="confirm_password" required>
                </div>
                
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary btn-rounded w-75">Register Now</button>
                </div>
                
            </form>
        </div>
    </section>
</body>
 <?php
 include("includes/footer.php");
 ?>