<?php
header('Content-Type: application/json');

require_once("./dbConnect.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$userId = $_SESSION['user_id'];

// Get the input data
$data = json_decode(file_get_contents('php://input'), true);
$chooseId = $data['chooseId'] ?? null;

$_SESSION['chooseId'] = $data['chooseId'];

if (!$chooseId || !is_numeric($chooseId)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid or missing group ID"]);
    exit();
}

// Query to fetch group information based on the given group ID
$groupQuery = "
    SELECT 
        *
    FROM 
        `group`
    WHERE 
        groupId = ? 
";

$stmtGroup = $conn->prepare($groupQuery);
$stmtGroup->bind_param("i", $chooseId);

if (!$stmtGroup->execute()) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to fetch group data: " . mysqli_stmt_error($stmtGroup)]);
    $stmtGroup->close();
    exit();
}

$groupResult = $stmtGroup->get_result();

if ($groupResult->num_rows === 0) {
    http_response_code(404);
    echo json_encode(["error" => "Group not found"]);
    $stmtGroup->close();
    exit();
}

$groupData = $groupResult->fetch_assoc();

// Close resources
mysqli_free_result($groupResult);
$stmtGroup->close();
mysqli_close($conn);

// Return group data
echo json_encode([
    "success" => true,
    "group" => $groupData
]);
?>
