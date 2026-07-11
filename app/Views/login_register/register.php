<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
  <title>Employee Asset Management · Register</title>
  <!-- Google Font Inter for clean typography -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/register.css') ?>">
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

  <!-- Single Employee Registration Card -->
  <div class="register-container" id="registerCard">
    <div class="brand">
      <div class="brand-icon">📦</div>
      <div class="brand-text">Solutions<span>Tech</span></div>
    </div>

    <div class="form-title">
      <span>👤</span> Employee Registration
    </div>

   <form id="employeeForm" action="<?= site_url('store') ?>" method="POST" autocomplete="off">
    <?= csrf_field() ?>

    <div class="input-group">
        <label class="input-label">Full Name</label>
        <input type="text" name="name" class="input-field" placeholder="John Doe" required>
    </div>

    <div class="input-group">
        <label class="input-label">Email</label>
        <input type="email" name="email" class="input-field" placeholder="employee@company.com" required>
    </div>

    <div class="input-group">
        <label class="input-label">Password</label>
        <input type="password" name="password" class="input-field" placeholder="••••••••" required minlength="6">
    </div>

   <button type="submit" class="btn-primary" id="submitBtn">
    <span>✨</span> Create Account
</button>

</form>

    <div class="login-prompt">
      Already have an account? 
      <a href="<?= base_url('login') ?>" class="login-link">
    Log in
</a>
    </div>
  </div>

 <script src="<?= base_url('js/register.js') ?>"></script>
</body>
</html>