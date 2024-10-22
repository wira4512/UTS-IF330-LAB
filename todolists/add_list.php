<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $list_name = sanitize_input($_POST['list_name']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO todo_lists (list_name, user_id) VALUES (?, ?)");
    $stmt->bind_param("si", $list_name, $user_id);
    
    if ($stmt->execute()) {
        header("Location: ../user/dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="POST" action="add_list.php">
    <input type="text" name="list_name" placeholder="List Name" required>
    <button type="submit">Create</button>
</form>
