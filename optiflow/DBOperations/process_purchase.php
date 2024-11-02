<?php
// process_purchase.php
session_start();
include '../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $invoice_no = $_POST['invoice_no'];
    $customer_id = $_POST['customer_id'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    $date = date('Y-m-d');
    $time = date('H:i:s');

    $stmt = $conn->prepare("INSERT INTO invoice (date, time, invoice_no, customer, item_count, amount) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $date, $time, $invoice_no, $customer_id, $quantity, $total_price);
    
    if ($stmt->execute()) {
        $last_id = $stmt->insert_id;

        $amount = $_POST['total_price']; 
        $stmt2 = $conn->prepare("INSERT INTO invoice_master (invoice_no, item_id, quantity, unit_price, amount) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("ssiis", $invoice_no, $item_id, $quantity, $unit_price, $amount);

        $result = $conn->query("SELECT unit_price FROM item WHERE id = $item_id");
        $item = $result->fetch_assoc();
        $unit_price = $item['unit_price'];

        if ($stmt2->execute()) {
            header('Location: ../views/cashier_interface.php?success=true');
            exit();
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
