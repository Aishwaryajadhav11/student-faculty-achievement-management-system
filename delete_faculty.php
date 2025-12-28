<<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  exit("Invalid ID");
}

// Delete faculty record
$stmt = $conn->prepare("DELETE FROM faculty_achievements WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  header("Location: admin_view.php?msg=Faculty+deleted+successfully");
  exit;
} else {
  echo "Error: " . $stmt->error;
}
?>
