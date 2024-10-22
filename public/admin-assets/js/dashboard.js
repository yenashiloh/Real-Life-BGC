$(document).ready(function() {
    var barChart;

    function initializeBarChart() {
        var ctx = document.getElementById('barChart').getContext('2d');
        barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Grade Year Level Summary',
                    data: [],
                    backgroundColor: [],
                    borderColor: [],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function updateBarChart(data) {
        if (!barChart) {
            initializeBarChart();
        }

        barChart.data.labels = data.labels || [];
        barChart.data.datasets[0].data = data.counts || [];
        barChart.data.datasets[0].backgroundColor = generateColors(data.labels.length);
        barChart.data.datasets[0].borderColor = generateColors(data.labels.length, false);
        barChart.update();
    }

    function generateColors(count, withAlpha = true) {
        var colors = [];
        for (var i = 0; i < count; i++) {
            var color = 'rgb(' + 
                Math.floor(Math.random() * 256) + ',' + 
                Math.floor(Math.random() * 256) + ',' + 
                Math.floor(Math.random() * 256) + 
                (withAlpha ? ',0.2)' : ')');
            colors.push(color);
        }
        return colors;
    }

    function updateDashboard(startDate, endDate) {
        $.ajax({
            url: '/admin/get-dashboard-data',
            type: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                if (data) {
                    updateStatistics(data);  // Update total counts
                    if (data.barChartData && data.barChartData.labels && data.barChartData.counts) {
                        updateBarChart(data.barChartData);  // Update the bar chart
                    } else {
                        console.error('Invalid bar chart data:', data.barChartData);
                    }
                } else {
                    alert('Unable to fetch data. Please try again later.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching dashboard data:', error);
                alert('Unable to fetch dashboard data. Please try again later.');
            }
        });
    }
    

    function updateStatistics(data) {
        $('#totalApplicants').text(data.totalApplicants || 0);
        $('#totalShortlisted').text(data.totalShortlisted || 0);
        $('#totalForInterview').text(data.totalForInterview || 0);
        $('#totalHouseVisitation').text(data.totalHouseVisitation || 0);
        $('#totalApproved').text(data.totalApproved || 0);
        $('#totalDeclined').text(data.totalDeclined || 0);
    }

    // Initialize chart on page load
    initializeBarChart();

    // Set up date range picker and initial data load
    $('#reportrange').daterangepicker({
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        updateDashboard(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });

    // Trigger initial data load
    updateDashboard(moment().subtract(29, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));
});
