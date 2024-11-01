<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OptiFlow ERP Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/welcome_message.js"></script>
</head>
<body>

    <div class="dashboard-container">
        <header class="dashboard-header">
            <p id="welcome-message">Hello, Guest!</p>
            <h1>OptiFlow Dashboard</h1>
        </header>

        <div class="dashboard-content">
        <aside class="sidebar">
    <ul>
        <li><a href="#" id="dashboard-link" onclick="showSection('dashboard-section')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="#" id="customer-link" onclick="showSection('customer-section')"><i class="fas fa-user"></i> Customers</a></li>
        <li><a href="#" id="item-link" onclick="showSection('item-section')"><i class="fas fa-box"></i> Items</a></li>
        <li><a href="#" id="report-link" onclick="showSection('report-section')"><i class="fas fa-file-alt"></i> Reports</a></li>
    </ul>
</aside>

<main class="main-content">
    <div id="dashboard-section" class="section-content">
        <h2>Dashboard Overview</h2>
        <p>Welcome to the OptiFlow Dashboard. Here you can manage your operations efficiently.</p>
    </div>
    <div id="customer-section" class="section-content" style="display: none;">
        <h2>Register Customer</h2>
        <form id="customerForm">
            <label>Title:</label>
            <select required>
                <option>Mr</option>
                <option>Mrs</option>
                <option>Miss</option>
                <option>Dr</option>
            </select>
            <label>First Name:</label>
            <input type="text" required>
            <label>Last Name:</label>
            <input type="text" required>
            <label>Contact Number:</label>
            <input type="tel" pattern="[0-9]{10}" required>
            <label>District:</label>
            <input type="text" required>
            <button type="submit">Register Customer</button>
        </form>
        <div id="customerList">
            <h3>Customer List</h3>
            <!-- Table for viewing registered customers -->
        </div>
    </div>
    <div id="item-section" class="section-content" style="display: none;">
        <h2>Register Item</h2>
        <form id="itemForm">
            <label>Item Code:</label>
            <input type="text" required>
            <label>Item Name:</label>
            <input type="text" required>
            <label>Item Category:</label>
            <select required>
                <option>Electronics</option>
                <option>Furniture</option>
                <!-- Add other categories -->
            </select>
            <label>Item Sub-Category:</label>
            <select required>
                <option>Mobile</option>
                <option>Table</option>
                <!-- Add other sub-categories -->
            </select>
            <label>Quantity:</label>
            <input type="number" required>
            <label>Unit Price:</label>
            <input type="number" required>
            <button type="submit">Register Item</button>
        </form>
        <div id="itemList">
            <h3>Item List</h3>
            <!-- Table for viewing registered items -->
        </div>
    </div>
    <div id="report-section" class="section-content" style="display: none;">
        <h2>Reports</h2>

        <!-- Invoice Report -->
        <div class="report">
            <h3>Invoice Report</h3>
            <label>Date Range:</label>
            <input type="date"> to <input type="date">
            <button>Generate Report</button>
            <!-- Display generated report here -->
        </div>

        <!-- Invoice Item Report -->
        <div class="report">
            <h3>Invoice Item Report</h3>
            <label>Date Range:</label>
            <input type="date"> to <input type="date">
            <button>Generate Report</button>
            <!-- Display generated report here -->
        </div>

        <!-- Item Report -->
        <div class="report">
            <h3>Item Report</h3>
            <!-- Display items with no repetitions -->
        </div>
    </div>
</main>

        </div>
    </div>

    <script src="../js/dashboard.js"></script>
</body>
</html>
