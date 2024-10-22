<?php
include '../includes/header.php';
include '../includes/db_connect.php';

$list_id = (int)$_GET['list_id'];
$query = sanitize_input($_GET['query']);

$stmt = $conn->prepare("SELECT * FROM tasks WHERE list_id = ? AND task_name LIKE ?");
$search_query = "%" . $query . "%";
$stmt->bind_param("is", $list_id, $search_query);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Search Results</h2>";
while ($task = $result->fetch_assoc()) {
    echo "<p>" . sanitize_input($task['task_name']) . " - " . ($task['completed'] ? "Completed" : "Incomplete") . "</p>";
}

include '../includes/footer.php';
?>
