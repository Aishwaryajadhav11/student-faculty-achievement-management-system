<?php
session_start();
session_unset();
session_destroy();

// Redirect back to home page (index.html)
header("Location: index.html");
exit;
?>
