<?php
// Include database connection
include '../config/database.php'; // Make sure to create this file for database connection

header('Content-Type: application/json');

// Initialize an array to hold error messages
$errors = [];

// Check if form data was sent
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and sanitize inputs
    $item_code = trim($_POST['item_code']);
    $item_name = trim($_POST['item_name']);
    $category = trim($_POST['category']);
    $sub_category = trim($_POST['sub_category']);
    $quantity = intval($_POST['quantity']);
    $unit_price = floatval($_POST['unit_price']);

    // Validate the input fields
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

    // Check if there are validation errors
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    // Prepare SQL query to insert item into the database
    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the query
    if ($stmt) {
        $stmt->bind_param("sssiii", $item_code, $item_name, $category, $sub_category, $quantity, $unit_price);

        if ($stmt->execute()) {
            // Success response
            echo json_encode(['success' => true, 'message' => 'Item registered successfully.']);
        } else {
            // Error response if insertion fails
            echo json_encode(['success' => false, 'errors' => ['Failed to register the item. Please try again.']]);
        }

        $stmt->close();
    } else {
        // Error response if statement preparation fails
        echo json_encode(['success' => false, 'errors' => ['Database error. Please contact support.']]);
    }
} else {
    echo json_encode(['success' => false, 'errors' => ['Invalid request.']]);
}

$conn->close();
?>
