<?php
session_start();
include '../includes/header.php';
include '../includes/db_connect.php';
include '../includes/functions.php';

redirect_if_not_logged_in();

$list_id = (int)$_GET['list_id'];
$status_filter = sanitize_input($_GET['status']);  // 'all', 'completed', 'incomplete'

$sql = "SELECT * FROM tasks WHERE list_id = ?";
if ($status_filter == 'completed') {
    $sql .= " AND completed = 1";
} elseif ($status_filter == 'incomplete') {
    $sql .= " AND completed = 0";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $list_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Tasks Filtered by Status</h2>";
while ($task = $result->fetch_assoc()) {
    echo "<p>" . sanitize_input($task['task_name']) . " - " . ($task['completed'] ? "Completed" : "Incomplete") . "</p>";
}

include '../includes/footer.php';
?>
