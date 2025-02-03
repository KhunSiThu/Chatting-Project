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

$results = [];
while ($row = mysqli_fetch_assoc($result)) {

    // Prepare SQL query to fetch last message
    $messQuery = "SELECT * FROM messages 
    WHERE (receive_id = ? AND send_id = ?) OR (receive_id = ? AND send_id = ?) 
    ORDER BY messages.message_id DESC LIMIT 1";

    $stmtMess = $conn->prepare($messQuery);
    $stmtMess->bind_param("iiii", $userId, $row['userId'], $row['userId'], $userId);
    $stmtMess->execute();
    $messResult = $stmtMess->get_result();

    $message = $messResult->fetch_assoc();

    // Limit the message to 40 characters
    $messageText = $message ? $message['message'] : 'No messages yet';
    $maxLength = 40;  // Set the maximum character length

    if (strlen($messageText) > $maxLength) {
        $messageText = substr($messageText, 0, $maxLength) . '...';
    }

    // Prepare result with message
    $results[] = [
        'userId' => $row['userId'],
        'name' => $row['name'],
        'profileImage' => $row['profileImage'],
        'status' => $row['status'],
        'lastMessage' => $messageText,  // Store the limited message
    ];

    // Free message result
    mysqli_free_result($messResult);
}

// Free resources
mysqli_free_result($result);
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Return the results
echo json_encode($results);
?>
