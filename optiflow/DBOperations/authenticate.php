<?php
header('Content-Type: application/json');

include '../config/database.php'; 


$data = json_decode(file_get_contents('php://input'), true);
$email = $data['username'] ?? ''; 
$password = $data['password'] ?? '';

$stmt = $conn->prepare("SELECT id, name, email, password FROM web_admin WHERE email = ?");
$stmt->bind_param("s", $email); 

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'message' => 'Database error.']);
    exit; 
}

$stmt->store_result(); 

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $name, $email, $stored_password); 
    $stmt->fetch();

    if ($password === $stored_password) {
        echo json_encode([
            'success' => true,
            'user' => [
                'id' => $id,
                'name' => $name,
                'email' => $email,
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
}

$stmt->close();
$conn->close();
?>
