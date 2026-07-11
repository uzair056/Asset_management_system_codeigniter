(function () {
    'use strict';

    const loginForm = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const forgotLink = document.getElementById('forgotLink');
    const registerLink = document.getElementById('registerLink');
    const card = document.getElementById('loginCard');

    // Input animation
    const allInputs = document.querySelectorAll('.input-field');

    allInputs.forEach((input, index) => {
        input.style.opacity = '0';
        input.style.transform = 'translateY(8px)';
        input.style.transition = 'opacity .4s ease, transform .35s ease';

        setTimeout(() => {
            input.style.opacity = '1';
            input.style.transform = 'translateY(0)';
        }, 100 + (index * 80));
    });

    // Card animation
    window.addEventListener('load', () => {
        if (card) {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }
    });

    // Login Form
    if (loginForm) {

        loginForm.addEventListener('submit', function () {

            if (!loginForm.checkValidity()) {
                loginForm.reportValidity();
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>⏳</span> Authenticating...';

            // e.preventDefault() NAHI lagana
            // Form automatically AuthController::login me chali jayegi.
        });

    }

    // Forgot Password
    if (forgotLink) {

        forgotLink.addEventListener('click', function (e) {

            e.preventDefault();

            alert("Forgot Password");

        });

    }

    // Register
    if (registerLink) {

        registerLink.addEventListener('click', function (e) {

            e.preventDefault();

            window.location.href = "/register";

        });

    }

})();