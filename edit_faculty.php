<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit("Invalid ID");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $empid = $_POST['empid'];
  $department = $_POST['department'];
  $event = $_POST['event'];
  $details = $_POST['details'];
  $certificatePath = $_POST['existing_certificate'];

  // Handle file upload
  if (!empty($_FILES['certificate']['name'])) {
    $uploadDir = __DIR__ . '/uploads/faculty/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $ext = pathinfo($_FILES['certificate']['name'], PATHINFO_EXTENSION);
    $fileName = 'fac_' . uniqid() . '.' . $ext;
    $tmp = $_FILES['certificate']['tmp_name'];

    if (move_uploaded_file($tmp, $uploadDir . $fileName)) {
      $certificatePath = 'uploads/faculty/' . $fileName;
    }
  }

  $sql = "UPDATE faculty_achievements
          SET name=?, empid=?, department=?, event=?, details=?, certificate=?
          WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssi", $name, $empid, $department, $event, $details, $certificatePath, $id);

  if ($stmt->execute()) {
    header("Location: admin_view.php?msg=Faculty+updated+successfully");
    exit;
  } else {
    echo "Error: " . $stmt->error;
  }
} else {
  $res = $conn->query("SELECT * FROM faculty_achievements WHERE id=$id");
  $row = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Faculty</title>
  <style>
    body { background:#0b3c68; font-family:Arial; color:white; padding:20px; }
    .container { background:#124d84; padding:20px; border-radius:10px; width:450px; margin:auto; }
    input, textarea { width:100%; margin:8px 0; padding:8px; border-radius:5px; border:none; }
    button { padding:10px; background:black; color:white; border:none; border-radius:5px; cursor:pointer; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Edit Faculty Achievement</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>Name:</label>
      <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>

      <label>Employee ID:</label>
      <input type="text" name="empid" value="<?= htmlspecialchars($row['empid']) ?>" required>

      <label>Department:</label>
      <input type="text" name="department" value="<?= htmlspecialchars($row['department']) ?>" required>

      <label>Event:</label>
      <select name="event" required>
        <?php
        $events = [
          "International Conference Paper",
          "International Journal Paper",
          "FDP",
          "Workshop",
          "Resource Person",
          "Invited Judge",
          "Keynote Speaker"
        ];
        foreach ($events as $e) {
          $sel = ($row['event'] == $e) ? "selected" : "";
          echo "<option value='$e' $sel>$e</option>";
        }
        ?>
      </select>

      <label>Details:</label>
      <textarea name="details" rows="4" required><?= htmlspecialchars($row['details']) ?></textarea>

      <p>Current Certificate: 
        <?php if ($row['certificate']): ?>
          <a href="<?= $row['certificate'] ?>" target="_blank">View</a>
        <?php else: ?> None <?php endif; ?>
      </p>
      <input type="hidden" name="existing_certificate" value="<?= $row['certificate'] ?>">
      <input type="file" name="certificate">

      <button type="submit">Update</button>
    </form>
  </div>
</body>
</html>
