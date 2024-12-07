document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('passwordResetForm');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    const submitButton = document.getElementById('submitButton');

    // Password validation function
    function validatePassword(password) {
        // Check length
        if (password.length < 6) {
            return 'Password must be at least 6 characters long';
        }

        // Check for special character
        if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            return 'Password must contain at least one special character';
        }

        // Check for number
        if (!/\d/.test(password)) {
            return 'Password must contain at least one number';
        }

        // Check for uppercase letter
        if (!/[A-Z]/.test(password)) {
            return 'Password must contain at least one uppercase letter';
        }

        return ''; // No errors
    }

    // Real-time validation for password
    passwordInput.addEventListener('input', function() {
        const passwordValidationError = validatePassword(this.value);
        
        if (passwordValidationError) {
            passwordError.textContent = passwordValidationError;
            submitButton.disabled = true;
        } else {
            passwordError.textContent = '';
            
            // Check password confirmation if it's not empty
            if (confirmPasswordInput.value) {
                if (this.value !== confirmPasswordInput.value) {
                    confirmPasswordError.textContent = 'Passwords do not match';
                    submitButton.disabled = true;
                } else {
                    confirmPasswordError.textContent = '';
                    submitButton.disabled = false;
                }
            }
        }
    });

    // Real-time validation for password confirmation
    confirmPasswordInput.addEventListener('input', function() {
        if (this.value !== passwordInput.value) {
            confirmPasswordError.textContent = 'Passwords do not match';
            submitButton.disabled = true;
        } else {
            confirmPasswordError.textContent = '';
            
            // Only enable submit if password also passes validation
            const passwordValidationError = validatePassword(passwordInput.value);
            submitButton.disabled = !!passwordValidationError;
        }
    });

    // Form submission validation
    form.addEventListener('submit', function(event) {
        const passwordValidationError = validatePassword(passwordInput.value);
        
        if (passwordValidationError) {
            event.preventDefault();
            passwordError.textContent = passwordValidationError;
            return;
        }

        if (passwordInput.value !== confirmPasswordInput.value) {
            event.preventDefault();
            confirmPasswordError.textContent = 'Passwords do not match';
            return;
        }
    });
});