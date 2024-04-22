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

    });

    $('.change-status').on('click', function() {
  var requirementId = $(this).data('requirement-id');
  var action = $(this).data('action');
  var updateRoute = $(this).data('route');
  var newStatus = action;
  
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
});

$(document).ready(function() {
  var successMessage = localStorage.getItem('successMessage');
  if (successMessage) {
      $('#successMessage').text(successMessage).fadeIn().delay(4000).fadeOut();
      localStorage.removeItem('successMessage'); 
  }
});

//********************************************************************************* */
