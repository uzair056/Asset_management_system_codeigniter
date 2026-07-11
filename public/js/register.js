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
      // employeeForm.addEventListener('submit', function(e) {
      //   e.preventDefault();

      //   if (!employeeForm.checkValidity()) {
      //     employeeForm.reportValidity();
      //     return;
      //   }

        // collect data (demo)
        // const formData = new FormData(employeeForm);
        // const employeeData = {};
        // formData.forEach((value, key) => {
        //   employeeData[key] = value;
        // });

        // // Disable button and show processing animation
        // const originalContent = submitBtn.innerHTML;
        // submitBtn.disabled = true;
        // submitBtn.innerHTML = `<span>⏳</span> Processing...`;

        // Simulate async request (replace with CodeIgniter fetch/AJAX)
      //   setTimeout(() => {
      //     // Success feedback with color change
      //     submitBtn.innerHTML = `<span>✅</span> Account Created!`;
      //     submitBtn.style.background = '#10B981'; // temporary success green
          
      //     // Show alert (in production, redirect or display message)
      //     alert('🎉 Employee registration successful!\n(Connect to CodeIgniter backend)');
          
      //     // Reset button after a moment
      //     setTimeout(() => {
      //       submitBtn.disabled = false;
      //       submitBtn.innerHTML = originalContent;
      //       submitBtn.style.background = ''; // revert to CSS
      //       employeeForm.reset();
      //       // re-trigger input animations if desired
      //       allInputs.forEach((inp, i) => {
      //         inp.style.opacity = '0';
      //         inp.style.transform = 'translateY(6px)';
      //         setTimeout(() => {
      //           inp.style.opacity = '1';
      //           inp.style.transform = 'translateY(0)';
      //         }, 20 + i * 30);
      //       });
      //     }, 1400);
      //   }, 900);
      // });

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