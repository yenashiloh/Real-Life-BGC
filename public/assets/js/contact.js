document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('submitBtn').addEventListener('click', function() {
        document.getElementById('submitText').style.display = 'none';
        document.getElementById('loadingSpinner').style.display = 'inline-block';
    });
});
$(document).ready(function() {
    var successMessageContainer = $('#successMessageContainer');
    if (successMessageContainer.length > 0) {
        setTimeout(function() {
            successMessageContainer.fadeOut('slow');
        }, 5000);
    }
});

