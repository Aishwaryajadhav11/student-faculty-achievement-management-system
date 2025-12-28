<?php
include("db.php");

$id = $_GET['id'];
$sql = "SELECT * FROM students_achievements WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $event = $_POST['event'];
    $achievement = $_POST['achievement'];

    // Handle file upload (optional)
    $certificate = $row['certificate']; // keep old if not replaced
    if (!empty($_FILES["certificate"]["name"])) {
        $targetDir = "uploads/";
        $fileName = time() . "_" . basename($_FILES["certificate"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $targetFilePath)) {
            $certificate = $targetFilePath;
        }
    }

    $update = "UPDATE students_achievements 
               SET name='$name', class='$class', event='$event', achievement_type='$achievement', certificate='$certificate' 
               WHERE id='$id'";

    if ($conn->query($update) === TRUE) {
        echo "<script>alert('Record updated successfully!'); window.location.href='admin_view.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Student</title>
  <style>
    body { background:#0b3c68; font-family:Arial; color:white; padding:20px; }
    .container { background:#124d84; padding:20px; border-radius:10px; width:400px; margin:auto; }
    input, select { width:100%; margin:8px 0; padding:8px; border-radius:5px; border:none; }
    button { padding:10px; background:black; color:white; border:none; border-radius:5px; cursor:pointer; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Edit Student Achievement</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>Name:</label>
      <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

      <label>Class:</label>
      <select name="class" required>
        <option value="SY" <?php if($row['class']=="SY") echo "selected"; ?>>SY</option>
        <option value="TY" <?php if($row['class']=="TY") echo "selected"; ?>>TY</option>
        <option value="B.Tech" <?php if($row['class']=="B.Tech") echo "selected"; ?>>B.Tech</option>
      </select>

      <label>Event:</label>
      <input type="text" name="event" value="<?php echo $row['event']; ?>" required>

      <label>Achievement:</label>
      <select name="achievement" required>
        <?php 
        $achievements = ["Participation","Winner 1st position","Winner 2nd position","Winner 3rd position","1st Runner up","2nd Runner up","Intern"];
        foreach($achievements as $a){
            $sel = ($row['achievement_type']==$a) ? "selected" : "";
            echo "<option value='$a' $sel>$a</option>";
        }
        ?>
      </select>

      <label>Upload Certificate (optional):</label>
      <input type="file" name="certificate">

      <p>Current File: 
        <?php if(!empty($row['certificate'])): ?>
          <a href="<?php echo $row['certificate']; ?>" target="_blank">View</a>
        <?php else: ?>
          None
        <?php endif; ?>
      </p>

      <button type="submit">Update</button>
    </form>
  </div>
</body>
</html>
