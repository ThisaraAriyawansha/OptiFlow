<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Purchase Form</title>
    <link rel="stylesheet" href="../css/cashier_Interface.css"> <!-- Include your CSS file for styling -->
</head>
<body>
    <h2>Product Purchase Form</h2>
    <form action="process_purchase.php" method="POST">
        <!-- Customer Selection -->
        <label for="customer">Select Customer:</label>
        <select name="customer_id" id="customer" required>
            <?php
                // Connect to the database
                $conn = new mysqli("localhost", "root", "", "assignment");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch customers
                $result = $conn->query("SELECT id, first_name, last_name FROM customer");

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['first_name']} {$row['last_name']}</option>";
                }

                $conn->close();
            ?>
        </select><br>

        <!-- Product Selection -->
        <label for="item">Select Product:</label>
        <select name="item_id" id="item" required>
            <?php
                // Reconnect to the database
                $conn = new mysqli("localhost", "root", "", "assignment");

                // Fetch items
                $result = $conn->query("SELECT id, item_name, unit_price FROM item");

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}' data-price='{$row['unit_price']}'>{$row['item_name']} - $ {$row['unit_price']}</option>";
                }

                $conn->close();
            ?>
        </select><br>

        <!-- Quantity -->
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required><br>

        <!-- Total Price (calculated automatically) -->
        <label for="total_price">Total Price:</label>
        <input type="text" id="total_price" name="total_price" readonly><br>

        <!-- Submit Button -->
        <button type="submit">Process Purchase</button>
    </form>

    <script>
        // JavaScript to automatically calculate total price based on selected item and quantity
        document.getElementById("item").addEventListener("change", calculateTotal);
        document.getElementById("quantity").addEventListener("input", calculateTotal);

        function calculateTotal() {
            let item = document.getElementById("item");
            let price = item.options[item.selectedIndex].getAttribute("data-price");
            let quantity = document.getElementById("quantity").value;
            let total = price * quantity;
            document.getElementById("total_price").value = total ? `$ ${total.toFixed(2)}` : "";
        }
    </script>
</body>
</html>
