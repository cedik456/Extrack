<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    try {

        $sql = "SELECT * FROM Users WHERE email = :email;";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":email", $email);
      
        
        if($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result && password_verify($password, $result["password"])) {

                session_start();
                $_SESSION['user_id'] = $result['user_id'];
                header("Location: dashboard.php");

            } else {
                echo "<script>alert('Invalid email or password')</script>";
            }

        } else {
            echo "<script>alert('Error query')</script>";
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
                <h1>Extrack</h1>
                <p>Track your expenses and finances with efficiency,</p>
                <p>Like no other than before</p>
            </div>
            <form action="" method="POST">
                <input type="text" name="email" placeholder="Email or phone number" autocomplete="off" required>
                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <div class="login-link">
                  <button type="submit">Login</button>
                  <p><a href="signup.php" class="dha-acc">Don't have an account? <span>Sign up now</span></a></p>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>