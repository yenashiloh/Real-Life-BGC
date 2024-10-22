document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const csrfToken = form.dataset.csrf;
    const submitUrl = form.dataset.submitUrl;

    function showAlert(type, messages) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.setAttribute('role', 'alert');
        alertDiv.style.margin = '0 auto';
        alertDiv.style.marginBottom = '10px';

        let content = '';
        if (Array.isArray(messages)) {
            content = '<ul>';
            messages.forEach(message => {
                content += `<li>${message}</li>`;
            });
            content += '</ul>';
        } else {
            content = messages;
        }

        alertDiv.innerHTML = `
            ${content}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        form.parentNode.insertBefore(alertDiv, form);
    }

    function clearFormErrors() {
        form.classList.remove('was-validated');
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        event.stopPropagation();

        // Remove any existing alerts
        document.querySelectorAll('.alert').forEach(alert => alert.remove());

        if (form.checkValidity()) {
            const formData = new FormData(form);

            fetch(submitUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json().then(data => ({
                status: response.status,
                body: data
            })))
            .then(({ status, body }) => {
                if (status === 422) {
                    // Validation errors
                    const errorMessages = Object.values(body.errors).flat();
                    showAlert('danger', errorMessages);
                } else if (body.success) {
                    showAlert('success', body.message);
                    clearFormErrors();
                    form.reset();
                } else {
                    showAlert('danger', body.message || 'An unexpected error occurred.');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                showAlert('danger', 'An error occurred while submitting the form. Please try again.');
            });
        } else {
            form.classList.add('was-validated');
        }
    });
});