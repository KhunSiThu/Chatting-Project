<?php
require_once("./dbConnect.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$userId = $_SESSION['user_id'];

// Query to get groups where the user is an admin or a member
$sql = "SELECT DISTINCT g.* 
        FROM `group` g
        LEFT JOIN groupMember gm ON g.groupId = gm.groupId
        WHERE g.adminId = ? OR gm.memberId = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "SQL prepare error: " . $conn->error]);
    exit();
}

$stmt->bind_param("ii", $userId, $userId);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(["error" => "SQL execution error: " . $stmt->error]);
    $stmt->close();
    exit();
}

$result = $stmt->get_result();
$groups = [];

while ($row = $result->fetch_assoc()) {
    $groups[] = $row;
}

// Return user groups as JSON response
echo json_encode(["success" => true, "groups" => $groups]);

$stmt->close();
$conn->close();
?>
