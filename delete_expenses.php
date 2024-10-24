<?php
require_once 'db.php';
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    die();
}

if(isset($_GET['expenses_id'])) {
    $expenses_id = $_GET['expenses_id'];

    try {

        $stmt = $db->prepare("DELETE FROM Expenses WHERE expenses_id = :expenses_id AND user_id_fk = :user_id");
        $stmt->bindParam(':expenses_id', $expenses_id);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
    
        if($stmt->execute()) {
            header("Location: dashboard.php");
        } else {
            echo "<script>alert('Error Deleting Expenses')</script>";
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }


} else {
    echo "No expenses ID provided";
}