<?php
require_once 'db.php';
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    die();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM Expenses WHERE user_id_fk = :user_id";

$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $user_id);

$stmt->execute();

$expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            <div class="logout">
            <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
            </div>
        </nav>
    </header>
    <div class="container">

        <div class="tracker">
            <form action="addExpenses.php" method="POST">
                <label for="description">Description:</label>
                <input type="text" name="description" id="description" required>

                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" required>

                <label for="expense_date">Date:</label>
                <input type="date" name="expense_date" id="expense_date" required>

                <label for="category">Category:</label>
                <select name="category" id="category">
                    <option value="Food">Food</option>
                    <option value="Transport">Transport</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Clothes">Clothes</option>
                    <option value="Miscellaneous" selected>Miscellaneous</option>
                </select>
                <button type="submit" class="main-btn">Add Expense</button>
            </form>
        </div>

        <div class="table">
        <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Expense Date</th>
                <th>Category</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($expenses) > 0): ?>
                <?php foreach ($expenses as $expense): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($expense['description']); ?></td>
                        <td><?php echo htmlspecialchars($expense['amount']); ?></td>
                        <td><?php echo htmlspecialchars($expense['expense_date']); ?></td>
                        <td><?php echo htmlspecialchars($expense['category']); ?></td>
                        <td>
                            <div class="btn-action-container">
                            <button class="edit-btn"><a href="updateForm.php?expenses_id=<?= $expense['expenses_id']; ?>">Edit</a></button>
                                <form action="deleteExpenses.php" method="GET">
                                <input type="hidden" name="expenses_id" value="<?php echo htmlspecialchars($expense['expenses_id']); ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?');" class="delete-btn">Delete</button>                          
                                </form>
                            </div>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No expenses found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
        </div>
    </div>

    
</body>
</html>