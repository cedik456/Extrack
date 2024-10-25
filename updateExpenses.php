<?php
require_once 'db.php';
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    die();
}

try {

    $user_id = $_SESSION['user_id'];

    if(isset($_POST['expenses_id'], $_POST['description'], $_POST['amount'],
             $_POST['expense_date'], $_POST['category'])) {

       $expenses_id = $_POST['expenses_id'];
       $description = $_POST['description'];
       $amount = $_POST['amount'];
       $expense_date = $_POST['expense_date'];
       $category = $_POST['category'];

       $sql = "UPDATE Expenses SET description = :description,
                                                 amount = :amount,
                                                 expense_date = :expense_date,
                                                 category = :category
                                                 WHERE expenses_id = :expenses_id
                                                 AND user_id_fk = :user_id";

       $stmt = $db->prepare($sql);
   
       $stmt->bindParam(':description', $description);
       $stmt->bindParam(':amount', $amount);
       $stmt->bindParam(':expense_date', $expense_date);    
       $stmt->bindParam(':category', $category);
       $stmt->bindParam(':expenses_id', $expenses_id);
       $stmt->bindParam(':user_id', $user_id);
   
       $stmt->execute();
       header("Location: dashboard.php");

    } else {
        echo "<script>alert('Error Updating Expenses')</script>";
    }



} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}