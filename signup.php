<?php
require_once 'db.php';
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        
        $hashedPass = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO Users(username,email,password) 
                VALUES(:username, :email, :password);";
    
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPass);
        
        if($stmt->execute()){
            // echo "<script>alert('Successful')</script>";
            header("Location: index.php");
        } else
            echo "<script>Error</script>";


    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <h1 class="signup-title">Signup</h1>
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" required autocomplete="off">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required autocomplete="off">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <div class="login-link">
                <button type="submit">Signup</button>
                <a href="index.php" class="already-acc">Already have an account?</a>
            </div>
        </form>
    </div>
    
</body>
</html>