<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prn = trim($_POST['prn']);
    $password = trim($_POST['password']);

    // Query DB for student
    $stmt = $conn->prepare("SELECT * FROM student_users WHERE prn=? LIMIT 1");
    $stmt->bind_param("s", $prn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // For now plain password check (better: use password_hash)
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_type'] = 'student';
            $_SESSION['prn'] = $row['prn'];
            header("Location: student.php");
            exit;
        } else {
            $error = "❌ Invalid password!";
        }

    } else {
        $error = "❌ No student found with this PRN!";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Login as Student</title>
    <style>
        body {
            background: #0a3e7f;
            color: white;
            font-family: Arial;
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
        }

        button:hover {
            background: #1e56b4;
        }

        .error {
            color: #ff6b6b;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>🔑 Login as Student</h2>
        <?php if (!empty($error))
            echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="prn" placeholder="PRN" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <p style="margin-top:15px;">New user? <a href="student_register.php" style="color:#fff;">Register here</a></p>
    </div>
</body>

</html>