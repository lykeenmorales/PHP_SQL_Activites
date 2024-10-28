<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card .title {
            font-size: 1.2rem;
            color: #333;
        }
        .card .value {
            font-size: 2rem;
            font-weight: bold;
        }
        .increase {
            color: green;
        }
        .decrease {
            color: red;
        }
        .chart-container {
            position: relative;
            height: 80px; /* Adjust as needed */
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Ticket Sold Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="title">Ticket Sold</div>
                    <div class="d-flex align-items-center">
                        <span class="value">2,1123</span>
                        <span class="ms-3 increase">+25% vs last month</span>
                    </div>
                    <div class="chart-container">
                        <canvas id="chartSold"></canvas>
                    </div>
                </div>
            </div>
            <!-- Ticket Refund Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="title">Ticket Refund</div>
                    <div class="d-flex align-items-center">
                        <span class="value">32</span>
                        <span class="ms-3 decrease">-25% vs last month</span>
                    </div>
                    <div class="chart-container">
                        <canvas id="chartRefund"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ticket Sold Chart
        const ctxSold = document.getElementById('chartSold').getContext('2d');
        const chartSold = new Chart(ctxSold, {
            type: 'line',
            data: {
                labels: ['', '', '', '', '', '', ''], // Replace with actual data labels
                datasets: [{
                    data: [2, 5, 3, 6, 7, 5, 8], // Replace with actual data points
                    borderColor: 'green',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { display: false },
                    y: { display: false }
                },
                plugins: { legend: { display: false } }
            }
        });

        // Ticket Refund Chart
        const ctxRefund = document.getElementById('chartRefund').getContext('2d');
        const chartRefund = new Chart(ctxRefund, {
            type: 'line',
            data: {
                labels: ['', '', '', '', '', '', ''], // Replace with actual data labels
                datasets: [{
                    data: [8, 6, 5, 3, 4, 2, 1], // Replace with actual data points
                    borderColor: 'red',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { display: false },
                    y: { display: false }
                },
                plugins: { legend: { display: false } }
            }
        });
    </script>
</body>
</html>
