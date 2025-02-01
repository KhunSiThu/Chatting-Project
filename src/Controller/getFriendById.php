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

// Get the input data
$data = json_decode(file_get_contents('php://input'), true);
$chooseId = $data['chooseId'] ?? null;

if (empty($chooseId)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input: 'chooseId' is required"]);
    exit();
}

$userId = $_SESSION['user_id'];
$_SESSION['chooseId'] = $data['chooseId'];

// Prepare the SQL query to fetch the selected friend's details
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
        ((friendList.request = ? AND friendList.confirm = ?) 
        OR (friendList.request = ? AND friendList.confirm = ?)) 
        AND user.userId = ? 
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
mysqli_stmt_bind_param($stmt, "iiiii", $userId, $chooseId, $chooseId, $userId, $chooseId);

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
    $results[] = [
        'userId' => $row['userId'],
        'name' => $row['name'],
        'profileImage' => $row['profileImage'],
        'status' => $row['status']
    ];
}

// Free resources
mysqli_free_result($result);
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Return the results
echo json_encode($results);
?>