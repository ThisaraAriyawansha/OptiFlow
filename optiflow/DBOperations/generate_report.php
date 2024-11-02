<?php
include '../config/database.php';

$type = $_GET['type'] ?? null; // Use null coalescing operator for safety

if (!$type) {
    echo json_encode(['error' => 'Report type is required.']);
    exit;
}

// Prepare the SQL statement
switch ($type) {
    case 'invoice':
        $start_date = $_GET['start_date'] ?? null;
        $end_date = $_GET['end_date'] ?? null;

        if (!$start_date || !$end_date) {
            echo json_encode(['error' => 'Start date and end date are required.']);
            exit;
        }

        $sql = "SELECT * FROM invoice WHERE date BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $start_date, $end_date);
        break;

    case 'invoice_item':
        $start_date = $_GET['start_date'] ?? null;
        $end_date = $_GET['end_date'] ?? null;

        if (!$start_date || !$end_date) {
            echo json_encode(['error' => 'Start date and end date are required.']);
            exit;
        }

        $sql = "SELECT * FROM invoice_master WHERE invoice_no IN (SELECT invoice_no FROM invoice WHERE date BETWEEN ? AND ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $start_date, $end_date);
        break;

    case 'item':
        $sql = "SELECT * FROM item";
        $stmt = $conn->prepare($sql);
        break;

    default:
        echo json_encode(['error' => 'Invalid report type.']);
        exit;
}

// Execute the statement
if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are results
    if ($result->num_rows > 0) {
        $output = [];
        while ($row = $result->fetch_assoc()) {
            $output[] = $row; // Add each row to output array
        }
        echo json_encode($output); // Output in JSON format
    } else {
        echo json_encode(['message' => 'No results found.']);
    }

    $stmt->close(); // Close the prepared statement
} else {
    echo json_encode(['error' => 'Failed to prepare the SQL statement.']);
}

$conn->close(); // Close the database connection
?>
