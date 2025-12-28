<?php
// admin_login.php

// Fixed credentials (only these will work)
$admin_email    = "sagarbadjate@gmail.com";
$admin_password = "admin1234"; // <-- change to a strong password

// Read form data
$email    = $_POST['email']    ?? '';
$password = $_POST['password'] ?? '';

// Validate
if ($email === $admin_email && $password === $admin_password) {
    // Correct login
    session_start();
    $_SESSION['admin'] = true;

    header("Location: admin_view.php");
    exit;
} else {
    // Wrong login
    echo "<h2 style='color:red;text-align:center;margin-top:50px'>
            ❌ Invalid email or password
          </h2>";
    echo "<p style='text-align:center'>
            <a href='admin.html'>Go back</a>
          </p>";
}
