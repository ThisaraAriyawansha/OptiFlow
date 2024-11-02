<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OptiFlow ERP Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/welcome_message.js"></script>
    <script src="../js/validation.js" defer></script>

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
        <li><a href="#" id="customer-link" onclick="showSection('customer-section')"><i class="fas fa-user"></i> Customers Registration</a></li>
        <li><a href="#" id="item-link" onclick="showSection('item-section')"><i class="fas fa-box"></i> Items Registration</a></li>
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
    <form id="customerForm" method="post" action="../DBOperations/register_customer.php">
        <label for="title">Title:</label>
        <select id="title" name="title" required>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
        </select>
        
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="first_name" required>
        
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="last_name" required>
        
        <label for="contactNumber">Contact Number:</label>
        <input type="tel" id="contactNumber" name="contact_number" pattern="[0-9]{10}" required placeholder="Enter 10-digit number">
        
        <label for="district">District:</label>
        <select id="district" name="district" required>
            <option value="" disabled selected>Select District</option>
            <option value="5">Colombo</option>
            <option value="7">Gampaha</option>
            <option value="11">Kalutara</option>
            <option value="12">Kandy</option>
            <option value="17">Matale</option>
            <option value="21">Nuwara Eliya</option>
            <option value="6">Galle</option>
            <option value="18">Matara</option>
            <option value="8">Hambantota</option>
            <option value="9">Jaffna</option>
            <option value="14">Kilinochchi</option>
            <option value="16">Mannar</option>
            <option value="25">Vavuniya</option>
            <option value="20">Mullaitivu</option>
            <option value="4">Batticaloa</option>
            <option value="1">Ampara</option>
            <option value="22">Polonnaruwa</option>
            <option value="2">Anuradhapura</option>
            <option value="15">Kurunegala</option>
            <option value="23">Puttalam</option>
            <option value="13">Kegalle</option>
            <option value="24">Ratnapura</option>
            <option value="3">Badulla</option>
            <option value="19">Moneragala</option>
        </select>
        <button type="submit">Register Customer</button>
    </form>
</div>


<div id="item-section" class="section-content" style="display: none;">
    <h2>Register Item</h2>
    <form id="itemForm" method="post" action="../DBOperations/register_item.php">
        <label>Item Code:</label>
        <input type="text" name="item_code" required>
        
        <label>Item Name:</label>
        <input type="text" name="item_name" required>
        
        <label>Item Category:</label>
        <select name="category" required>
            <option value="" disabled selected>Select Item Category</option>
            <option value="1">Printers</option>
            <option value="2">Laptops</option>
            <option value="3">Gadgets</option>
            <option value="4">Ink Bottles</option>
            <option value="5">Cartridges</option>
        </select>

        <label>Item Sub-Category:</label>
        <select name="sub_category" required>
            <option value="" disabled selected>Select Item Sub-Category</option>
            <option value="1">HP</option>
            <option value="2">Dell</option>
            <option value="3">Lenovo</option>
            <option value="4">Acer</option>
            <option value="5">Samsung</option>
        </select>

        <label>Quantity:</label>
        <input type="number" name="quantity" required>
        
        <label>Unit Price:</label>
        <input type="number" name="unit_price" required>

        <button type="submit">Register Item</button>
    </form>
</div>


<div id="report-section" class="section-content" style="display: none;">
    <h2>Reports</h2>

    <!-- Invoice Report -->
    <div class="report">
        <h3>Invoice Report</h3>
        <label>Date Range:</label>
        <input type="date" id="invoice_start_date"> to <input type="date" id="invoice_end_date">
        <button onclick="generateInvoiceReport()">Generate Report</button>
        <div id="invoice_report_result"></div>
    </div>

    <!-- Invoice Item Report -->
    <div class="report">
        <h3>Invoice Item Report</h3>
        <label>Date Range:</label>
        <input type="date" id="item_report_start_date"> to <input type="date" id="item_report_end_date">
        <button onclick="generateInvoiceItemReport()">Generate Report</button>
        <div id="item_report_result"></div>
    </div>

    <!-- Item Report -->
    <div class="report">
        <h3>Item Report</h3>
        <button onclick="generateItemReport()">Generate Report</button>
        <div id="item_report_output"></div>
    </div>
</div>


<script>
function generateInvoiceReport() {
    const startDate = document.getElementById('invoice_start_date').value;
    const endDate = document.getElementById('invoice_end_date').value;

    fetch(`../DBOperations/generate_report.php?type=invoice&start_date=${startDate}&end_date=${endDate}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('invoice_report_result').innerHTML = formatReportData(data);
        });
}

function generateInvoiceItemReport() {
    const startDate = document.getElementById('item_report_start_date').value;
    const endDate = document.getElementById('item_report_end_date').value;

    fetch(`../DBOperations/generate_report.php?type=invoice_item&start_date=${startDate}&end_date=${endDate}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('item_report_result').innerHTML = formatReportData(data);
        });
}

function generateItemReport() {
    fetch('../DBOperations/generate_report.php?type=item')
        .then(response => response.json())
        .then(data => {
            document.getElementById('item_report_output').innerHTML = formatReportData(data);
        });
}

function formatReportData(data) {
    if (data.error) {
        return `<p style="color: red;">${data.error}</p>`;
    }

    if (data.message) {
        return `<p>${data.message}</p>`;
    }

    let html = '<table style="width: 100%; border-collapse: collapse;">';
    html += '<tr>';

    // Add table headers dynamically
    Object.keys(data[0]).forEach(key => {
        html += `<th style="border: 1px solid #dddddd; padding: 8px; text-align: left;">${key}</th>`;
    });
    html += '</tr>';

    data.forEach(item => {
        html += '<tr>';
        Object.values(item).forEach(value => {
            html += `<td style="border: 1px solid #dddddd; padding: 8px;">${value}</td>`;
        });
        html += '</tr>';
    });
    html += '</table>';

    return html;
}

</script>


</main>

        </div>
    </div>

    <script src="../js/dashboard.js"></script>
</body>
</html>
