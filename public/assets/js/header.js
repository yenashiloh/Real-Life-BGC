$(document).ready(function() {
    // Activate the carousel with a specified interval (e.g., 5 seconds)
    $('.carousel').carousel({
        interval: 3000 // Adjust this value (in milliseconds) to control the sliding interval
    });
});

$(document).ready(function() {
    // Toggle dropdown on click
    $('#messageDropdown').click(function(e) {
        e.preventDefault();
        var dropdownMenu = $('#notificationDropdown');
        // Calculate the left position relative to the parent element
        var leftPosition = -dropdownMenu.outerWidth() + $(this).outerWidth();
        dropdownMenu.css({
            'left': leftPosition
        });
        dropdownMenu.toggle();

        // Close other dropdowns
        $('.dropdown-menu').not(dropdownMenu).hide();
    });

    // Hide dropdown when clicking outside of it
    $(document).click(function(e) {
        if (!$(e.target).closest('#messageDropdown').length && !$(e.target).closest(
                '#notificationDropdown').length) {
            $('#notificationDropdown').hide();
        }
    });

    // Prevent closing the dropdown when clicking inside it
    $('#notificationDropdown').click(function(e) {
        e.stopPropagation();
    });
});


$(document).ready(function() {
    // Hide the user dropdown menu initially
    $('#user-dropdown-menu').hide();

    // Toggle user dropdown menu when clicking on user profile link
    $('#user-dropdown-toggle').click(function(e) {
        e.preventDefault();
        // Toggle visibility of the user dropdown menu
        $('#user-dropdown-menu').toggle();
    });

    // Close dropdown when clicking outside of the user dropdown area
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.user-profile').length) {
            // If the click is not within the user-profile area, hide the dropdown
            $('#user-dropdown-menu').hide();
        }
    });

    // Prevent hiding dropdown when clicking inside the dropdown menu
    $('#user-dropdown-menu').on('click', function(e) {
        e.stopPropagation(); // Prevent the click event from propagating to document
    });

    // Close dropdown when specific dropdown items are clicked
    $('#user-dropdown-menu').on('click', 'a', function() {
        $('#user-dropdown-menu').hide(); // Hide the dropdown menu
    });
});

/***************************************************/
function redirectToApplicantDashboard(notificationId) {
    window.location.href = "/applicant_dashboard";
}

/*************ANNOUNCEMENT*************************************/

function toggleContent(id) {
    var shortContent = document.getElementById('short-content-' + id);
    var fullContent = document.getElementById('full-content-' + id);

    if (shortContent.style.display !== 'none') {
        shortContent.style.display = 'none';
        fullContent.style.display = 'block';
    } else {
        shortContent.style.display = 'block';
        fullContent.style.display = 'none';
    }
}

/*************ANNOUNCEMENT*************************************/
//NOTIFICATION AND MENU FOR MOBILE PHONE USER
document.getElementById('notification-bell').addEventListener('click', function(event) {
    event.stopPropagation();
});

document.getElementById('notification-link').addEventListener('click', function(event) {
    event.stopPropagation();
    event.preventDefault(); // Add this line to prevent the default link behavior
    redirectToApplicantDashboard(this.dataset.notificationId); // Pass the notification ID to the function
});

document.getElementById('menu-icon').addEventListener('click', function() {
    // Your menu icon click handler
});

document.addEventListener('click', function(event) {
    if (!event.target.closest('.icon-container')) {
        // Close the menu or any other related functionality
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var bellIcon = document.getElementById('notification-bell');
    var dropdown = document.querySelector('.notification-dropdown-mobile');

    bellIcon.addEventListener('click', function() {
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });
});


document.querySelector('.tn-left li').onclick = function() {
    this.style.opacity = 0; // Example code causing disappearance
};

$(document).ready(function() {
    $('.notification-item').click(function() {
        $(this).find('.notification-description').toggleClass('full');
    });

    $('.notification-item').mouseleave(function() {
        $(this).find('.notification-description').removeClass('full');
    });
});

window.onload = () => {
    document.body.classList.add('animate');

    // Remove the animation class after it finishes
    setTimeout(() => {
        document.body.classList.remove('animate');
    }, 500); // Match this duration to your CSS animation duration
};