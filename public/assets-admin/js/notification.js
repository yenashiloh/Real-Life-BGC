// $(document).ready(function() {
//     // Function to fetch notification count from the server
//     function fetchNotificationCount() {
//         $.ajax({
//             url: '/fetch-notification-count', // Endpoint to fetch notification count
//             type: 'GET',
//             success: function(response) {
//                 $('#notificationCount').text(response.count); // Update notification count
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error fetching notification count:', error);
//             }
//         });
//     }

//     // Fetch notification count initially when the page loads
//     fetchNotificationCount();

//     // Fetch notification count every 10 seconds (adjust interval as needed)
//     setInterval(fetchNotificationCount, 10000); // 10 seconds interval

//     // Handle click event on notification dropdown to reset count
//     $('#messageDropdown').on('click', function() {
//         // Reset the notification count to zero on the client side
//         $('#notificationCount').text('0');
//         // Send request to server to mark notifications as read if needed
//         $.ajax({
//             url: '/mark-notifications-as-read', // Endpoint to mark notifications as read
//             type: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
//             },
//             success: function(response) {
//                 // Optionally, you can perform additional actions after marking notifications as read
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error marking notifications as read:', error);
//             }
//         });
//     });
// });

$(document).ready(function() {
    // Function to fetch and update notification count and list
    function fetchNotificationCountAndList() {
        $.ajax({
            url: '/fetch-notifications', // Endpoint to fetch notifications list
            type: 'GET',
            success: function(response) {
                var notifications = response.notifications;
                var notificationMap = {};

                // Group notifications by applicant name and keep count for each applicant
                notifications.forEach(function(notification) {
                    var applicantName = notification.applicant_name;
                    if (!notificationMap[applicantName]) {
                        notificationMap[applicantName] = { count: 0, notification: notification };
                    }
                    notificationMap[applicantName].count++;
                });

                var notificationList = '';

                // Construct the notification list HTML
                Object.keys(notificationMap).forEach(function(applicantName) {
                    var { count, notification } = notificationMap[applicantName];
                    var newNotificationClass = notification.status === 'unread' ? 'new-notification' : '';
                    var createdAt = new Date(notification.created_at);
                    var createdAtFormatted = createdAt > new Date(new Date().setDate(new Date().getDate() - 1)) ? createdAt.toLocaleTimeString() : createdAt.toLocaleString();

                    notificationList += `
                        <a href="/applicants/${notification.applicant_id}" class="dropdown-item preview-item ${newNotificationClass}" data-notification-id="${notification.id}">
                            <div class="preview-thumbnail">
                                <img src="../assets-new-admin/images/faces/face23.png" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis font-weight-medium text-dark">${applicantName} (${count})</p>
                                <p class="font-weight-light small-text">${notification.message}</p>
                                <p class="font-weight-light" style="font-size:12px; font-style: italic;">
                                    ${createdAtFormatted}
                                </p>
                            </div>
                        </a>
                        <hr style="margin: 0;">
                    `;
                });

                // Update the dropdown menu with the constructed notification list HTML
                $('.dropdown-menu-right.preview-list').html(notificationList);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notifications:', error);
            }
        });
    }

    // Fetch notification count and list initially when the page loads
    fetchNotificationCountAndList();

    // Fetch notification count and list every 1 second (adjust interval as needed)
    setInterval(fetchNotificationCountAndList, 1000); // 1 second interval

    // Handle click event on notification dropdown to reset count and mark notifications as read
    $('#messageDropdown').on('click', function() {
        // Reset the notification count on the client side
        $('#notificationCount').hide();

        // Send request to server to mark notifications as read
        $.ajax({
            url: '/mark-notifications-as-read', // Endpoint to mark notifications as read
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function(response) {
                // Fetch notifications again to update the list
                fetchNotificationCountAndList();
            },
            error: function(xhr, status, error) {
                console.error('Error marking notifications as read:', error);
                // Re-fetch notification count and list in case of error
                fetchNotificationCountAndList();
            }
        });
    });
});
