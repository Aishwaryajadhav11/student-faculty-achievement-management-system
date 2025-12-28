<?php
// student_submit.php
require 'db.php';

function uploadErrorMessage($code) {
    $map = [
        UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds server limit.",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds form limit.",
        UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION  => "A PHP extension stopped the file upload.",
    ];
    return $map[$code] ?? "Unknown upload error (code: $code).";
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Invalid request method.");
}

// Collect form data
$name        = trim($_POST['name'] ?? '');
$prn         = trim($_POST['prn'] ?? '');
$department = trim($_POST['department']);
$class       = trim($_POST['class'] ?? '');
$event       = trim($_POST['event'] ?? '');
$achievement = trim($_POST['achievement'] ?? $_POST['achievement_type'] ?? '');

// 🚨 Make PRN mandatory
if ($prn === '') {
    exit("Error: PRN is required. Please go back and enter your PRN.");
}

// File upload handling
$certificatePath = '';
if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] !== UPLOAD_ERR_NO_FILE) {
    $fileErr = $_FILES['certificate']['error'];
    if ($fileErr !== UPLOAD_ERR_OK) {
        exit("File upload error: " . uploadErrorMessage($fileErr));
    }

    $uploadDir = __DIR__ . '/uploads/students/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
            exit("Failed to create upload directory.");
        }
    }

    $originalName = basename($_FILES['certificate']['name']);
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
    try {
        $rand = bin2hex(random_bytes(8));
    } catch (Exception $e) {
        $rand = time() . mt_rand(1000,9999);
    }
    $safeName = 'stud_' . time() . '_' . $rand;
    if ($ext !== '') $safeName .= '.' . $ext;

    $targetFullPath = $uploadDir . $safeName;
    if (!move_uploaded_file($_FILES['certificate']['tmp_name'], $targetFullPath)) {
        exit("Failed to move uploaded file.");
    }

    $certificatePath = 'uploads/students/' . $safeName;
}

// Insert into DB
$stmt = $conn->prepare(
    "INSERT INTO students_achievements 
     (name, prn, department, class, event, achievement_type, certificate) 
     VALUES (?, ?, ?, ?, ?, ?, ?)"
);

if ($stmt === false) {
    exit("DB prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "sssssss",
    $name,
    $prn,
    $department, 
    $class,
    $event,
    $achievement,
    $certificatePath
);

$ok = $stmt->execute();

if ($ok) {
    $viewLink = 'student_view.php?prn=' . urlencode($prn);
    echo "<!doctype html><html><head><meta charset='utf-8'><title>Submission Success</title>
          <style>
            body{font-family:Arial,Helvetica,sans-serif;background:#0a3e7f;color:#fff;display:flex;
                  align-items:center;justify-content:center;height:100vh;margin:0}
            .card{background:#0c4a89;padding:30px;border-radius:12px;max-width:420px;text-align:center;box-shadow:0 6px 20px rgba(0,0,0,.25)}
            a.btn{display:inline-block;padding:10px 18px;margin:10px;border-radius:6px;text-decoration:none;color:#fff}
            a.primary{background:#2978f0}
            a.secondary{background:#28a745}
          </style></head><body>
          <div class='card'>
            <h2>🎉 Achievement submitted successfully!</h2>
            <p>Your record has been saved for PRN: <b>" . htmlspecialchars($prn) . "</b></p>
            <p>
              <a class='btn primary' href='" . htmlspecialchars($viewLink, ENT_QUOTES) . "'>📄 View Achievements</a><br>
              <a class='btn secondary' href='index.html'>⬅ Back to Dashboard</a>
            </p>
          </div>
          </body></html>";
} else {
    echo "Database error: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
