function getCurrentTime() {
    return new Date(new Date().toLocaleString("en-US", { timeZone: "Asia/Manila" }));
}

// Function to parse date and time strings and return a Date object
function parseDateTime(dateString, timeString) {
    var dateTimeString = dateString + 'T' + timeString;
    return new Date(dateTimeString);
}

// Function to check if the current time is within the daily time range
function isWithinDailyTimeRange(now, startTime, stopTime) {
    var nowTimeString = now.toTimeString().split(' ')[0];
    return nowTimeString >= startTime && nowTimeString <= stopTime;
}

function updateCurrentStatus() {
    var now = getCurrentTime();
    var settingsElement = document.getElementById('application-settings');
    
    if (!settingsElement) {
        console.error('Settings element not found');
        return;
    }

    var settings = {
        start_date: settingsElement.dataset.startDate,
        start_time: settingsElement.dataset.startTime,
        stop_date: settingsElement.dataset.stopDate,
        stop_time: settingsElement.dataset.stopTime,
        max_number: parseInt(settingsElement.dataset.maxNumber, 10)
    };

    var currentApplicants = parseInt(settingsElement.dataset.currentApplicants, 10);

    if (settings.start_date && settings.start_time && settings.stop_date && settings.stop_time &&
        !isNaN(currentApplicants) && !isNaN(settings.max_number)) {
        
        var startDateTime = parseDateTime(settings.start_date, settings.start_time);
        var stopDateTime = parseDateTime(settings.stop_date, settings.stop_time);

        var withinDateRange = now >= startDateTime && now <= stopDateTime;

        var applicationOpen = withinDateRange && isWithinDailyTimeRange(now, settings.start_time, settings.stop_time);

        var maximumReached = currentApplicants >= settings.max_number;

        document.getElementById('current_status_display').value = (applicationOpen && !maximumReached) ? 'Opened' : 'Closed';
    } else {
        document.getElementById('current_status_display').value = 'Closed';
    }
}

// Initialize date inputs when the DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    var startDateInput = document.getElementById('start_date');
    var stopDateInput = document.getElementById('stop_date');
    var startTimeInput = document.getElementById('start_time');
    var stopTimeInput = document.getElementById('stop_time');

    var today = getCurrentTime().toISOString().split('T')[0];
    startDateInput.setAttribute('min', today);

    startDateInput.addEventListener('change', function() {
        stopDateInput.setAttribute('min', startDateInput.value);
    });

    startTimeInput.addEventListener('change', function() {
        stopTimeInput.setAttribute('min', startTimeInput.value);
    });

    if (startDateInput.value) {
        stopDateInput.setAttribute('min', startDateInput.value);
    }

    if (startTimeInput.value) {
        stopTimeInput.setAttribute('min', startTimeInput.value);
    }

    // Update the current status initially
    updateCurrentStatus();

    // Update the current status every second
    setInterval(updateCurrentStatus, 1000);
});