<?php 
 include 'includes/db.php';



?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>User Registration</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="form-container">
        <h2>Register</h2>
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>First Name:</label>
            <input type="text" name="firstname">
            <label>Last Name:</label>
            <input type="text" name="lastname">
            <label>Address:</label>
            <input type="text" name="address">
            <label>Age:</label>
            <input type="number" name="age">
            <label>Sex:</label>
            <select name="sex">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <label>Profile Picture:</label>
            <input type="file" name="file">
            <button type="submit" value="create" name="create">Register</button>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
