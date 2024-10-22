

/***********************************************************/
$(document).ready(function() {
  // Variable to store the chart instance
  var chartInstance;

  // Check if there's a selected year in session storage and update the dropdown if it exists
  var selectedYear = sessionStorage.getItem('selectedYear');
  if (selectedYear) {
      // Update the active state of the clicked year in the dropdown
      $('.filter-year').removeClass('active');
      $('.filter-year[data-value="' + selectedYear + '"]').addClass('active');
      fetchDataForYear(selectedYear);
      fetchGraphDataForYear(selectedYear);
  }

  // Event listener for clicking a year
  $('.filter-year').click(function(e) {
      e.preventDefault();
      var selectedYear = $(this).data('value');

      // Save the selected year to session storage
      sessionStorage.setItem('selectedYear', selectedYear);

      // Update the active state of the clicked year in the dropdown
      $('.filter-year').removeClass('active');
      $(this).addClass('active');

      // Fetch data for the selected year
      fetchDataForYear(selectedYear);
      fetchGraphDataForYear(selectedYear);
  });

  // Function to fetch data for the selected year
  function fetchDataForYear(year) {
      // Make an AJAX request to fetch data for the selected year
      $.ajax({
          url: '/get-data-for-year',
          type: 'GET',
          data: {
              year: year
          },
          success: function(data) {
              // Update the content of the HTML elements with the received data
              $('#totalApplicants').text(data.totalApplicants);
              $('#totalShortlisted').text(data.totalShortlisted);
              $('#totalForInterview').text(data.totalForInterview);
              $('#totalHouseVisitation').text(data.totalHouseVisitation);
              $('#totalDeclined').text(data.totalDeclined);
              $('#totalApproved').text(data.totalApproved);
          },
          error: function(xhr, status, error) {
              // Handle errors
              console.error(xhr.responseText);
          }
      });
  }

  // Function to fetch graph data for the selected year
  function fetchGraphDataForYear(year) {
      // Make an AJAX request to fetch graph data for the selected year
      $.ajax({
          url: '/get-graph-data-for-year',
          type: 'GET',
          data: {
              year: year
          },
          success: function(data) {
              // Filter out labels with count 0
              var filteredLabels = [];
              var filteredCounts = [];
              for (var i = 0; i < data.labels.length; i++) {
                  if (data.counts[i] !== 0) {
                      filteredLabels.push(data.labels[i]);
                      filteredCounts.push(data.counts[i]);
                  }
              }

              // Destroy the existing chart instance if it exists
              if (chartInstance) {
                  chartInstance.destroy();
              }

              // Create a new chart with the filtered data
              createChart(filteredLabels, filteredCounts);
          },
          error: function(xhr, status, error) {
              // Handle errors
              console.error(xhr.responseText);
          }
      });
  }

  // Function to create the chart
  function createChart(labels, counts) {
      const randomColor = () => {
          const r = Math.floor(Math.random() * 256);
          const g = Math.floor(Math.random() * 256);
          const b = Math.floor(Math.random() * 256);
          return `rgba(${r}, ${g}, ${b}, 0.2)`;
      };

      const randomBorderColor = () => {
          const r = Math.floor(Math.random() * 256);
          const g = Math.floor(Math.random() * 256);
          const b = Math.floor(Math.random() * 256);
          return `rgb(${r}, ${g}, ${b})`;
      };

      const ctx = document.getElementById('barChart').getContext('2d');
      chartInstance = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: labels,
              datasets: [{
                  label: 'Grade School / Year Level',
                  data: counts,
                  backgroundColor: Array.from({
                      length: counts.length
                  }, () => randomColor()),
                  borderColor: Array.from({
                      length: counts.length
                  }, () => randomBorderColor()),
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  }
});