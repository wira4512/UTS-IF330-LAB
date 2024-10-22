<?php
session_start();
include '../includes/db_connect.php';

$list_id = (int)$_GET['list_id'];

$stmt = $conn->prepare("DELETE FROM todo_lists WHERE list_id = ?");
$stmt->bind_param("i", $list_id);

if ($stmt->execute()) {
    header("Location: ../user/dashboard.php");
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
?>
