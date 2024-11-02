<?php
include '../config/database.php';

$categoryId = $_GET['category_id'];
$result = $conn->query("SELECT id, sub_category FROM item_subcategory WHERE category_id = $categoryId");

$subcategories = [];
while ($row = $result->fetch_assoc()) {
    $subcategories[] = $row;
}

echo json_encode($subcategories);

$conn->close();
?>
