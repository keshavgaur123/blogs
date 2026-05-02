<?php
header('Content-Type: application/json');

require_once 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    if (empty($name) || empty($title) || empty($description)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'All fields are required'
        ]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO contact (name, title, description) VALUES (?, ?, ?)");

    if (!$stmt) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Prepare failed: ' . $conn->error
        ]);
        exit;
    }

    $stmt->bind_param("sss", $name, $title, $description);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Saved successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Insert failed: ' . $stmt->error
        ]);
    }

    $stmt->close();
    $conn->close();
}