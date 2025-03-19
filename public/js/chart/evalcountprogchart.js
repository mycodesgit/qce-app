$(document).ready(function () {
    $.ajax({
        url: evalcountchartReadRoute, // Update to your Laravel route
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            // Function to generate random colors
            function getRandomColor() {
                return '#' + Math.floor(Math.random() * 16777215).toString(16);
            }

            // Generate a random color for each program
            var backgroundColors = response.labels.map(() => getRandomColor());

            var ctx = $('#enrlmntpercamp-chart');

            var salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.labels,
                    datasets: [{
                        backgroundColor: backgroundColors,
                        borderColor: '#ced4da',
                        data: response.data
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: 'index',
                        intersect: true,
                        callbacks: {
                            title: function (tooltipItem, data) {
                                return data.labels[tooltipItem[0].index];
                            },
                            label: function (tooltipItem, data) {
                                return 'Count: ' + data.datasets[0].data[tooltipItem.index];
                            }
                        }
                    },
                    hover: {
                        mode: 'index',
                        intersect: true
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: true
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    });
});
