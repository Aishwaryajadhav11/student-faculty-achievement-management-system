<?php
require 'db.php';

// Detect base URL for hyperlinks
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$baseURL = $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=achievements_export.xls");
header("Pragma: no-cache");
header("Expires: 0");

// ================== STUDENT ACHIEVEMENTS ==================
echo "STUDENT ACHIEVEMENTS\n";
echo "ID\tName\tPRN\tClass\tEvent\tAchievement\tCertificate\tCreated At\n";

$students = $conn->query("SELECT * FROM students_achievements ORDER BY created_at DESC");
if ($students && $students->num_rows > 0) {
    while ($row = $students->fetch_assoc()) {
        $certLink = !empty($row['certificate']) 
            ? '=HYPERLINK("' . $baseURL . $row['certificate'] . '","View")' 
            : 'None';

        echo $row['id'] . "\t" .
             $row['name'] . "\t" .
             $row['prn'] . "\t" .
             $row['class'] . "\t" .
             $row['event'] . "\t" .
             $row['achievement_type'] . "\t" .
             $certLink . "\t" .
             // export as text to avoid #####
             "'" . date("Y-m-d H:i:s", strtotime($row['created_at'])) . "\n";
    }
}
echo "\n\n";

// ================== FACULTY ACHIEVEMENTS ==================
echo "FACULTY ACHIEVEMENTS\n";
echo "ID\tName\tEMP ID\tDepartment\tEvent\tDetails\tCertificate\tCreated At\n";

$faculty = $conn->query("SELECT * FROM faculty_achievements ORDER BY created_at DESC");
if ($faculty && $faculty->num_rows > 0) {
    while ($row = $faculty->fetch_assoc()) {
        $certLink = !empty($row['certificate']) 
            ? '=HYPERLINK("' . $baseURL . $row['certificate'] . '","View")' 
            : 'None';

        echo $row['id'] . "\t" .
             $row['name'] . "\t" .
             $row['empid'] . "\t" .
             $row['department'] . "\t" .
             $row['event'] . "\t" .
             $row['details'] . "\t" .
             $certLink . "\t" .
             "'" . date("Y-m-d H:i:s", strtotime($row['created_at'])) . "\n";
    }
}


$conn->close();
?>
