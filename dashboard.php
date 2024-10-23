<?php
session_start();
require_once 'db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    die();
}

$user_id = $_SESSION['user_id'];

$stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);

$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <header>
        <nav>
            <div class="title">
                <h1>Extrack</h1>
            </div>
            <div>
                <p><?php echo $user['email'] ?></p>

            </div>
        </nav>
    </header>
    <div class="container">
        <!-- <div class="tracker">
            <form action="">
                <input type="text">
                <input type="text">
                <input type="text">
                <input type="text">
            </form>
        </div>
        <div class="contents">
            <h1>Contents of the </h1>
            <a href="logout.php">Logout</a>
        </div> -->

    </div>
    
</body>
</html>