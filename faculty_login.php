<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empid = trim($_POST['empid']);
    $password = trim($_POST['password']);

    // Query DB for faculty
    $stmt = $conn->prepare("SELECT * FROM faculty_users WHERE empid=? LIMIT 1");
    $stmt->bind_param("s", $empid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // ✅ Verify hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_type'] = 'faculty';
            $_SESSION['empid'] = $row['empid'];

            header("Location: faculty.php"); // 🔹 change to your correct faculty form page
            exit;
        } else {
            $error = "❌ Invalid password!";
        }
    } else {
        $error = "❌ No faculty found with this Employee ID!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login as Faculty</title>
  <style>
    body { background:#0a3e7f; color:white; font-family:Arial; display:flex;
           justify-content:center; align-items:center; height:100vh; margin:0; }
    .box { background:#124d84; padding:30px; border-radius:10px; width:320px; text-align:center; }
    input { width:90%; padding:10px; margin:10px 0; border:none; border-radius:6px; }
    button { padding:10px 20px; border:none; background:#2978f0; color:white; border-radius:6px; cursor:pointer; }
    button:hover { background:#1e56b4; }
    .error { color:#ff6b6b; margin:10px 0; }
  </style>
</head>
<body>
  <div class="box">
    <h2>👩‍🏫 Login as Faculty</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="empid" placeholder="Employee ID" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>
    <p style="margin-top:15px;">New user? <a href="faculty_register.php" style="color:#fff;">Register here</a></p>
  </div>
</body>
</html>
