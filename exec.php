<?php

try{
    require_once 'db.php';

    // $db->exec("CREATE TABLE Users(user_id INTEGER PRIMARY KEY AUTOINCREMENT ,username TEXT ,email TEXT, password TEXT)");

    // $db->exec("INSERT INTO users(username,email,password) VALUES('ced','ced@gmail.com','hiItsMe256');");

    print "<table border=1>";

    print "<tr>
          <td>ID</td>  
          <td>Name</td>  
          <td>Email</td>  
          <td>Password</td>  
           
          </tr>";

    $result = $db->query('SELECT * FROM Users');

    foreach($result as $row) {
        
        
        print "<td>".$row['user_id']."</td>";
        print "<td>".$row['username']."</td>";
        print "<td>".$row['email']."</td>";
        print "<td>".$row['password']."</td></tr>";
    };

    print "</table>";

}catch(PDOException $e) {
    echo $e->getMessage();
}

?>