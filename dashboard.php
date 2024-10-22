<?php
session_start();
require_once 'db.php';

// if(isset($_GET['user_id'])) {
//     $user_id = $_GET['user_id'];
// }

// $stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :user_id");
// $stmt->bindParam(':user_id', $user_id);

// $stmt->execute();

// $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach($users as $user) {
//     echo $user['username'];
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to dashboard</h1>
        <a href="logout.php">Logout</a>

    </div>
    
</body>
</html>