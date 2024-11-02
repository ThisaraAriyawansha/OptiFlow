<?php
header('Content-Type: application/json');
include '../config/database.php'; 

// Function to validate contact number format
function isValidContactNumber($contactNumber) {
    return preg_match('/^[0-9]{10}$/', $contactNumber);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $title = trim($_POST['title']);
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $contactNumber = trim($_POST['contact_number']);
    $district = trim($_POST['district']);  // Ensure district is treated as a string

    // Server-side validation
    $errors = [];
    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    if (empty($firstName)) {
        $errors[] = "First name is required.";
    }
    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }
    if (!isValidContactNumber($contactNumber)) {
        $errors[] = "Contact number must be a valid 10-digit number.";
    }
    if (empty($district)) {
        $errors[] = "District is required.";
    }

    // If there are validation errors, return them as JSON
    if (!empty($errors)) {
        echo json_encode([
            "success" => false,
            "errors" => $errors
        ]);
    } else {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO customer (title, first_name, last_name, contact_no, district) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $firstName, $lastName, $contactNumber, $district);  // Bind district as string

        // Execute SQL statement
        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Customer registered successfully!"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "errors" => ["Database error: " . $stmt->error]
            ]);
        }

        // Close statement and connection
        $stmt->close();
    }
    $conn->close();
}
?>
