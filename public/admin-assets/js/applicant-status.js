let isOnline = navigator.onLine;
let Swal;

function showMessage(options) {
    return new Promise((resolve) => {
        if (typeof Swal !== 'undefined' && isOnline) {
            Swal.fire(options).then(resolve);
        } else {
            const message = `${options.title}\n\n${options.text}`;
            alert(message);
            resolve({ isConfirmed: confirm("Proceed?") });
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    if (typeof window.Swal === 'undefined') {
        console.warn('SweetAlert2 is not loaded. Using fallback alert method.');
    } else {
        Swal = window.Swal;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('dropdown-item')) {
            handleDropdownItemClick(e);
        }
    });

    initializeDataTables();
    setupOnlineOfflineListeners();
    checkOnlineStatus(); // Immediately check online status
});

function setupOnlineOfflineListeners() {
    window.addEventListener('online', handleOnline);
    window.addEventListener('offline', handleOffline);
}

function checkOnlineStatus() {
    isOnline = navigator.onLine;
    updateUIForConnectivity();
}

function handleOnline() {
    isOnline = true;
    updateUIForConnectivity();
    showConnectivityMessage('You are back online!', 'success');
}

function handleOffline() {
    isOnline = false;
    updateUIForConnectivity();
    showConnectivityMessage('You are offline. Status changes are not possible while offline.', 'warning');
}

function updateUIForConnectivity() {
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        if (isOnline) {
            item.classList.remove('disabled');
        } else {
            item.classList.add('disabled');
        }
    });
}

function showConnectivityMessage(message, type) {
    showMessage({
        title: type === 'success' ? 'Connected' : 'Disconnected',
        text: message,
        icon: type
    });
}

function capitalizeFullName(fullName) {
    return fullName.split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
        .join(' ');
}

