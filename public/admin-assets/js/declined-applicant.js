$(document).ready(function() {
    let minDate, maxDate;

    // Set today's date for max input
    const today = new Date();
    const formattedToday = today.toISOString().split('T')[0]; // Get the date in YYYY-MM-DD format
    $('#max').attr('max', formattedToday); // Set max date for the 'max' input

    // Custom filtering function
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = minDate.val();
        let max = maxDate.val();
        let date = new Date(data[1]);  // Assuming the date is in the second column (index 1)

        // If both min and max are empty, return true to show all rows
        if (!min && !max) {
            return true; // Show all data if no filter is applied
        }

        // If min is empty, check against max only
        if (!min && date <= new Date(max)) {
            return true; // Show data if it's less than or equal to max
        }

        // If max is empty, check against min only
        if (!max && date >= new Date(min)) {
            return true; // Show data if it's greater than or equal to min
        }

        // Check against both min and max
        if (date >= new Date(min) && date <= new Date(max)) {
            return true; // Show data within range
        }

        return false; // Hide data if it doesn't meet any criteria
    });

    // Create date inputs
    minDate = new DateTime('#min', {
        format: 'MMMM D, YYYY'
    });
    maxDate = new DateTime('#max', {
        format: 'MMMM D, YYYY'
    });

    var table = $("#basic-datatables").DataTable({
        columns: [
            { data: 'id' },
            { data: 'date_applied' },
            { data: 'full_name' },
            { data: 'incoming_grade_year' },
            { data: 'current_school' },
            { data: 'status' },
            { data: 'action' }
        ]
    });

    // Refilter the table based on date inputs
    $('#min, #max').on('change', function () {
        table.draw();
    });

    
});
