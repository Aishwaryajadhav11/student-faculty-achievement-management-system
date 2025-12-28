<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'faculty') {
    header("Location: faculty_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Achievement Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #0f4a82;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-container {
      background-color: #124d84;
      padding: 30px 40px;
      border-radius: 8px;
      width: 450px;
      box-sizing: border-box;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      text-align: center;
      color: white;
    }
    .logo {
      width: 100px;
      margin-bottom: 20px;
    }
    h2 {
      margin-bottom: 25px;
    }
    label {
      display: block;
      text-align: left;
      font-weight: bold;
      margin-bottom: 5px;
      font-size: 14px;
    }
    input[type="text"],
    select,
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 8px 10px;
      margin-bottom: 18px;
      border-radius: 3px;
      border: none;
      font-size: 14px;
      color: #000;
      background-color: #fff;
      box-sizing: border-box;
      transition: all 0.3s ease;
    }
    
    input[type="text"]:focus,
    select:focus,
    textarea:focus {
      outline: none;
      box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
    }
    
    textarea {
      height: 80px;
      resize: vertical;
    }
    button {
      width: 100%;
      background-color: #3B82F6;
      border: none;
      padding: 12px;
      color: white;
      font-weight: bold;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #1E40AF;
    }
    
    /* Interactive features */
    .file-preview {
      display: none;
      margin-top: 10px;
      padding: 10px;
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 5px;
      color: white;
      text-align: left;
    }
    
    .file-preview img {
      max-width: 100%;
      max-height: 150px;
      margin-top: 10px;
      border-radius: 5px;
    }
    
    .character-count {
      text-align: right;
      font-size: 12px;
      margin-top: -15px;
      margin-bottom: 15px;
      color: #ccc;
    }
    
    .loading {
      display: none;
      text-align: center;
      margin-top: 10px;
      color: white;
    }
    
    .logout-container {
      position: absolute;
      top: 20px;
      right: 20px;
    }

    .logout-btn {
      background: #d9534f;
      color: white;
      padding: 6px 12px;
      border-radius: 5px;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
      background: #c9302c;
    }
  </style>
</head>
<body>

  <div class="logout-container">
    <a href="logout.php" class="logout-btn">🚪 Logout</a>
  </div>

  <div class="form-container">
    <img src="./images/logo svkm.jpg" alt="SVKM Logo" class="logo" />
    <h2>Faculty Achievement Form</h2>

    <form id="facultyForm" action="faculty_submit.php" method="POST" enctype="multipart/form-data">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Enter full name" required>

      <label for="empid">EMP ID:</label>
      <input type="text" id="empid" name="empid" placeholder="Enter employee ID" required>

      <label for="department">Department:</label>
      <input type="text" id="department" name="department" placeholder="Enter department" required>

      <label for="event">Name of the Event:</label>
      <select id="event" name="event" required>
        <option value="">Select Event Type</option>
        <option value="International Conference Paper">International Conference Paper</option>
        <option value="International Journal Paper">International Journal Paper</option>
        <option value="FDP">FDP</option>
        <option value="Workshop">Workshop</option>
        <option value="Resource Person">Resource Person</option>
        <option value="Invited Judge">Invited Judge</option>
        <option value="Keynote Speaker">Keynote Speaker</option>
      </select>

      <label for="details">Give Detail:</label>
      <textarea id="details" name="details" placeholder="Enter details here..." required></textarea>
      <div class="character-count" id="detailsCount">0/500</div>

      <label for="certificate">Upload File:</label>
      <input type="file" id="certificate" name="certificate" accept=".pdf,.jpg,.jpeg,.png" required>
      
      <div id="filePreview" class="file-preview">
        <span id="fileName"></span>
        <img id="previewImage" src="" alt="File Preview" />
      </div>

      <button type="submit" id="submitBtn">
        <i class="fas fa-paper-plane"></i> Submit
      </button>
      
      <div class="loading" id="loadingIndicator">
        <i class="fas fa-spinner fa-spin"></i> Submitting your achievement...
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('facultyForm');
      const submitBtn = document.getElementById('submitBtn');
      const loadingIndicator = document.getElementById('loadingIndicator');
      const fileInput = document.getElementById('certificate');
      const filePreview = document.getElementById('filePreview');
      const fileName = document.getElementById('fileName');
      const previewImage = document.getElementById('previewImage');
      const detailsTextarea = document.getElementById('details');
      const detailsCount = document.getElementById('detailsCount');
      
      // Character count for details textarea
      detailsTextarea.addEventListener('input', function() {
        const count = this.value.length;
        detailsCount.textContent = `${count}/500`;
      });
      
      // Preview uploaded file
      fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
          const file = this.files[0];
          fileName.textContent = file.name;
          
          // Show preview for image files
          if (file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = function(e) {
              previewImage.src = e.target.result;
              previewImage.style.display = 'block';
            }
            reader.readAsDataURL(file);
          } else {
            previewImage.style.display = 'none';
          }
          
          filePreview.style.display = 'block';
        } else {
          filePreview.style.display = 'none';
        }
      });
      
      // Form submission - only add loading indicator, don't prevent submission
      form.addEventListener('submit', function() {
        // Show loading indicator
        submitBtn.style.display = 'none';
        loadingIndicator.style.display = 'block';
        
        // The form will continue to submit to faculty_submit.php normally
        // The loading indicator will show until the page redirects
      });
    });
  </script>
</body>
</html>