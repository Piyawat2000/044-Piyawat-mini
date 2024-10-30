<?php
    
    include "condb.php";
    $sql = "SELECT users.*, user_info.*  
    FROM users
    LEFT JOIN user_info ON users.id = user_info.user_id
    WHERE users.id = :id";
    $smt = $conn->prepare($sql);
    $smt->execute(["id" => $_SESSION['id']]);
    $user = $smt->fetch(PDO::FETCH_ASSOC);


?>