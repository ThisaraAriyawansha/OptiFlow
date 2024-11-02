<?php
// cashier_form.php
session_start();
include '../config/database.php'; 

// Function to generate the next invoice number
function generateInvoiceNo($conn) {
    $result = $conn->query("SELECT MAX(invoice_no) AS max_invoice FROM invoice");
    $row = $result->fetch_assoc();
    
    // Check if there are existing invoices
    if ($row['max_invoice'] === null) {
        return '1001'; // Start from 1001 if no invoices exist
    } else {
        $max_invoice = intval($row['max_invoice']) + 1;
        return str_pad($max_invoice, 4, '0', STR_PAD_LEFT); // Pad with zeros
    }
}

$invoice_no = generateInvoiceNo($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Purchase Form</title>
    <link rel="stylesheet" href="../css/cashier_Interface.css">
</head>
<body>
    <p id="welcome-message"></p>

    <script>
        const userName = localStorage.getItem('userName');
        const welcomeMessage = document.getElementById('welcome-message');
        welcomeMessage.innerText = userName ? `Hello, ${userName}!` : 'Hello, Guest!';
    </script>

    <h2>Product Purchase Form</h2>
    <form action="../DBOperations/process_purchase.php" method="POST">
        <!-- Invoice Number -->
        <label for="invoice_no">Invoice Number:</label>
        <input type="text" id="invoice_no" name="invoice_no" readonly value="<?php echo $invoice_no; ?>"><br>

        <!-- Customer Selection -->
        <label for="customer">Select Customer:</label>
        <select name="customer_id" id="customer" required>
            <?php
                // Fetch customers
                $result = $conn->query("SELECT id, CONCAT(first_name, ' ', last_name) AS name FROM customer");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            ?>
        </select><br>

        <!-- Item Category Selection -->
        <label for="item_category">Select Item Category:</label>
        <select name="item_category" id="item_category" required>
            <?php
                // Fetch item categories
                $result = $conn->query("SELECT id, category FROM item_category");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['category']}</option>";
                }
            ?>
        </select><br>

        <!-- Item Subcategory Selection -->
        <label for="item_subcategory">Select Item Subcategory:</label>
        <select name="item_subcategory" id="item_subcategory" required>
            <?php
                // Fetch item subcategories
                $result = $conn->query("SELECT id, sub_category FROM item_subcategory");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['sub_category']}</option>";
                }
            ?>
        </select><br>

        <!-- Product Selection -->
        <label for="item">Select Product:</label>
        <select name="item_id" id="item" required>
            <?php
                // Fetch items
                $result = $conn->query("SELECT id, item_name, unit_price FROM item");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}' data-price='{$row['unit_price']}'>{$row['item_name']} - {$row['unit_price']}</option>";
                }
            ?>
        </select><br>

        <!-- Quantity -->
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required><br>

        <!-- Total Price -->
        <label for="total_price">Total Price:</label>
        <input type="text" id="total_price" name="total_price" readonly><br>

        <!-- Submit Button -->
        <button type="submit">Process Purchase</button>
    </form>

    <script>
        document.getElementById("item").addEventListener("change", calculateTotal);
        document.getElementById("quantity").addEventListener("input", calculateTotal);

        function calculateTotal() {
            let item = document.getElementById("item");
            let price = item.options[item.selectedIndex].getAttribute("data-price");
            let quantity = document.getElementById("quantity").value;
            let total = price * quantity;
            // Removed dollar sign from total price
            document.getElementById("total_price").value = total ? total.toFixed(2) : "";
        }
    </script>
</body>
</html>
