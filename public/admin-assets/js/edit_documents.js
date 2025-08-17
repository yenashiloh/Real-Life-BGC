$(document).ready(function() {
    var initialFormData;
    var requirementId;

    $('#submitEditForm').prop('disabled', true);

    $(document).on('click', '.edit-button', function() {
        requirementId = $(this).data('requirement-id');
        $('#editRequirementId').val(requirementId);

        $.ajax({
            url: '/documents/' + requirementId,
            type: 'GET',
            success: function(data) {
                console.log('Retrieved data:', data);

                if (data.document_type) {
                    $('#editDocumentType').val(data.document_type);
                }

                $('#editNotes').val(data.notes);

                updateFileEditLabel(data.uploaded_document);

                initialFormData = $('#editForm').serialize();

                $('#editModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                alert('Failed to fetch document details. Please try again.');
            }
        });
    });

    function updateFileEditLabel(uploadedDocument) {
        if (uploadedDocument) {
            var fileName = getFileName(uploadedDocument);
            var downloadLink = `<a href="${uploadedDocument}" target="_blank" style="color: #151515;">${fileName}</a>`;
            $('#fileEditLabel').html(downloadLink);
        } else {
            $('#fileEditLabel').text('No document uploaded');
        }
    }

    function getFileName(url) {
        return url.split('/').pop(); 
    }

    $('#editFiles').change(function() {
        if ($(this).prop('files').length > 0) {
            var fileName = $(this).prop('files')[0].name;
            $('#fileEditLabel').text(fileName);
        } else {
            $('#fileEditLabel').text('Drag and drop files here or click to upload attachment');
        }
        checkFormChanges();
    });

    $('#editDocumentType').change(function() {
        checkFormChanges(); 
    });

    $('#editNotes').on('input', function() {
        checkFormChanges(); 
    });

    function checkFormChanges() {
        var currentFormData = $('#editForm').serialize();
        var documentTypeSelected = $('#editDocumentType').val();
        var filesChanged = $('#editFiles').prop('files').length > 0;
        
        if ((currentFormData !== initialFormData || filesChanged) && documentTypeSelected) {
            $('#submitEditForm').prop('disabled', false);
        } else {
            $('#submitEditForm').prop('disabled', true);
        }
    }

    $('#editForm').submit(function(event) {
        event.preventDefault();
    
        $('#submitEditForm').text('Updating...').prop('disabled', true);
    
        var formData = new FormData(this);
    
        $.ajax({
            url: '/documents/' + requirementId,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("AJAX request successful:", response);
    
                sessionStorage.setItem('showEditSuccessMessage', 'true');
    
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error updating data:', error);
                alert('Failed to update document. Please try again.');
                
                $('#submitEditForm').text('Update').prop('disabled', false);
            }
        });
    });

    if (sessionStorage.getItem('showEditSuccessMessage') === 'true') {
        sessionStorage.removeItem('showEditSuccessMessage');

        var toast = new bootstrap.Toast(document.getElementById('editSuccessToast'));
        toast.show();

        setTimeout(function() {
            toast.hide();
        }, 10000);
    }
});
