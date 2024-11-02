<?php
header('Content-Type: application/json');

include '../config/database.php'; 

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['username'] ?? ''; 
$password = $data['password'] ?? '';

function checkUser($conn, $email, $password, $table) {
    $stmt = $conn->prepare("SELECT id, name, email, password FROM $table WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $email, $stored_password);
        $stmt->fetch();

        if ($password === $stored_password) {
            return [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'role' => $table
            ];
        }
    }
    
    $stmt->close();
    return false;
}

$manager = checkUser($conn, $email, $password, 'manager');
$cashier = checkUser($conn, $email, $password, 'cashier');

if ($manager) {
    echo json_encode([
        'success' => true,
        'user' => $manager
    ]);
} elseif ($cashier) {
    echo json_encode([
        'success' => true,
        'user' => $cashier
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
}

$conn->close();
?>
