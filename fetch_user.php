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