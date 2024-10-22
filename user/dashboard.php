<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/header.php';
include '../includes/db_connect.php';

// Fetch user's to-do lists
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM todo_lists WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Your To-Do Lists</h2>";
while ($list = $result->fetch_assoc()) {
    echo "<p>" . sanitize_input($list['list_name']) . "</p>";
    echo "<a href='../tasks/search.php?list_id=" . $list['list_id'] . "'>Search Tasks</a>";
    echo "<a href='delete_list.php?list_id=" . $list['list_id'] . "' class='delete-link'>Delete List</a>";
}

?>

<a href="add_list.php">Create New To-Do List</a>
<a href="profile.php">Edit Profile</a>

<?php include '../includes/footer.php'; ?>
