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
$groupId = $_SESSION['groupId'] ?? null;

// Ensure groupId is valid
if (is_null($groupId) || !is_numeric($groupId)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid or missing group ID"]);
    exit();
}

// Prepare the SQL query to fetch friends
$query = "
    SELECT 
        user.userId, 
        user.name, 
        user.profileImage, 
        user.status 
    FROM 
        friendList 
    LEFT JOIN 
        user 
    ON 
        (friendList.request = user.userId OR friendList.confirm = user.userId) 
    WHERE 
        (friendList.request = ? OR friendList.confirm = ?) 
        AND user.userId != ? 
    ORDER BY 
        user.name;
";

// Prepare and execute the query
$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to prepare SQL statement: " . mysqli_error($conn)]);
    exit();
}

// Bind parameters
mysqli_stmt_bind_param($stmt, "iii", $userId, $userId, $userId);

if (!mysqli_stmt_execute($stmt)) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to execute SQL query: " . mysqli_stmt_error($stmt)]);
    mysqli_stmt_close($stmt);
    exit();
}

// Fetch results
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to fetch results: " . mysqli_error($conn)]);
    mysqli_stmt_close($stmt);
    exit();
}

// Query to get the group members to filter out users who are already in the group
$groupQuery = "SELECT memberId FROM groupMember WHERE groupId = ?";
$stmtGroup = $conn->prepare($groupQuery);
$stmtGroup->bind_param("i", $groupId);
$stmtGroup->execute();
$groupResult = $stmtGroup->get_result();

$groupMembers = [];
while ($row = $groupResult->fetch_assoc()) {
    $groupMembers[] = $row['memberId'];
}

mysqli_free_result($groupResult);
$stmtGroup->close();

$results = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Skip if the user is already a member of the group
    if (in_array($row['userId'], $groupMembers)) {
        continue;
    }

    // Prepare the result
    $results[] = [
        'userId' => $row['userId'],
        'name' => $row['name'],
        'profileImage' => $row['profileImage'],
        'status' => $row['status'],
    ];
}

// Free resources
mysqli_free_result($result);
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Return the results
echo json_encode($results);
?>
