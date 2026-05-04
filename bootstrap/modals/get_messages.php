<?php
include_once 'db.php';
header('Content-Type: application/json');


// Corrected SQL query using your actual table columns
$sql = "SELECT id, name, title, description, author_id, crated_at AS datetime, update_at AS updated_at 
        FROM contact 
        ORDER BY crated_at DESC";

$result = $conn->query($sql);

$messages = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'title' => $row['title'],
            'description' => $row['description'],
            'author_id' => $row['author_id'],
            'datetime' => $row['datetime']

        ];
    }
}

// Return messages as JSON
echo json_encode($messages);
$conn->close();




// User submits form
//       ↓
// Prevent reload
//       ↓
// Validate inputs
//       ↓
// Send AJAX request
//       ↓
// Disable button (Sending...)
//       ↓
// Server response
//    ↓         ↓
// Success     Error
//    ↓          ↓
// Show msg   Show error
// Reset form
//    ↓
// Close modal
//    ↓
// Redirect page