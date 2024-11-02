<?php
// process_purchase.php
session_start();
include '../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $invoice_no = $_POST['invoice_no'];
    $customer_id = $_POST['customer_id'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    // Insert into invoice table
    $date = date('Y-m-d');
    $time = date('H:i:s');

    // Prepare and execute the invoice insert query
    $stmt = $conn->prepare("INSERT INTO invoice (date, time, invoice_no, customer, item_count, amount) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $date, $time, $invoice_no, $customer_id, $quantity, $total_price);
    
    if ($stmt->execute()) {
        // Retrieve the last inserted invoice ID for the invoice_master table
        $last_id = $stmt->insert_id;

        // Insert into invoice_master table
        $amount = $_POST['total_price']; // Assuming total price is being sent correctly
        $stmt2 = $conn->prepare("INSERT INTO invoice_master (invoice_no, item_id, quantity, unit_price, amount) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("ssiis", $invoice_no, $item_id, $quantity, $unit_price, $amount);

        // Fetch unit price from the item table
        $result = $conn->query("SELECT unit_price FROM item WHERE id = $item_id");
        $item = $result->fetch_assoc();
        $unit_price = $item['unit_price'];

        if ($stmt2->execute()) {
            echo "Purchase processed successfully. Invoice No: $invoice_no";
        } else {
            echo "Error processing invoice: " . $stmt2->error;
        }
    } else {
        echo "Error inserting invoice: " . $stmt->error;
    }

    $stmt->close();
    $stmt2->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
