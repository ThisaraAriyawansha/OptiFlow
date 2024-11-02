<?php
session_start();
include '../config/database.php'; 

function generateInvoiceNo($conn) {
    $result = $conn->query("SELECT MAX(invoice_no) AS max_invoice FROM invoice");
    $row = $result->fetch_assoc();
    
    if ($row['max_invoice'] === null) {
        return '1001'; 
    } else {
        $max_invoice = intval($row['max_invoice']) + 1;
        return str_pad($max_invoice, 4, '0', STR_PAD_LEFT); 
    }
}

$invoice_no = generateInvoiceNo($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Purchase Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="../css/cashier_Interface.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Product Purchase Form</h2>
        <p id="welcome-message"></p>
        <p class="instructions">Please fill out the form below to complete your purchase.</p>

        <script>
            const userName = localStorage.getItem('userName');
            const welcomeMessage = document.getElementById('welcome-message');
            welcomeMessage.innerText = userName ? `Hello, ${userName}!` : 'Hello, Guest!';

            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                swal("Success!", "Purchase processed successfully!", "success");
            }
        </script>

        <form action="../DBOperations/process_purchase.php" method="POST">
            <div class="form-group">
                <label for="invoice_no">Invoice Number:</label>
                <input type="text" id="invoice_no" name="invoice_no" readonly value="<?php echo $invoice_no; ?>">
            </div>

            <div class="form-group">
                <label for="customer">Select Customer:</label>
                <select name="customer_id" id="customer" required>
                    <?php
                        $result = $conn->query("SELECT id, CONCAT(first_name, ' ', last_name) AS name FROM customer");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="item_category">Select Item Category:</label>
                <select name="item_category" id="item_category" required>
                    <?php
                        $result = $conn->query("SELECT id, category FROM item_category");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['category']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="item_subcategory">Select Item Subcategory:</label>
                <select name="item_subcategory" id="item_subcategory" required>
                    <?php
                        $result = $conn->query("SELECT id, sub_category FROM item_subcategory");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['sub_category']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="item">Select Product:</label>
                <select name="item_id" id="item" required>
                    <?php
                        $result = $conn->query("SELECT id, item_name, unit_price FROM item");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}' data-price='{$row['unit_price']}'>{$row['item_name']} - {$row['unit_price']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>
            </div>

            <div class="form-group">
                <label for="total_price">Total Price:</label>
                <input type="text" id="total_price" name="total_price" readonly>
            </div>

            <button type="submit">Process Purchase</button>
        </form>

        <a href="../index.php"><button class="back-button" onclick="window.history.back();">Back</button></a>
    </div>

    <script>
        document.getElementById("item").addEventListener("change", calculateTotal);
        document.getElementById("quantity").addEventListener("input", calculateTotal);

        function calculateTotal() {
            let item = document.getElementById("item");
            let price = item.options[item.selectedIndex].getAttribute("data-price");
            let quantity = document.getElementById("quantity").value;
            let total = price * quantity;
            document.getElementById("total_price").value = total ? total.toFixed(2) : "";
        }
    </script>
</body>
</html>
