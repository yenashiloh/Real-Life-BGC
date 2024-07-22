document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('emailInput');
    const passwordInput = document.getElementById('passwordInput');
    const errorMessage = document.getElementById('errorMessage');
    const rememberMeCheckbox = document.getElementById('logCheck');
    
    // Check if "Remember Me" is checked and populate email input from localStorage
    if (rememberMeCheckbox && rememberMeCheckbox.checked) {
        const storedEmail = localStorage.getItem('rememberedEmail');
        if (storedEmail) {
            emailInput.value = storedEmail;
        }
    }
    
    // Add event listener to clear error message when typing in email or password fields
    if (emailInput && passwordInput && errorMessage) {
        emailInput.addEventListener('input', clearErrorMessage);
        passwordInput.addEventListener('input', clearErrorMessage);
    }
    
    function clearErrorMessage() {
        // Hide the error message when user starts typing in the input fields
        errorMessage.style.display = 'none';
    }
    
    // Save or remove email in localStorage based on "Remember Me" checkbox
    if (rememberMeCheckbox) {
        rememberMeCheckbox.addEventListener('change', function() {
            if (this.checked) {
                localStorage.setItem('rememberedEmail', emailInput.value);
            } else {
                localStorage.removeItem('rememberedEmail');
            }
        });
    }
    });