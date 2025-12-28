<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
    header("Location: student_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Achievement Form</title>
  <style>
    :root {
      --primary-blue: #0f4a82;
      --secondary-blue: #3B82F6;
      --dark-blue: #1E40AF;
      --error-red: #e74c3c;
      --success-green: #2ecc71;
    }
    
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: var(--primary-blue);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-container {
      background-color: var(--primary-blue);
      padding: 30px 40px;
      border-radius: 8px;
      width: 400px;
      box-sizing: border-box;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      text-align: center;
      position: relative;
    }

    .logo {
      width: 100px;
      margin-bottom: 20px;
    }

    h2 {
      color: white;
      margin-bottom: 25px;
    }

    label {
      display: block;
      text-align: left;
      color: white;
      font-weight: bold;
      margin-bottom: 5px;
      font-size: 14px;
    }

    input, select {
      width: 100%;
      padding: 8px 10px;
      margin-bottom: 5px;
      border-radius: 3px;
      border: 2px solid #ddd;
      font-size: 14px;
      color: #000;
      background-color: #fff;
      box-sizing: border-box;
      transition: all 0.3s ease;
    }

    input:focus, select:focus {
      outline: none;
      border-color: var(--secondary-blue);
      box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
    }

    input[type="file"] {
      background-color: #eee;
    }

    button {
      width: 100%;
      background-color: var(--secondary-blue);
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
      background-color: var(--dark-blue);
    }

    .error-message {
      color: var(--error-red);
      font-size: 12px;
      text-align: left;
      margin-bottom: 10px;
      min-height: 15px;
      display: none;
    }

    .form-group {
      position: relative;
    }

    .form-group i {
      position: absolute;
      right: 10px;
      top: 35px;
      color: #999;
      transition: color 0.3s ease;
    }

    /* Success state - green border and check icon */
    .form-group.success input,
    .form-group.success select {
      border-color: var(--success-green);
    }

    .form-group.success i {
      color: var(--success-green);
    }

    /* Error state - red border and warning icon */
    .form-group.error input,
    .form-group.error select {
      border-color: var(--error-red);
    }

    .form-group.error i {
      color: var(--error-red);
    }

    .loading {
      display: none;
      text-align: center;
      margin-top: 10px;
    }

    .loading-spinner {
      border: 3px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      border-top: 3px solid white;
      width: 20px;
      height: 20px;
      animation: spin 1s linear infinite;
      margin: 0 auto;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
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

    .file-preview {
      display: none;
      margin-top: 10px;
      padding: 10px;
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 5px;
      color: white;
    }

    .file-preview img {
      max-width: 100%;
      max-height: 150px;
      margin-top: 10px;
      border-radius: 5px;
    }

    .achievement-details {
      display: none;
      margin-top: 10px;
      padding: 10px;
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 5px;
      color: white;
    }

    .achievement-details label {
      color: white;
      font-weight: normal;
    }

    .achievement-details input {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="logout-container">
    <a href="logout.php" class="logout-btn">🚪 Logout</a>
  </div>

  <div class="form-container">
    <img src="./images/logo svkm.jpg" alt="SVKM Logo" class="logo" />
    <h2>Student Achievement Form</h2>

    <form id="achievementForm" action="student_submit.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name of the Student:</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" required />
        <i class="fas fa-user"></i>
        <div class="error-message" id="nameError">Please enter a valid name</div>
      </div>

      <div class="form-group">
        <label for="prn">PRN:</label>
        <input type="text" id="prn" name="prn" placeholder="Enter your PRN" required />
        <i class="fas fa-id-card"></i>
        <div class="error-message" id="prnError">Please enter a valid PRN</div>
      </div>

      <div class="form-group">
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" placeholder="Enter your Department (e.g., IT)" required />
        <i class="fas fa-building"></i>
        <div class="error-message" id="departmentError">Please enter a valid department</div>
      </div>

      <div class="form-group">
        <label for="class">Class:</label>
        <select id="class" name="class" required>
          <option value="">Select Class</option>
          <option value="SY">SY</option>
          <option value="TY">TY</option>
          <option value="B.Tech">B.Tech</option>
        </select>
        <i class="fas fa-graduation-cap"></i>
        <div class="error-message" id="classError">Please select a class</div>
      </div>

      <div class="form-group">
        <label for="event">Name of the Event:</label>
        <input type="text" id="event" name="event" placeholder="Enter event name" required />
        <i class="fas fa-calendar-alt"></i>
        <div class="error-message" id="eventError">Please enter a valid event name</div>
      </div>

      <div class="form-group">
        <label for="achievement">Type of Achievement:</label>
        <select id="achievement" name="achievement" required>
          <option value="">Select Achievement Type</option>
          <option value="Participation">Participation</option>
          <option value="Winner 1st position">Winner 1st position</option>
          <option value="Winner 2nd position">Winner 2nd position</option>
          <option value="Winner 3rd position">Winner 3rd position</option>
          <option value="1st Runner up">1st Runner up</option>
          <option value="2nd Runner up">2nd Runner up</option>
          <option value="Intern">Intern</option>
          <option value="Other">Other</option>
        </select>
        <i class="fas fa-trophy"></i>
        <div class="error-message" id="achievementError">Please select an achievement type</div>
      </div>

      <div id="otherAchievement" class="achievement-details">
        <label for="otherAchievementText">Specify Achievement:</label>
        <input type="text" id="otherAchievementText" name="otherAchievementText" placeholder="Enter your achievement" />
      </div>

      <div class="form-group">
        <label for="certificate">Upload Certificate:</label>
        <input type="file" id="certificate" name="certificate" accept=".pdf,.jpg,.jpeg,.png" required />
        <i class="fas fa-file-upload"></i>
        <div class="error-message" id="certificateError">Please upload a valid certificate (PDF, JPG, JPEG, PNG)</div>
      </div>

      <div id="filePreview" class="file-preview">
        <span id="fileName"></span>
        <img id="previewImage" src="" alt="Certificate Preview" />
      </div>

      <button type="submit" id="submitBtn">Submit</button>
      
      <div class="loading" id="loadingIndicator">
        <div class="loading-spinner"></div>
        <p style="color: white; margin-top: 10px;">Submitting your achievement...</p>
      </div>
    </form>
  </div>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('achievementForm');
      const submitBtn = document.getElementById('submitBtn');
      const loadingIndicator = document.getElementById('loadingIndicator');
      const fileInput = document.getElementById('certificate');
      const filePreview = document.getElementById('filePreview');
      const fileName = document.getElementById('fileName');
      const previewImage = document.getElementById('previewImage');
      const achievementSelect = document.getElementById('achievement');
      const otherAchievement = document.getElementById('otherAchievement');
      
      // Show additional field when "Other" is selected
      achievementSelect.addEventListener('change', function() {
        if (this.value === 'Other') {
          otherAchievement.style.display = 'block';
        } else {
          otherAchievement.style.display = 'none';
        }
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
      
      // Form submission - only show loading, don't prevent submission
      form.addEventListener('submit', function() {
        // Show loading indicator
        submitBtn.style.display = 'none';
        loadingIndicator.style.display = 'block';
        
        // The form will continue to submit to student_submit.php normally
        // The loading indicator will show until the page redirects
      });
      
      // Real-time validation for better UX
      const inputs = form.querySelectorAll('input, select');
      inputs.forEach(input => {
        let hasInteracted = false;
        
        input.addEventListener('blur', function() {
          hasInteracted = true;
          validateField(this);
        });
        
        input.addEventListener('input', function() {
          // Only validate if user has already interacted with this field
          if (hasInteracted) {
            validateField(this);
          }
          
          // Clear error state when user starts typing
          const formGroup = this.closest('.form-group');
          formGroup.classList.remove('error');
          const errorElement = document.getElementById(this.id + 'Error');
          if (errorElement) {
            errorElement.style.display = 'none';
          }
        });
      });
      
      function validateField(field) {
        const value = field.value.trim();
        
        // Reset field state
        const formGroup = field.closest('.form-group');
        formGroup.classList.remove('error', 'success');
        const errorElement = document.getElementById(field.id + 'Error');
        if (errorElement) {
          errorElement.style.display = 'none';
        }
        
        // Validate based on field type
        switch(field.id) {
          case 'name':
            if (value.length < 2) {
              showError(field, 'Please enter a valid name (minimum 2 characters)');
            } else {
              formGroup.classList.add('success');
            }
            break;
            
          case 'prn':
            if (value.length < 3) {
              showError(field, 'Please enter a valid PRN (minimum 3 characters)');
            } else {
              formGroup.classList.add('success');
            }
            break;
            
          case 'department':
            if (value.length < 2) {
              showError(field, 'Please enter a valid department (minimum 2 characters)');
            } else {
              formGroup.classList.add('success');
            }
            break;
            
          case 'class':
            if (value === '') {
              showError(field, 'Please select a class');
            } else {
              formGroup.classList.add('success');
            }
            break;
            
          case 'event':
            if (value.length < 2) {
              showError(field, 'Please enter a valid event name (minimum 2 characters)');
            } else {
              formGroup.classList.add('success');
            }
            break;
            
          case 'achievement':
            if (value === '') {
              showError(field, 'Please select an achievement type');
            } else if (value === 'Other' && document.getElementById('otherAchievementText').value.trim() === '') {
              showError(field, 'Please specify your achievement');
            } else {
              formGroup.classList.add('success');
            }
            break;
            
          case 'certificate':
            if (field.files && field.files.length > 0) {
              const file = field.files[0];
              const validTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
              if (!validTypes.includes(file.type)) {
                showError(field, 'Please upload a valid file type (PDF, JPG, JPEG, PNG)');
              } else if (file.size > 5 * 1024 * 1024) {
                showError(field, 'File size must be less than 5MB');
              } else {
                formGroup.classList.add('success');
              }
            }
            break;
        }
      }
      
      function showError(field, message) {
        const formGroup = field.closest('.form-group');
        formGroup.classList.add('error');
        const errorElement = document.getElementById(field.id + 'Error');
        if (errorElement) {
          errorElement.textContent = message;
          errorElement.style.display = 'block';
        }
      }
    });
  </script>
</body>
</html>