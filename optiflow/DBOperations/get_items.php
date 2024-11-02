<?php
include '../config/database.php';

$subcategoryId = $_GET['subcategory_id'];
$result = $conn->query("SELECT id, item_name, unit_price FROM item WHERE item_subcategory = $subcategoryId");

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode($items);

$conn->close();
?>
