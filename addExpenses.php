<?php
require_once 'db.php';
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $expense_date = $_POST['expense_date'];
    $category = $_POST['category'];
   
    if(isset($_SESSION['user_id'])){
        $user_id_fk = $_SESSION['user_id'];
    } else {
        die("User not logged in");
    }

    try {

        $sql = "INSERT INTO Expenses(user_id_fk, description, amount, expense_date, category) 
                VALUES(:user_id_fk, :description, :amount, :expense_date, :category);";
    
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":expense_date", $expense_date);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":user_id_fk", $user_id_fk);
        
        if($stmt->execute()){
            header("Location: dashboard.php");
            echo "<script>alert('Added Expenses Successfully');</script>";
        } else
            echo "<script>Error</script>";


    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

}