<?php
// Include database connection
include '../config/database.php'; // Make sure to create this file for database connection

header('Content-Type: application/json');

// Initialize an array to hold error messages
$errors = [];
$type = $_GET['type'];

if ($type == 'invoice') {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $sql = "SELECT invoice_no, date, customer, c.district, item_count, amount 
            FROM invoice i 
            JOIN customer c ON i.customer = c.id 
            WHERE date BETWEEN '$start_date' AND '$end_date'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Invoice Number</th><th>Date</th><th>Customer</th><th>District</th><th>Item Count</th><th>Invoice Amount</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["invoice_no"] . "</td><td>" . $row["date"] . "</td><td>" . $row["customer"] . "</td><td>" . $row["district"] . "</td><td>" . $row["item_count"] . "</td><td>" . $row["amount"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }

} elseif ($type == 'invoice_item') {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $sql = "SELECT i.invoice_no, i.date, c.first_name, im.item_id, item_name, item_code, unit_price 
            FROM invoice i 
            JOIN customer c ON i.customer = c.id 
            JOIN invoice_master im ON i.invoice_no = im.invoice_no 
            JOIN item it ON im.item_id = it.id 
            WHERE i.date BETWEEN '$start_date' AND '$end_date'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Invoice Number</th><th>Invoiced Date</th><th>Customer Name</th><th>Item Name</th><th>Item Code</th><th>Unit Price</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["invoice_no"] . "</td><td>" . $row["date"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["item_name"] . "</td><td>" . $row["item_id"] . "</td><td>" . $row["unit_price"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }

} elseif ($type == 'item') {
    $sql = "SELECT DISTINCT item_name, item_category, item_subcategory, quantity 
            FROM item";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Item Name</th><th>Item Category</th><th>Item Subcategory</th><th>Item Quantity</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["item_name"] . "</td><td>" . $row["item_category"] . "</td><td>" . $row["item_subcategory"] . "</td><td>" . $row["quantity"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No items found.";
    }
}

$conn->close();
?>
