<?php
include '../config/database.php'; 
header('Content-Type: application/json');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and sanitize inputs
    $item_code = trim($_POST['item_code']);
    $item_name = trim($_POST['item_name']);
    $category = trim($_POST['category']);
    $sub_category = trim($_POST['sub_category']);
    $quantity = intval($_POST['quantity']);
    $unit_price = floatval($_POST['unit_price']);

    if (empty($item_code)) {
        $errors[] = 'Item code is required.';
    }
    if (empty($item_name)) {
        $errors[] = 'Item name is required.';
    }
    if (empty($category)) {
        $errors[] = 'Please select a category.';
    }
    if (empty($sub_category)) {
        $errors[] = 'Please select a sub-category.';
    }
    if ($quantity <= 0) {
        $errors[] = 'Quantity must be a positive number.';
    }
    if ($unit_price <= 0) {
        $errors[] = 'Unit price must be a positive number.';
    }

    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssiii", $item_code, $item_name, $category, $sub_category, $quantity, $unit_price);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Item registered successfully.']);
        } else {
            echo json_encode(['success' => false, 'errors' => ['Failed to register the item. Please try again.']]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'errors' => ['Database error. Please contact support.']]);
    }
} else {
    echo json_encode(['success' => false, 'errors' => ['Invalid request.']]);
}

$conn->close();
?>
