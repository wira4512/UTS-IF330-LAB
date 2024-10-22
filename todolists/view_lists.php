<?php
session_start();
include '../includes/header.php';
include '../includes/db_connect.php';
include '../includes/functions.php';

redirect_if_not_logged_in();

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM todo_lists WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Your To-Do Lists</h2>";
if ($result->num_rows > 0) {
    while ($list = $result->fetch_assoc()) {
        echo "<p>" . sanitize_input($list['list_name']) . "</p>";
        echo "<a href='../tasks/filter.php?list_id=" . $list['list_id'] . "&status=all'>View All Tasks</a>";
        echo " | <a href='../tasks/filter.php?list_id=" . $list['list_id'] . "&status=completed'>View Completed Tasks</a>";
        echo " | <a href='../tasks/filter.php?list_id=" . $list['list_id'] . "&status=incomplete'>View Incomplete Tasks</a>";
        echo "<br><a href='../todolist/delete_list.php?list_id=" . $list['list_id'] . "' class='delete-link'>Delete List</a>";
        echo "<hr>";
    }
} else {
    echo "<p>No To-Do Lists available. <a href='../todolist/add_list.php'>Create one now!</a></p>";
}

include '../includes/footer.php';
?>
