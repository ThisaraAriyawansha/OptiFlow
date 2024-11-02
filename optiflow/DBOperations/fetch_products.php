<?php
// fetch_products.php
session_start();
include '../config/database.php';

if (isset($_GET['subcategory_id'])) {
    $subcategory_id = $_GET['subcategory_id'];

    $stmt = $conn->prepare("SELECT id, item_name, unit_price FROM item WHERE subcategory_id = ?");
    $stmt->bind_param("i", $subcategory_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $stmt->close();

    echo json_encode($products);
}
