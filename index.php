<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    try {

        $sql = "SELECT * FROM Users WHERE email = :email;";

        $stmt = $db->prepare($sql);

        $stmt->bindParam("email", $email);
        
        if( $stmt->execute()) {
            header("Location: dashboard.php");
        } else {
            echo "<script>alert('Error')</script>";
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
    <title>Sign in</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <div class="container">
        <div class="page">
            <div class="text">
                <h1>ExpTracker</h1>
                <p>Track your expenses and finances with efficiency,</p>
                <p>Like no other than before</p>
            </div>
            <form action="" method="POST">
                <input type="text" name="email" placeholder="Email or phone number" autocomplete="off">
                <input type="password" name="password" placeholder="Password" autocomplete="off">
                <div class="login-link">
                  <button type="submit">Login</button>
                  <p><a href="signup.php" class="dha-acc">Don't have an account? <span>Sign up now</span></a></p>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>