<?php
include '../includes/db.php';
session_start();
// // 
// Check if the logged-in user is an admin
if ($_SESSION['role'] !== 'admin') {
    echo "Access denied. Admins only.";
    exit();
}

// Update user role if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['new_role'])) {
    $userId = $_POST['user_id'];
    $newRole = $_POST['new_role'] === 'admin' ? 'user' : 'admin';

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $newRole, $userId);

    if ($stmt->execute()) {
        echo "User role updated successfully.";
    } else {
        echo "Error updating user role: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all users from the database
$result = $conn->query("SELECT id, username, role FROM users");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h2>Manage Users</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <form method="POST" action="manage_users.php">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <input type="hidden" name="new_role" value="<?php echo $user['role']; ?>">
                            <button type="submit">
                                Change to <?php echo $user['role'] === 'admin' ? 'User' : 'Admin'; ?>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>

<?php
$result->close();
$conn->close();
?>
