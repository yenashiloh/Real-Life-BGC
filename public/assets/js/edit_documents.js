    $(document).ready(function() {
        var initialFormData; // Variable to store initial form data

        // Disable Save Changes button initially
        $('#submitEditForm').prop('disabled', true);
    
        // When Edit button is clicked
        $(document).on('click', '.edit-button', function() {
            requirementId = $(this).data('requirement-id'); // Update the outer requirementId variable
            $('#editRequirementId').val(requirementId);
    
            // Fetch existing data for the requirement ID via AJAX
            $.ajax({
                url: '/documents/' + requirementId, // Backend endpoint to fetch data for editing
                type: 'GET',
                success: function(data) {
                    // Log the retrieved data for debugging
                    console.log('Retrieved data:', data);
    
                    // Set the initial form data for comparison
                    initialFormData = $('#editForm').serialize();
    
                    // Set the selected option in the dropdown based on the retrieved document_type
                    if (data.document_type) {
                        $('#editDocumentType').val(data.document_type);
                    }
    
                    $('#editNotes').val(data.notes); // Set notes
    
                    // Display the uploaded document link
                    updateFileEditLabel(data.uploaded_document);
    
                    // Display the modal
                    $('#editModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    // Optionally handle error and provide feedback to the user
                    alert('Failed to fetch document details. Please try again.');
                }
            });
        });

        // Function to update the fileEditLabel with the uploaded document name or message
        function updateFileEditLabel(uploadedDocument) {
            if (uploadedDocument) {
                // Extract filename from the URL
                var fileName = getFileName(uploadedDocument);
                // Create a download link for the uploaded document
                var downloadLink = `<a href="${uploadedDocument}" target="_blank" style="color: #151515;">${fileName}</a>`;
                // Update the fileEditLabel to show the download link
                $('#fileEditLabel').html(downloadLink);
            } else {
                // If no uploaded document, display a message
                $('#fileEditLabel').text('No document uploaded');
            }
        }

        // Function to extract filename from the URL
        function getFileName(url) {
            return url.split('/').pop(); // Get the last part of the URL as the filename
        }

        // Listen for change events on the file input field
        $('#editFiles').change(function() {
            // Check if a file is selected
            if ($(this).prop('files').length > 0) {
                // Update the fileEditLabel with the new file name
                var fileName = $(this).prop('files')[0].name;
                $('#fileEditLabel').text(fileName);
            } else {
                // If no file is selected, display default message
                $('#fileEditLabel').text('Drag and drop files here or click to upload attachment');
            }
        });

        // Listen for change events on the document type dropdown
        $('#editDocumentType').change(function() {
            // Enable Save Changes button if document type is selected
            if ($(this).val()) {
                $('#submitEditForm').prop('disabled', false);
            } else {
                $('#submitEditForm').prop('disabled', true);
            }
        });

        $('#editForm').submit(function(event) {
            event.preventDefault();

            // Serialize form data
            var formData = new FormData(this);

            $.ajax({
                url: '/documents/' + requirementId, // Backend endpoint to update data
                type: 'POST', // Assuming you're updating data via POST request
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("AJAX request successful:", response); // Handle success response
        
                // Update success message in session storage
                    sessionStorage.setItem('successEditMessage', 'Update Successfully!');

                    // Reload the page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error updating data:', error);
                    alert('Failed to update document. Please try again.');
                }
            });
        });

        // Check if success message is stored in session storage
        var successEditMessage = sessionStorage.getItem('successEditMessage');
        if (successEditMessage) {
            $('#successEditMessage').text(successEditMessage); // Update success message text
            $('#successEditMessage').show();
            sessionStorage.removeItem('successEditMessage'); // Clear success message from session storage
            setTimeout(function() {
                $('#successEditMessage').fadeOut('slow'); // Hide success message after 4 seconds
            }, 4000);
        }
    });
