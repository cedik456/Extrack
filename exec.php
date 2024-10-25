<?php

try{
    require_once 'db.php';

    // $db->exec("CREATE TABLE Users(
                //    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
                //    username TEXT,
                //    email TEXT,
                //    password TEXT)");

    // $db->exec("INSERT INTO users(username,email,password) 
               // VALUES('ced','ced@gmail.com','hiItsMe256');");

    // $db->exec("CREATE TABLE Expenses(
    //             expenses_id INTEGER PRIMARY KEY AUTOINCREMENT,
    //             user_id_fk INTEGER,
    //             description TEXT NOT NULL,
    //             amount REAL NOT NULL,
    //             expense_date TEXT NOT NULL,
    //             category TEXT NOT NULL DEFAULT 'Miscellaneous',
    //             FOREIGN KEY (user_id_fk) REFERENCES Users(user_id) ON DELETE CASCADE
    //             )");


    echo "<table border=1>";

    echo "<tr>
          <td>User Id</td>  
          <td>Username</td>  
          <td>Email</td>  
          <td>Password</td>  
           
          </tr>";

    $result = $db->query('SELECT * FROM Users');

    foreach($result as $row) {
        
        
        echo "<td>".$row['user_id']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['password']."</td> </tr>";
        // echo "<td>".$row['amount']."</td>";
        // echo "<td>".$row['expense_date']."</td>";
        // echo "<td>".$row['category']."</td></tr>";
    };

    echo "</table>";

}catch(PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}

?>