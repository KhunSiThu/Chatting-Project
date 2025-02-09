<?php
require_once("./dbConnect.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$userId = $_SESSION['user_id'];

$sql = "SELECT *
        FROM groupMember 
        LEFT JOIN `group` ON group.groupId = groupMember.groupId
        WHERE  groupMember.memberId = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "SQL prepare error: " . $conn->error]);
    exit();
}

$stmt->bind_param("i", $userId);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(["error" => "SQL execution error: " . $stmt->error]);
    $stmt->close();
    exit();
}

$result = $stmt->get_result();
$groups = [];

while ($row = $result->fetch_assoc()) {
    $groupId = $row["groupId"];

    if (!isset($groups[$groupId])) {
        $groups[$groupId] = [
            "groupId" => $row["groupId"],
            "groupName" => $row["groupName"],
            "adminId" => $row["adminId"],
            "groupProfile" => $row["groupProfile"],
            "members" => []  // Array to store members
        ];
    }

    // Add members only if memberId is not null
    if (!empty($row["memberId"])) {
        $groups[$groupId]["members"][] = $row["memberId"];
    }
}

// Reformat to have indexed array
$groups = array_values($groups);

// Return user groups as JSON response
echo json_encode(["success" => true, "groups" => $groups]);

$stmt->close();
$conn->close();
?>
