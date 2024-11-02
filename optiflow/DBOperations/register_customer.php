<?php
header('Content-Type: application/json');
include '../config/database.php'; 

function isValidContactNumber($contactNumber) {
    return preg_match('/^[0-9]{10}$/', $contactNumber);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $contactNumber = trim($_POST['contact_number']);
    $district = trim($_POST['district']);  // Ensure district is treated as a string

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

    if (!empty($errors)) {
        echo json_encode([
            "success" => false,
            "errors" => $errors
        ]);
    } else {
        $stmt = $conn->prepare("INSERT INTO customer (title, first_name, last_name, contact_no, district) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $firstName, $lastName, $contactNumber, $district);  
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

        $stmt->close();
    }
    $conn->close();
}
?>
