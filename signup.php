<?php
require_once 'db.php';
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {

        $checkSql = "SELECT COUNT(*) FROM Users WHERE username = :username OR email = :email";

        $checkStmt = $db->prepare($checkSql);
        $checkStmt->bindParam(":username", $username);
        $checkStmt->bindParam(":email", $email);
        $checkStmt->execute();
        
        $userExists = $checkStmt->fetchColumn() > 0;

        if ($userExists) {
            echo "<script>alert('Username or email is already taken.')</script>";
        } else {
            
            $hashedPass = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO Users(username, email, password) VALUES(:username, :email, :password)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashedPass);

            if($stmt->execute()){
                header("Location: index.php");
                exit(); 
            } else {
                echo "<script>alert(Error during registration)</script>";
            }
        }
        
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