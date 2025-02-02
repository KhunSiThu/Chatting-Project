<?php
require_once('./dbConnect.php');

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];

$query = "SELECT user.userId, user.name, user.profileImage, user.status 
          FROM friendRequests 
          LEFT JOIN user ON friendRequests.request_id = user.userId 
          WHERE friendRequests.forConfirm_id = ? 
          ORDER BY user.name";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Database query preparation failed']);
    exit();
}

mysqli_stmt_bind_param($stmt, 'i', $userId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Database query execution failed']);
    exit();
}

$results = [];

while ($row = mysqli_fetch_assoc($result)) {
    $results[] = $row;
}

echo json_encode($results);

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>