//Submit a documents
$(document).ready(function() {
    console.log("Document is ready.");
    
    var successMessage = sessionStorage.getItem('successMessage');
    if (successMessage) {
        var successToast = new bootstrap.Toast($('#successToast'));
        successToast.show();

        sessionStorage.removeItem('successMessage'); 
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

    $('#documentType').change(function() {
        toggleSubmitButton();
    });

    $('#fileUpload').change(function() {
        var fileName = $(this).val().split('\\').pop();
        var fileExtension = fileName.split('.').pop().toLowerCase();
        $('#fileUploadLabel').text(fileName);
        toggleSubmitButton();
    });

    $('#submitForm').click(function(e) {
        e.preventDefault(); 
    
        $('#submitForm').text('Submitting...').prop('disabled', true); 
    
        console.log("Submit button clicked.");
    
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
        var formData = new FormData();
        formData.append('documentType', $('#documentType').val());
        formData.append('notes', $('#notes').val());
        formData.append('_token', csrfToken);

        var fileUpload = $('#fileUpload')[0].files[0];
        formData.append('fileUpload', fileUpload);
    
        console.log("Form data:", formData);
    
        $.ajax({
            url: $('#uploadForm').attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("AJAX request successful:", response); 
                sessionStorage.setItem('successMessage', 'Submitted Successfully!');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", xhr.responseText); 
                $('#submitForm').text('Submit').prop('disabled', false);
            }
        });
    });

            
    $(document).ready(function() {
        $('#fileUpload').change(function() {
            var fileName = $(this).val().split('\\').pop(); 
        $('#fileUploadLabel').text(fileName); 
        });
    });
});
/****************************DASHBOARD MODAL**********************************/
document.addEventListener('DOMContentLoaded', function() {
    reportcardData.forEach(requirement => {
        const documentType = requirement.document_type;
        const status = requirement.status;

        const checkbox = document.querySelector(`input[value='${documentType}']`);
        if (checkbox && status === 'Approved') {
            checkbox.checked = true;
        }
    });
});

$('.clickable-icon').click(function() {
    $('#addModal').modal('show');
});

$('.clickable-icon').click(function() {
    $('#basicEditModal').modal('show');
});

$("#closeEditModal").click(function() {
    $("#editModal").modal("hide");
});

$("#closeAddModal").click(function() {
    $("#addModal").modal("hide");
});

/************************DATA TABLES**************************************/
$(document).ready(function() {
    new DataTable('#example');
});

