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
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: #F1F5F9; 
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      margin: 0;
      position: relative;
      overflow-x: hidden;
    }

    /* animated background blobs */
    .bg-decoration {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      overflow: hidden;
      pointer-events: none;
    }

    .blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.15;
      animation: floatBlob 20s infinite ease-in-out;
    }

    .blob1 {
      width: 400px;
      height: 400px;
      background: #4338CA; /* Dark Indigo */
      top: -10%;
      left: -5%;
      animation-delay: 0s;
    }

    .blob2 {
      width: 350px;
      height: 350px;
      background: #6366F1; /* Violet */
      bottom: -5%;
      right: -5%;
      animation-delay: -7s;
      animation-duration: 18s;
    }

    .blob3 {
      width: 300px;
      height: 300px;
      background: #F59E0B; /* Amber accent */
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      animation-delay: -12s;
      animation-duration: 22s;
      opacity: 0.08;
    }

    @keyframes floatBlob {
      0% {
        transform: translate(0, 0) scale(1);
      }
      25% {
        transform: translate(30px, -40px) scale(1.08);
      }
      50% {
        transform: translate(-20px, 25px) scale(0.95);
      }
      75% {
        transform: translate(-35px, -30px) scale(1.05);
      }
      100% {
        transform: translate(0, 0) scale(1);
      }
    }

    /* main card */
    .register-container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 480px;
      background: #FFFFFF;
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      background: rgba(255, 255, 255, 0.9);
      border-radius: 2.5rem;
      box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.08), 0 10px 20px -8px rgba(67, 56, 202, 0.1);
      padding: 2.4rem 2rem;
      transition: all 0.2s ease;
      animation: cardRise 0.7s cubic-bezier(0.23, 1, 0.32, 1) forwards;
      opacity: 0;
      transform: translateY(30px);
    }

    @keyframes cardRise {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* brand header */
    .brand {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 2rem;
    }

    .brand-icon {
      background: #4338CA;
      width: 38px;
      height: 38px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 600;
      font-size: 1.3rem;
      box-shadow: 0 8px 14px -6px rgba(67, 56, 202, 0.4);
    }

    .brand-text {
      font-weight: 600;
      font-size: 1.4rem;
      letter-spacing: -0.4px;
      color: #1E293B;
    }

    .brand-text span {
      color: #4338CA;
    }

    .form-title {
      font-size: 1.1rem;
      font-weight: 500;
      color: #1E293B;
      margin-bottom: 1.8rem;
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    .input-group {
      margin-bottom: 1.5rem;
      text-align: left;
    }

    .input-label {
      display: block;
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      color: #1E293B;
      margin-bottom: 0.4rem;
    }

    .input-field {
      width: 100%;
      padding: 0.9rem 1.2rem;
      background: #FFFFFF;
      border: 1px solid #e2e8f0;
      border-radius: 1.2rem;
      font-size: 0.95rem;
      color: #1E293B;
      outline: none;
      transition: all 0.2s ease;
      font-family: 'Inter', sans-serif;
    }

    .input-field:focus {
      border-color: #6366F1;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
      background: #FFFFFF;
    }

    .input-field::placeholder {
      color: #94a3b8;
      font-weight: 400;
    }

    .btn-primary {
      width: 100%;
      background: #4338CA;
      border: none;
      padding: 0.95rem;
      border-radius: 2.5rem;
      font-weight: 600;
      font-size: 1rem;
      color: white;
      cursor: pointer;
      transition: background 0.25s, transform 0.15s, box-shadow 0.2s;
      margin-top: 0.6rem;
      letter-spacing: 0.2px;
      box-shadow: 0 8px 18px -8px rgba(67, 56, 202, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.4rem;
    }

    .btn-primary:hover {
      background: #6366F1;
      box-shadow: 0 10px 22px -8px rgba(99, 102, 241, 0.6);
      transform: translateY(-1px);
    }

    .btn-primary:active {
      transform: translateY(1px);
      box-shadow: 0 4px 10px -4px rgba(67, 56, 202, 0.5);
    }

    .login-prompt {
      margin-top: 2rem;
      text-align: center;
      font-size: 0.9rem;
      color: #475569;
    }

    .login-link {
      background: none;
      border: none;
      color: #4338CA;
      font-weight: 600;
      cursor: pointer;
      text-decoration: underline;
      text-underline-offset: 3px;
      margin-left: 0.2rem;
      transition: color 0.2s;
    }

    .login-link:hover {
      color: #6366F1;
    }

    @media (max-width: 480px) {
      .register-container {
        padding: 2rem 1.5rem;
        border-radius: 2rem;
      }
    }
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

    <form id="employeeForm" autocomplete="off">
      <div class="input-group">
        <label class="input-label">Full Name</label>
        <input type="text" class="input-field" placeholder="John Doe" required>
      </div>
      <!-- <div class="input-group">
        <label class="input-label">Email</label>
        <input type="email" class="input-field" placeholder="hello@example.com" required>
      </div> -->
      <div class="input-group">
        <label class="input-label">Email</label>
        <input type="email" class="input-field" placeholder="employee@company.com" required>
      </div>
      <div class="input-group">
        <label class="input-label">Password</label>
        <input type="password" class="input-field" placeholder="••••••••" required minlength="6">
      </div>
      <button type="submit" class="btn-primary" id="submitBtn">
        <span>✨</span> Create Account
      </button>
    </form>

    <div class="login-prompt">
      Already have an account? 
      <button class="login-link" id="loginLink">Log
         in</button>
    </div>
  </div>

  <script>
    (function() {
      'use strict';

      const employeeForm = document.getElementById('employeeForm');
      const submitBtn = document.getElementById('submitBtn');
      const loginLink = document.getElementById('loginLink');
      const card = document.getElementById('registerCard');

      // ---------- ENTRANCE ANIMATIONS FOR INPUTS ----------
      const allInputs = document.querySelectorAll('.input-field');
      allInputs.forEach((input, index) => {
        input.style.opacity = '0';
        input.style.transform = 'translateY(8px)';
        input.style.transition = 'opacity 0.4s ease, transform 0.35s ease';
        setTimeout(() => {
          input.style.opacity = '1';
          input.style.transform = 'translateY(0)';
        }, 100 + index * 60);
      });

      // Ensure card animation triggers even if CSS missed
      window.addEventListener('load', () => {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
      });

      // ---------- FORM SUBMIT WITH JS ANIMATION ----------
      employeeForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!employeeForm.checkValidity()) {
          employeeForm.reportValidity();
          return;
        }

        // collect data (demo)
        const formData = new FormData(employeeForm);
        const employeeData = {};
        formData.forEach((value, key) => {
          employeeData[key] = value;
        });

        // Disable button and show processing animation
        const originalContent = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span>⏳</span> Processing...`;

        // Simulate async request (replace with CodeIgniter fetch/AJAX)
        setTimeout(() => {
          // Success feedback with color change
          submitBtn.innerHTML = `<span>✅</span> Account Created!`;
          submitBtn.style.background = '#10B981'; // temporary success green
          
          // Show alert (in production, redirect or display message)
          alert('🎉 Employee registration successful!\n(Connect to CodeIgniter backend)');
          
          // Reset button after a moment
          setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
            submitBtn.style.background = ''; // revert to CSS
            employeeForm.reset();
            // re-trigger input animations if desired
            allInputs.forEach((inp, i) => {
              inp.style.opacity = '0';
              inp.style.transform = 'translateY(6px)';
              setTimeout(() => {
                inp.style.opacity = '1';
                inp.style.transform = 'translateY(0)';
              }, 20 + i * 30);
            });
          }, 1400);
        }, 900);
      });

      // ---------- "ALREADY HAVE ACCOUNT?" LINK ----------
      loginLink.addEventListener('click', function(e) {
        e.preventDefault();
        // subtle card animation
        card.style.transform = 'scale(0.98)';
        setTimeout(() => {
          card.style.transform = 'scale(1)';
        }, 150);
        
        // Redirect to login (CodeIgniter route example)
        alert('🔐 Redirecting to login page...');
        // window.location.href = "<?php echo base_url('auth/login'); ?>";
      });

      console.log('✨ Employee Asset Management Register ready.');
    })();
  </script>
</body>
</html>