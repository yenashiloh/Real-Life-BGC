$(document).ready(function () {
    // Get the current URL path
    var currentPath = window.location.pathname;

    // Add the "active" class to the corresponding link
    $('.nav-link').each(function () {
        var linkPath = $(this).attr('href');
        if (currentPath === linkPath) {
            $(this).addClass('active');
        }
    });
});

fetchNotificationCount();

// Fetch notification count every 10 seconds (adjust interval as needed)
setInterval(fetchNotificationCount, 10000); // 10 seconds interval

// Handle click event on notification dropdown to mark notifications as read
$('#messageDropdown').on('click', function() {
    $.ajax({
        url: '/applicant-mark-notifications-as-read', // Endpoint to mark notifications as read
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
        },
        success: function(response) {
            // Remove the entire badge element
            $('#notificationCount').remove();
            // Remove count from local storage
            localStorage.removeItem('notificationCount');
        },
        error: function(xhr, status, error) {
            console.error('Error marking notifications as read:', error);
        }
    });
});

function fetchNotificationCount() {
$.ajax({
    url: '/applicant-fetch-notification-count', // Endpoint to fetch notification count
    type: 'GET',
    success: function(response) {
        var count = response.count;
        if (count === 0) {
            // If count is zero, hide the badge
            $('#notificationCount').hide();
            // Remove count from local storage
            localStorage.removeItem('notificationCount');
        } else {
            // If count is greater than zero, update the badge with the count and show it
            $('#notificationCount').text(count).show();
            // Store count in local storage
            localStorage.setItem('notificationCount', count);
        }
    },
    error: function(xhr, status, error) {
        console.error('Error fetching notification count:', error);
    }
});
}