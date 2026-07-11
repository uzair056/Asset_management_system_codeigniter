<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
  <title>Employee Asset Management · Login</title>
  <!-- Google Font Inter for clean typography -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600&display=swap" rel="stylesheet">
  <style>
    
  </style>
</head>
<body>
  <!-- Decorative animated blobs -->
  <div class="bg-decoration">
    <div class="blob blob1"></div>
    <div class="blob blob2"></div>
    <div class="blob blob3"></div>
  </div>

  <!-- Single Login Card -->
  <div class="login-container" id="loginCard">
    <div class="brand">
      <div class="brand-icon">📦</div>
      <div class="brand-text">Solution<span>Tech</span></div>
    </div>
    <p class="welcome-text">Welcome back! Please login to your account.</p>

   <form id="loginForm" action="<?= base_url('login') ?>" method="POST" autocomplete="off">

    <?= csrf_field() ?>

    <div class="input-group">
        <label class="input-label">Email</label>
        <input
            type="email"
            name="email"
            class="input-field"
            placeholder="employee@company.com"
            required>
    </div>

    <div class="input-group">
        <label class="input-label">Password</label>
        <input
            type="password"
            name="password"
            class="input-field"
            placeholder="••••••••"
            required>
    </div>

    <div class="forgot-row">
        <button type="button" class="forgot-link" id="forgotLink">
            Forgot password?
        </button>
    </div>

    <button type="submit" class="btn-primary" id="submitBtn">
        <span>🔐</span> Sign In
    </button>

</form>

    <div class="register-prompt">
      Don't have an account? 
      <button class="register-link" id="registerLink">Create one</button>
    </div>
  </div>

<script src="<?= base_url('js/login.js') ?>"></script>
  
</body>
</html>