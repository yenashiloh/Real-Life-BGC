$(document).ready(function() {
    console.log("Document is ready.");
    
    // Check if success message is stored in session storage
    var successMessage = sessionStorage.getItem('successMessage');
    if (successMessage) {
        // Trigger the toast
        var successToast = new bootstrap.Toast($('#successToast'));
        successToast.show();

        sessionStorage.removeItem('successMessage'); // Clear success message from session storage
    }

    function toggleSubmitButton() {
        var documentType = $('#documentType').val();
        var fileName = $('#fileUpload').val();
        var fileExtension = fileName.split('.').pop().toLowerCase();
        if (documentType !== '' && fileName !== '' && fileExtension === 'pdf') {
            $('#submitForm').prop('disabled', false);
        } else {
            $('#submitForm').prop('disabled', true);
        }
    }

    // Event listener for document type change
    $('#documentType').change(function() {
        toggleSubmitButton();
    });

    // Event listener for file upload change
    $('#fileUpload').change(function() {
        var fileName = $(this).val().split('\\').pop();
        var fileExtension = fileName.split('.').pop().toLowerCase();
        $('#fileUploadLabel').text(fileName);
        toggleSubmitButton();
    });

    // Event listener for Submit button click
    $('#submitForm').click(function(e) {
        e.preventDefault(); // Prevent default button behavior

        console.log("Submit button clicked.");

        // Get CSRF token value
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Create FormData object
        var formData = new FormData();
        formData.append('documentType', $('#documentType').val());
        formData.append('notes', $('#notes').val());
        formData.append('_token', csrfToken);

        // Append file input
        var fileUpload = $('#fileUpload')[0].files[0];
        formData.append('fileUpload', fileUpload);

        // Debugging statement
        console.log("Form data:", formData);

        // Send AJAX request
        $.ajax({
            url: $('#uploadForm').attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("AJAX request successful:", response); // Handle success response

                // Store success message in session storage
                sessionStorage.setItem('successMessage', 'Submitted Successfully!');
                
                // Reload the page to show the success toast
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", xhr.responseText); // Handle error response
            }
        });
    });
});
            
        $(document).ready(function() {
            $('#fileUpload').change(function() {
                var fileName = $(this).val().split('\\').pop(); // Get the filename
            $('#fileUploadLabel').text(fileName); // Update the header with the filename
                });
            });

/****************************DASHBOARD MODAL**********************************/
document.addEventListener('DOMContentLoaded', function() {
    reportcardData.forEach(requirement => {
        const documentType = requirement.document_type;
        const status = requirement.status;

        // Find the corresponding checkbox and check it if the status is 'Approved'
        const checkbox = document.querySelector(`input[value='${documentType}']`);
        if (checkbox && status === 'Approved') {
            checkbox.checked = true;
        }
    });
});

// Click event for showing add modal
$('.clickable-icon').click(function() {
    $('#addModal').modal('show');
});

// Click event for showing basic edit modal
$('.clickable-icon').click(function() {
    $('#basicEditModal').modal('show');
});

// Click event for closing edit modal
$("#closeEditModal").click(function() {
    $("#editModal").modal("hide");
});

// Click event for closing add modal
$("#closeAddModal").click(function() {
    $("#addModal").modal("hide");
});

/************************DATA TABLES**************************************/
$(document).ready(function() {
    new DataTable('#example');
});

