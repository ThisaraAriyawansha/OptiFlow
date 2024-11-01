<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Interface</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

            

</head>
<body>

    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>Dashboard</h1>
            <p id="welcome-message"></p>
            <div class="user-info">
            <script>
        const userName = localStorage.getItem('userName');

        const welcomeMessage = document.getElementById('welcome-message');
        if (userName) {
            welcomeMessage.innerText = `Hello, ${userName}!`;
        } else {
            welcomeMessage.innerText = 'Hello, Guest!';
        }

    </script>

            </div>
        </header>

        <div class="dashboard-content">
            <aside class="sidebar">
                <ul>
                    <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-chart-line"></i> Analytics</a></li>
                    <li><a href="#"><i class="fas fa-box"></i> Products</a></li>
                    <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </aside>

            <main class="main-content">
                <div class="cards">
                    <div class="card">
                        <h2>Total Users</h2>
                        <p>1,200</p>
                    </div>
                    <div class="card">
                        <h2>Total Sales</h2>
                        <p>$45,000</p>
                    </div>
                    <div class="card">
                        <h2>New Orders</h2>
                        <p>150</p>
                    </div>
                </div>

                <div class="chart-container">
                    <h2>Sales Overview</h2>
                    <canvas id="salesChart"></canvas>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>
</html>
