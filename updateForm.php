<?php
require_once 'db.php';
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    die();
}

try {

    $user_id = $_SESSION['user_id'];

    if(isset($_GET['expenses_id'])) {

        $expenses_id = $_GET['expenses_id'];

        $stmt = $db->prepare("SELECT * FROM Expenses WHERE user_id_fk = :user_id AND expenses_id = :expenses_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':expenses_id', $expenses_id);
    
        $stmt->execute();
    
        $expenses = $stmt->fetch(PDO::FETCH_ASSOC);
   
    } else {
        die("No expenses ID provided");
    }



} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Expenses</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <div class="update-container">
        <div class="tracker">
            <form action="updateExpenses.php" method="POST">
            <input type="hidden" name="expenses_id" value="<?= htmlspecialchars($expenses['expenses_id']); ?>">
            <div class="close-mark">
            <a href="dashboard.php">x</a>
            </div>
                <label for="description">Description:</label>
                <input type="text" name="description" id="description" value="<?= htmlspecialchars($expenses['description']); ?>" required>

                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" value="<?= htmlspecialchars($expenses['amount']); ?>" required>

                <label for="expense_date">Date:</label>
                <input type="date" name="expense_date" id="expense_date" value="<?= htmlspecialchars($expenses['expense_date']); ?>" required>

                <label for="category">Category:</label>
                <select name="category" id="category">
                    <option value="Food" <?= $expenses['category'] == 'Food' ? 'selected' : ''; ?>>Food</option>
                    <option value="Transport" <?= $expenses['category'] == 'Transport' ? 'selected' : ''; ?>>Transport</option>
                    <option value="Entertainment" <?= $expenses['category'] == 'Entertainment' ? 'selected' : ''; ?>>Entertainment</option>
                    <option value="Clothes" <?= $expenses['category'] == 'Clothes' ? 'selected' : ''; ?>>Clothes</option>
                    <option value="Miscellaneous" <?= $expenses['category'] == 'Miscellaneous' ? 'selected' : ''; ?>>Miscellaneous</option>
                </select>
                <button type="submit" class="update-btn">Update Expense</button>
            </form>
        </div>
    </div>
    
</body>
</html>