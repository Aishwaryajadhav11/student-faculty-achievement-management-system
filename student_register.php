<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $prn = trim($_POST['prn']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO student_users (name, prn, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $prn, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please login.'); window.location='student_login.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Student Registration</title>
  <style>
    body {
      background: #0a3e7f;
      color: white;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .box {
      background: #124d84;
      padding: 30px;
      border-radius: 10px;
      width: 320px;
      text-align: center;
    }
    h2 {
      margin-bottom: 20px;
    }
    input {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 6px;
    }
    button {
      padding: 10px 20px;
      border: none;
      background: #2978f0;
      color: white;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      background: #1e56b4;
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>📝 Student Registration</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Full Name" required><br>
      <input type="text" name="prn" placeholder="PRN" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Register</button>
    </form>
    <p style="margin-top:15px;">Already registered? <a href="student_login.php" style="color:#fff;">Login here</a></p>
  </div>
</body>
</html>