async function handleDropdownItemClick(e) {
    e.preventDefault();

    if (!isOnline) {
        showMessage({
            title: 'No Internet Connection',
            text: 'You are currently offline. Status changes are not possible without an internet connection.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    const action = e.target.dataset.action;
    if (!action) return;

    try {
        const row = e.target.closest('tr');
        if (!row) throw new Error("Could not find the corresponding table row.");

        const applicantFullNameElement = row.querySelector('td:nth-child(3)');
        if (!applicantFullNameElement) throw new Error("Could not find the applicant's name in the table.");

        const applicantFullName = applicantFullNameElement.textContent;
        const capitalizedFullName = capitalizeFullName(applicantFullName);

        const result = await showMessage({
            title: 'Are you sure?',
            html: `You want to change ${capitalizedFullName}'s status to "${action}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        });

        if (result.isConfirmed) {
            await updateApplicantStatus(e.target);
        }
    } catch (error) {
        console.error("Error in handleDropdownItemClick:", error);
        showErrorMessage("An error occurred while processing your request. Please try again.");
    }
}

async function updateApplicantStatus(target) {
    if (!isOnline) {
        showOfflineErrorMessage();
        return;
    }

    const applicant_id = target.dataset.applicantId;
    const updateRoute = target.dataset.route;
    const action = target.dataset.action;

    if (!applicant_id || !updateRoute || !action) {
        showErrorMessage('Invalid data. Please try again.');
        return;
    }

    document.querySelector('.loading').style.display = 'block';

    try {
        const response = await $.ajax({
            type: 'POST',
            url: updateRoute,
            data: {
                _token: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                applicant_id: applicant_id,
                status: action
            }
        });

        handleStatusUpdateSuccess(response, applicant_id, action);
    } catch (error) {
        console.error('Error:', error);
        document.querySelector('.loading').style.display = 'none';
        showErrorMessage('Failed to update status. Please try again later.');
    }
}

function handleStatusUpdateSuccess(response, applicantId, newStatus) {
    document.querySelector('.loading').style.display = 'none';
    if (response.success) {
        updateUI(applicantId, newStatus);
        showSuccessMessage(applicantId, newStatus);
    } else {
        showErrorMessage('Failed to update status: ' + (response.error || 'Unknown error'));
    }
}

function showOfflineErrorMessage() {
    showMessage({
        title: 'Error',
        text: 'You are offline. Status changes are not possible while offline to prevent sending incorrect notifications.',
        icon: 'error',
        confirmButtonText: 'OK'
    });
}

function showErrorMessage(message) {
    showMessage({
        title: 'Error',
        text: message,
        icon: 'error',
        confirmButtonText: 'OK'
    });
}

function updateUI(applicantId, newStatus) {
    const badgeElement = document.getElementById('status-' + applicantId);
    badgeElement.textContent = newStatus;
    updateBadgeClass(badgeElement, newStatus);
    updateDropdownContent(applicantId, newStatus);
}

function updateBadgeClass(badgeElement, newStatus) {
    badgeElement.classList.remove('badge-primary', 'badge-secondary', 'badge-warning', 'badge-dark', 'badge-success');
    const statusClasses = {
        'Sent': 'badge-primary',
        'Under Review': 'badge-secondary',
        'Shortlisted': 'badge-warning',
        'For Interview': 'badge-primary',
        'For House Visitation': 'badge-success'
    };
    badgeElement.classList.add(statusClasses[newStatus] || 'badge-secondary');
}

function updateDropdownContent(applicantId, newStatus) {
    const dropdownButton = document.getElementById('dropdownMenuButton' + applicantId);
    const dropdownMenu = dropdownButton.nextElementSibling;
    
    if (newStatus === 'Declined' || newStatus === 'Approved') {
        dropdownButton.closest('tr').remove();
    } else {
        dropdownMenu.innerHTML = getDropdownContent(applicantId, newStatus);
    }
}

function getDropdownContent(applicantId, newStatus) {
    const dropdownContents = {
        'Sent': `
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="Under Review" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}">Under Review</a></li>
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}"><i class="fas fa-times" aria-hidden="true"></i> Decline</a></li>
        `,
        'Under Review': `
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="Shortlisted" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}"><i class="fa fa-check" aria-hidden="true"></i> Approve for Shortlisted</a></li>
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}"><i class="fas fa-times" aria-hidden="true"></i> Decline</a></li>
        `,
        'Shortlisted': `
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="For Interview" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}"><i class="fa fa-check" aria-hidden="true"></i> Approve for Interview</a></li>
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}"><i class="fas fa-times" aria-hidden="true"></i> Decline</a></li>
        `,
        'For Interview': `
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="For House Visitation" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}"><i class="fa fa-check" aria-hidden="true"></i> Approve for House Visitation</a></li>
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}"><i class="fas fa-times" aria-hidden="true"></i> Decline</a></li>
        `,
        'For House Visitation': `
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="Approved" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}"><i class="fa fa-check" aria-hidden="true"></i> Approve Scholarship</a></li>
            <li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="${applicantId}" data-route="${routes.updateStatus}"><i class="fas fa-times" aria-hidden="true"></i> Decline</a></li>
        `
    };
    return dropdownContents[newStatus] || '';
}

function showSuccessMessage(applicantId, newStatus) {
    try {
        let row = document.querySelector(`#status-${applicantId}`);
        
        if (!row) {
            row = document.querySelector(`[data-applicant-id="${applicantId}"]`);
        }

        if (row) {
            row = row.closest('tr');
        }

        if (!row) {
            throw new Error(`Could not find row for applicant ID ${applicantId}`);
        }
        
        const applicantFullName = row.querySelector('td:nth-child(3)').textContent.trim();
        
        Swal.fire({
            title: 'Success',
            text: `${applicantFullName} is now ${newStatus}`,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    } catch (error) {
        console.error('Error in showSuccessMessage:', error);
        Swal.fire({
            title: 'Success',
            text: `Applicant status updated to ${newStatus}`,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
}

function initializeDataTables() {
    const datatables = document.querySelectorAll('.datatable');
    datatables.forEach(datatable => {
        new simpleDatatables.DataTable(datatable);
    });

    if ($.fn.DataTable) {
        $("#basic-datatables").DataTable({});
    }
}

function toggleDropdown() {
    const dropdown = document.getElementById("dropdownMenu");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

window.onclick = function(event) {
    if (!event.target.matches('.btn') && !event.target.matches('.btn i')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let dropdown of dropdowns) {
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            }
        }
    }
}

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});