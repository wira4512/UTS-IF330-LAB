<?php
session_start();
include '../includes/header.php';
include '../includes/db_connect.php';
include '../includes/functions.php';

redirect_if_not_logged_in();

$user_id = $_SESSION['user_id'];
$user_data = get_user_data($user_id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    if ($password) {
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $username, $email, $password, $user_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE user_id = ?");
        $stmt->bind_param("ssi", $username, $email, $user_id);
    }

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
        header("Refresh: 2");
    } else {
        echo "Error updating profile: " . $stmt->error;
    }
}
?>

<h2>Edit Profile</h2>
<form method="POST" action="profile.php">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php echo sanitize_input($user_data['username']); ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo sanitize_input($user_data['email']); ?>" required>

    <label for="password">New Password (leave blank to keep current password):</label>
    <input type="password" name="password" id="password">

    <button type="submit">Update Profile</button>
</form>

<?php include '../includes/footer.php'; ?>
