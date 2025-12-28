<?php
// student_view.php
require 'db.php';

$prn = $_GET['prn'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Achievements</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #0a3e7f;
      color: #fff;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    .form-box {
      max-width: 400px;
      margin: 50px auto;
      background: #124d84;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
    }
    input[type="text"] {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 6px;
    }
    button {
      padding: 10px 20px;
      background: #2978f0;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    button:hover {
      background: #1e56b4;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #124d84;
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px;
      text-align: left;
    }
    th {
      background: #0c4a89;
    }
    tr:nth-child(even) {
      background: #155a9c;
    }
    a.btn {
      display: inline-block;
      padding: 6px 12px;
      background: #28a745;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
    a.btn:hover {
      background: #1e7e34;
    }
    .back {
      margin-top: 20px;
      text-align: center;
    }
  </style>
</head>
<body>
  <h1>📄 Student Achievements</h1>

  <?php if ($prn === '') { ?>
    <!-- Step 1: Ask for PRN -->
    <div class="form-box">
      <form method="get" action="student_view.php">
        <label for="prn">Enter your PRN:</label><br>
        <input type="text" id="prn" name="prn" placeholder="Enter prn" required>
        <br>
        <button type="submit">View Achievements</button>
      </form>
      <div class="back">
        <a class="btn" href="index.html">⬅ Back to Dashboard</a>
      </div>
    </div>
  <?php } else { ?>
    <!-- Step 2: Show results -->
    <?php
    $stmt = $conn->prepare("SELECT * FROM students_achievements WHERE prn = ? ORDER BY created_at DESC");
    $stmt->bind_param("s", $prn);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <h2>Results for PRN: <?php echo htmlspecialchars($prn); ?></h2>
    <table border="1">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>PRN</th>
        <th>Department</th>
        <th>Class</th>
        <th>Event</th>
        <th>Achievement</th>
        <th>Certificate</th>
        <th>Created At</th>
      </tr>
      <?php if ($result->num_rows > 0) { 
        while ($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['prn']); ?></td>
            <td><?php echo htmlspecialchars($row['department']); ?></td>
            <td><?php echo htmlspecialchars($row['class']); ?></td>
            <td><?php echo htmlspecialchars($row['event']); ?></td>
            <td><?php echo htmlspecialchars($row['achievement_type']); ?></td>
            <td>
              <?php if (!empty($row['certificate'])) { ?>
                <a class="btn" href="<?php echo htmlspecialchars($row['certificate']); ?>" target="_blank">View</a>
              <?php } else { echo "N/A"; } ?>
            </td>
            <td><?php echo $row['created_at']; ?></td>
          </tr>
      <?php } } else { ?>
          <tr><td colspan="9">No achievements found for this PRN.</td></tr>
      <?php } ?>
    </table>
    <div class="back">
      <a class="btn" href="student_view.php">🔍 Search Another PRN</a>
      <a class="btn" href="index.html">⬅ Back to Dashboard</a>
    </div>
    <?php 
      $stmt->close();
      $conn->close();
    } ?>
</body>
</html>

