<!DOCTYPE html>
<html>
<head>
  <title>Faculty Portal</title>
  <style>
    body { 
      font-family: Arial, sans-serif; 
      background: linear-gradient(135deg, #0b3c68 0%, #0a2a4a 100%);
      color: white; 
      text-align: center; 
      padding: 50px;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }
    
    .box { 
      background: #124d84; 
      padding: 30px; 
      border-radius: 15px; 
      display: inline-block;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
      max-width: 400px;
      width: 90%;
    }
    
    .box:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
    }
    
    .box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(to right, #4da8ff, #00ffcc);
      animation: shimmer 3s infinite;
    }
    
    h2 {
      margin-bottom: 25px;
      font-size: 28px;
      position: relative;
      padding-bottom: 15px;
      text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    
    h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: linear-gradient(to right, #4da8ff, #00ffcc);
      border-radius: 3px;
    }
    
    a { 
      display: block; 
      margin: 15px; 
      padding: 15px 20px; 
      background: black; 
      color: white; 
      border-radius: 8px; 
      text-decoration: none; 
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      font-weight: 600;
      letter-spacing: 0.5px;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    a:hover { 
      background: #333; 
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    a::after {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transition: left 0.5s;
    }
    
    a:hover::after {
      left: 100%;
    }
    
    .login-btn::before {
      content: '🔐';
      margin-right: 10px;
    }
    
    .register-btn::before {
      content: '👤';
      margin-right: 10px;
    }
    
    .pulse {
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    @keyframes shimmer {
      0% { background-position: -200px 0; }
      100% { background-position: calc(200px + 100%) 0; }
    }
    
    .floating {
      animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }
    
    .floating-elements {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }
    
    .floating-element {
      position: absolute;
      background: rgba(77, 168, 255, 0.1);
      border-radius: 50%;
      animation: float 15s infinite linear;
    }
    
    .floating-element:nth-child(1) {
      width: 80px;
      height: 80px;
      top: 10%;
      left: 10%;
      animation-delay: 0s;
    }
    
    .floating-element:nth-child(2) {
      width: 120px;
      height: 120px;
      top: 60%;
      left: 80%;
      animation-delay: -5s;
    }
    
    .floating-element:nth-child(3) {
      width: 60px;
      height: 60px;
      top: 80%;
      left: 20%;
      animation-delay: -10s;
    }
    
    @keyframes float {
      0% { transform: translate(0, 0) rotate(0deg); }
      25% { transform: translate(10px, 15px) rotate(5deg); }
      50% { transform: translate(0, 30px) rotate(0deg); }
      75% { transform: translate(-10px, 15px) rotate(-5deg); }
      100% { transform: translate(0, 0) rotate(0deg); }
    }
  </style>
</head>
<body>
  <div class="floating-elements">
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
  </div>
  
  <div class="box floating">
    <h2 class="pulse">Faculty Portal</h2>
    <a href="faculty_login.php" class="login-btn">Login</a>
    <a href="faculty_register.php" class="register-btn">New User</a>
  </div>
</body>
</html>