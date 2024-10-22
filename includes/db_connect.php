<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_list_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize function to avoid XSS
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}
?>
