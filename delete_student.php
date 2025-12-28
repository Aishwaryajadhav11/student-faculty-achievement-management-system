<?php
require 'db.php';
$id = $_GET['id'];

$conn->query("DELETE FROM students_achievements WHERE id=$id");

header("Location: admin_view.php");
exit;
?>
