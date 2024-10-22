<?php
include 'db_connect.php';

// Fungsi untuk menghindari XSS pada input pengguna
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Fungsi untuk memeriksa apakah pengguna telah login
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Fungsi untuk mendapatkan data pengguna yang sedang login
function get_user_data($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT username, email FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Fungsi untuk mengalihkan pengguna jika belum login
function redirect_if_not_logged_in() {
    if (!is_logged_in()) {
        header("Location: ../user/login.php");
        exit();
    }
}
?>
