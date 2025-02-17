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

// Prepare the SQL query
$query = "SELECT user.userId, user.name, user.profileImage, user.status 
          FROM friendRequests 
          LEFT JOIN user ON friendRequests.forConfirm_id = user.userId 
          WHERE friendRequests.request_id = $userId 
          ORDER BY user.name";

$result = mysqli_query($conn, $query);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Database query execution failed: ' . mysqli_error($conn)]);
    exit();
}

$results = [];

while ($row = mysqli_fetch_assoc($result)) {
    $results[] = $row;
}

echo json_encode($results);

// Close the connection
mysqli_close($conn);
?>
