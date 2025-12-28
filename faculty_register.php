<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $empid = trim($_POST['empid']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

    // prevent duplicate empid
    $check = $conn->prepare("SELECT id FROM faculty_users WHERE empid=? LIMIT 1");
    $check->bind_param("s", $empid);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('❌ Employee ID already exists!'); window.location.href='faculty_register.php';</script>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO faculty_users (name, empid, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $empid, $password);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Faculty registered successfully!'); window.location.href='faculty_login.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register Faculty</title>
  <style>
    body { background:#0a3e7f; color:white; font-family:Arial; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
    .box { background:#124d84; padding:30px; border-radius:10px; width:350px; }
    input { width:95%; padding:10px; margin:8px 0; border:none; border-radius:6px; }
    button { padding:10px; border:none; background:#28a745; color:white; border-radius:6px; cursor:pointer; width:100%; }
    button:hover { background:#218838; }
  </style>
</head>
<body>
  <div class="box">
    <h2>📝 Faculty Registration</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="text" name="empid" placeholder="Employee ID" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
    </form>
  </div>
</body>
</html>
