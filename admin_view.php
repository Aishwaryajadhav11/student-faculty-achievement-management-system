<?php
require 'db.php';

// Fetch student and faculty achievements
$students = $conn->query("SELECT * FROM students_achievements ORDER BY created_at DESC");
$faculty = $conn->query("SELECT * FROM faculty_achievements ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin - Manage Achievements</title>
  <style>
    body {
      background-color: #0a3e7f;
      color: white;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1, h2 {
      text-align: center;
    }

    .section-box {
      background-color: #0c4a89;
      border-radius: 12px;
      padding: 30px 25px;
      margin: 40px auto;
      max-width: 95%;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      color: white;
    }

    th, td {
      padding: 12px 14px;
      border-bottom: 1px solid #19568c;
      text-align: left;
      font-size: 0.95rem;
    }

    th {
      background-color: #1462a6;
    }

    a {
      color: #ffffff;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    .actions a {
      margin: 0 4px;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 40px;
      font-size: 1.1rem;
    }

    @media (max-width: 768px) {
      th, td {
        font-size: 0.85rem;
        padding: 10px;
      }

      .section-box {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <h1>Admin Panel - Manage Achievements</h1>

  <p style="text-align:center; margin-top:10px;">
    <a href="export_excel.php"
       style="background:#1462a6; padding:8px 16px; border-radius:6px;
              color:#fff; text-decoration:none;">
      ⬇ Download All Data (Excel)
    </a>
  </p>

  <!-- ✅ Student Section -->
  <div class="section-box">
    <h2>Student Achievements</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>PRN</th>
        <th>Department</th>
        <th>Class</th>
        <th>Event</th>
        <th>Achievement</th>
        <th>Certificate</th>
        <th>Submitted At</th>
        <th>Actions</th>
      </tr>
      <?php while($row = $students->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['prn']) ?></td>
        <td><?= htmlspecialchars($row['department']) ?></td>
        <td><?= htmlspecialchars($row['class']) ?></td>
        <td><?= htmlspecialchars($row['event']) ?></td>
        <td><?= htmlspecialchars($row['achievement_type']) ?></td>
        <td>
          <?php if ($row['certificate']): ?>
            <a href="<?= htmlspecialchars($row['certificate']) ?>" target="_blank">View</a>
          <?php else: ?>
            None
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['created_at']) ?></td>
        <td class="actions">
          <a href="edit_student.php?id=<?= $row['id'] ?>">✏ Edit</a> | 
          <a href="delete_student.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">🗑 Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>

  <!-- ✅ Faculty Section -->
  <div class="section-box">
    <h2>Faculty Achievements</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>EMP ID</th>
        <th>Department</th>
        <th>Event</th>
        <th>Details</th>
        <th>Certificate</th>
        <th>Submitted At</th>
        <th>Actions</th>
      </tr>
      <?php while($row = $faculty->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['empid']) ?></td>
        <td><?= htmlspecialchars($row['department']) ?></td>
        <td><?= htmlspecialchars($row['event']) ?></td>
        <td><?= htmlspecialchars($row['details']) ?></td>
        <td>
          <?php if ($row['certificate']): ?>
            <a href="<?= htmlspecialchars($row['certificate']) ?>" target="_blank">View</a>
          <?php else: ?>
            None
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['created_at']) ?></td>
        <td class="actions">
          <a href="edit_faculty.php?id=<?= $row['id'] ?>">✏ Edit</a> | 
          <a href="delete_faculty.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">🗑 Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>

  <p class="back-link">
    <a href="index.html">⬅ Back to Home</a>
  </p>

</body>
</html>
