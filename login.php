<?php 
include ('includes/db.php');

if(isset($_POST['access'])){
  $sql1= "SELECT * FROM users where username={$_POST['username']} && password_hash={$_POST['password']}";
  $result =mysqli_query($conn,$sql1);
  
  if(mysqli_affected_rows($conn)>0){
       $row=mysqli_fetch_assoc($result);
     $_SESSION['role']=$row['role'];
     $_SESSION['id']=$row['id'];
     header("location:admin/dashboard.php");
     exit;


  }else{
    print "failed to execute";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST" action="login.php" >
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit" name="access" value="access">Login</button>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
