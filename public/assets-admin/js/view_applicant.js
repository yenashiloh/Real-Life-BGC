$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

document.addEventListener('DOMContentLoaded', function () {
  let lastTab = sessionStorage.getItem('lastTab');
  if (lastTab) {
    let tabLink = document.querySelector(`[data-bs-target="${lastTab}"]`);
    if (tabLink) {
      let tab = new bootstrap.Tab(tabLink);
      tab.show();
    }
  }

  let tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
  tabLinks.forEach(function (tabLink) {
    tabLink.addEventListener('shown.bs.tab', function (event) {
      let activeTab = event.target.getAttribute('data-bs-target');
      sessionStorage.setItem('lastTab', activeTab);
    });
  });

  $(document).ready(function() {
    // Open decline reason modal
    $(document).on('click', '.open-decline-modal', function() {
      var requirementId = $(this).data('requirement-id');
      $('#requirementId').val(requirementId); // Set the requirement ID in the hidden input field
      $('#declineReasonModal').modal('show'); // Open the decline reason modal
    });

    // SweetAlert confirmation when clicking "Decline" inside the modal
    $('#submitDeclineReason').click(function() {
      var requirementId = $('#requirementId').val();
      var declineReason = $('#declineReason').val();
      var updateRoute = $(this).attr('data-route');

      updateRoute = updateRoute.replace(':requirementId', requirementId);

      Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to change the status. Are you sure?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Perform AJAX request
          $.ajax({
            type: 'POST',
            url: updateRoute,
            data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
              requirement_id: requirementId,
              status: 'Declined',
              decline_reason: declineReason // Send the decline reason to the backend
            },
            success: function(response) {
              console.log('Status updated successfully:', response);
              $('#declineReasonModal').modal('hide'); // Close the decline reason modal
              localStorage.setItem('successMessage', 'Status Change Successfully!');
              window.location.reload();
            },
            error: function(xhr, status, error) {
              console.error('Error updating status:', error);
            }
          });
        }
      });
    });

    // Change status
    $(document).on('click', '.change-status', function() {
      var requirementId = $(this).data('requirement-id');
      var action = $(this).data('action');
      var updateRoute = $(this).attr('data-route');

      updateRoute = updateRoute.replace(':requirementId', requirementId);
      var newStatus = action;

      Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to change the status. Are you sure?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: updateRoute,
            data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
              requirement_id: requirementId,
              status: action
            },
            success: function(response) {
              console.log('Status updated successfully:', response);
              localStorage.setItem('successMessage', 'Status Change Successfully!');
              window.location.reload();
            },
            error: function(xhr, status, error) {
              console.error('Error updating status:', error);
            }
          });
        }
      });
    });

    var successMessage = localStorage.getItem('successMessage');
    if (successMessage) {
      $('#successMessage').text(successMessage).fadeIn().delay(4000).fadeOut();
      localStorage.removeItem('successMessage'); 
    }
  });
});