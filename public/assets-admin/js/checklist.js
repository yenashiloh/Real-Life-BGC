const documentTypes = [
    { type: "Signed Application Form", checkboxId: "flexCheckDefault1" },
    { type: "Birth Certificate", checkboxId: "flexCheckDefault2" },
    { type: "Character Evaluation Forms", checkboxId: "flexCheckDefault3" },
    { type: "Proof of Financial Status", checkboxId: "flexCheckDefault4" },
    { type: "Two Reference Forms", checkboxId: "flexCheckDefault6" },
    { type: "Home Visitation Form", checkboxId: "flexCheckDefault7" },
    { type: "Report Card / Grades", checkboxId: "flexCheckDefault8" },
    { type: "Prospectus", checkboxId: "flexCheckDefault9" },
    { type: "Official Grading System", checkboxId: "flexCheckDefault10" },
    { type: "Tuition Projection", checkboxId: "flexCheckDefault11" },
    { type: "Admission Slip", checkboxId: "flexCheckDefault12" }
];

async function updateChecklistStatus() {
    try {
        const url = window.location.href;
        const applicantIdMatch = url.match(/\/applicants\/(\d+)/);
        if (!applicantIdMatch) {
            throw new Error('Applicant ID not found in URL');
        }
        const applicantId = applicantIdMatch[1];

        const response = await fetch(`/applicants/${applicantId}/approved-documents`);
        if (!response.ok) {
            throw new Error(`Failed to fetch approved documents: ${response.statusText}`);
        }
        const approvedDocuments = await response.json();

        const checkedDocumentTypes = [];

        documentTypes.forEach(doc => {
            const checkbox = document.getElementById(doc.checkboxId);
            if (checkbox) {
                const isApproved = approvedDocuments.some(docType => docType === doc.type);
                checkbox.checked = isApproved;
                if (isApproved) {
                    checkedDocumentTypes.push(doc.type);
                }
            }
        });

        const notifyBtn = document.getElementById('notifyBtn');
        if (checkedDocumentTypes.length === documentTypes.length) {
            // Disable the notify button if all document types are checked
            notifyBtn.disabled = true;
        } else {
            // Enable the notify button if there are unchecked document types
            notifyBtn.disabled = false;
        }

    } catch (error) {
        console.error(`Error fetching approved documents: ${error.message}`);
    }
}

document.addEventListener('change', function(event) {
    const target = event.target;
    if (target.type === 'checkbox') {
        const checkedDocumentTypes = documentTypes.filter(doc => {
            const checkbox = document.getElementById(doc.checkboxId);
            return checkbox.checked;
        }).map(doc => doc.type);

        const notifyBtn = document.getElementById('notifyBtn');
        if (checkedDocumentTypes.length === documentTypes.length) {
            // Disable the notify button if all document types are checked
            notifyBtn.disabled = true;
        } else {
            // Enable the notify button if there are unchecked document types
            notifyBtn.disabled = false;
        }
    }
});
// Call the function when the page is loaded or when data changes
window.addEventListener('load', updateChecklistStatus);

/************************************************************************ */
// Function to retrieve the CSRF token from the meta tag
function getCsrfToken() {
    const metaTag = document.querySelector('meta[name="csrf-token"]');
    return metaTag ? metaTag.getAttribute('content') : null;
}

// Event listener for the notify button click
document.getElementById('notifyBtn').addEventListener('click', async () => {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const checkedCheckboxes = Array.from(checkboxes).filter(cb => cb.checked);

    const uncheckedDocumentTypes = documentTypes.filter(doc => {
        return !checkedCheckboxes.some(cb => cb.value === doc.type);
    }).map(doc => doc.type);

    const applicantId = window.location.pathname.split('/').pop(); 
    const csrfToken = getCsrfToken(); // Retrieve the CSRF token dynamically

    if (!csrfToken) {
        console.error('CSRF token is missing');
        return;
    }

    try {
        const response = await fetch(`/applicants/${applicantId}/notify`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ document_types: uncheckedDocumentTypes })
        });

        const data = await response.json();

        if (response.ok) {
            // Display success message (assuming you have alert elements in your HTML)
            document.getElementById('successAlert').classList.remove('d-none');
            document.getElementById('errorAlert').classList.add('d-none');
        } else {
            throw new Error(data.message || 'Failed to send notification');
        }
    } catch (error) {
        console.error('Error sending notification:', error.message);
        // Display error message
        document.getElementById('errorAlert').classList.remove('d-none');
        document.getElementById('successAlert').classList.add('d-none');
    }
});

/************************************************************************ */
document.addEventListener('DOMContentLoaded', function() {
    const successAlert = document.getElementById('successAlert');
    const notifyBtn = document.getElementById('notifyBtn');

    notifyBtn.addEventListener('click', function() {
        // Show the loader immediately
        showLoader();
        
        setTimeout(function() {
            // Hide the loader after 3 seconds
            hideLoader();

            // Show the success message
            successAlert.classList.remove('d-none');

            // Hide the success message after another 3 seconds
            setTimeout(function() {
                successAlert.classList.add('d-none');
            }, 5000); // 3000 milliseconds = 3 seconds for success message visibility
        }, 5000); // 3000 milliseconds = 3 seconds for loader visibility
    });

    function showLoader() {
        notifyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        notifyBtn.disabled = true;
    }

    function hideLoader() {
        notifyBtn.innerHTML = 'Notify';
        notifyBtn.disabled = false;
    }
    
});
