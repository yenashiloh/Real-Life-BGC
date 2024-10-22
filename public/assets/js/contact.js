document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.contact-form');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const successMessageContainer = document.getElementById('successMessageContainer');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Check if all required fields are filled
        const requiredFields = form.querySelectorAll('[required]');
        let allFieldsFilled = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                allFieldsFilled = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (allFieldsFilled) {
            submitText.style.display = 'none';
            loadingSpinner.style.display = 'inline-block';
            
            // Use AJAX to submit the form
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                // Display success message
                successMessageContainer.textContent = data.message;
                successMessageContainer.style.display = 'block';
                
                // Reset form
                form.reset();
                
                // Reset button state
                submitText.style.display = 'inline-block';
                loadingSpinner.style.display = 'none';
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMessageContainer.style.display = 'none';
                }, 5000);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                
                // Reset button state
                submitText.style.display = 'inline-block';
                loadingSpinner.style.display = 'none';
            });
        } else {
            alert('Please fill out all required fields before submitting.');
        }
    });

    // Optional: Add input event listeners to remove 'is-invalid' class when user starts typing
    requiredFields.forEach(field => {
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
});