$(document).ready(function() {
    $('#changePasswordForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#message').html('');

                if (response.success) {
                    $('#message').append(
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        response.success +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>'
                    );

                    // Clear password fields after successful change
                    $('#currentPassword').val('');
                    $('#newPassword').val('');
                    $('#renewPassword').val('');
                }

                if (response.errors) {
                    let messages = [];
                    $.each(response.errors, function(field, errorMessages) {
                        $.each(errorMessages, function(index, message) {
                            messages.push(
                            message); // Store messages in an array
                        });
                    });

                    if (messages.length === 1) {
                        // If there's only one error, display it without bullets
                        $('#message').append(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            messages[0] +
                            // Directly display the single error message
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>'
                        );
                    } else if (messages.length > 1) {
                        // If there are multiple errors, display them as a bullet list
                        let errorList = '<ul>';
                        $.each(messages, function(index, message) {
                            errorList += '<li>' + message +
                            '</li>'; // Create a bullet point for each error message
                        });
                        errorList += '</ul>'; // Close the list

                        $('#message').append(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            errorList +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>'
                        );
                    }
                }
            },
            error: function(xhr) {
                $('#message').html('');
                let response = xhr.responseJSON;

                if (response && response.errors) {
                    let messages = [];
                    $.each(response.errors, function(field, errorMessages) {
                        $.each(errorMessages, function(index, message) {
                            messages.push(
                            message); // Store messages in an array
                        });
                    });

                    if (messages.length === 1) {
                        // If there's only one error, display it without bullets
                        $('#message').append(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            messages[0] +
                            // Directly display the single error message
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>'
                        );
                    } else if (messages.length > 1) {
                        // If there are multiple errors, display them as a bullet list
                        let errorList = '<ul>';
                        $.each(messages, function(index, message) {
                            errorList += '<li>' + message +
                            '</li>'; // Create a bullet point for each error message
                        });
                        errorList += '</ul>'; // Close the list

                        $('#message').append(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            errorList +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>'
                        );
                    }
                } else {
                    $('#message').append(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'An unexpected error occurred. Please try again later.' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>'
                    );
                }
            }
        });
    });
});