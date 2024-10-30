<?php

include "condb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ensure $user_table is defined and properly sanitized
    $sql = "SELECT * FROM $user_table WHERE email = :email";
    $smt = $conn->prepare($sql);
    $smt->bindParam(":email", $email); 
    $smt->execute();
    $row = $smt->fetch(PDO::FETCH_ASSOC);
    
    // Check if the user exists and if the password matches
    if ($row && password_verify($password, $row['password'])) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(is_null($user['avatar']))
        // Store user data in the session
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        $sql1 = "SELECT * FROM user_info WHERE user_id = :user_id";
        $smt1 = $conn->prepare($sql1);
        $smt1->bindParam(":user_id", $_SESSION['id']); 
        $smt1->execute();
        $user = $smt1->fetch(PDO::FETCH_ASSOC);
        $img = "https://firebasestorage.googleapis.com/v0/b/loginsys-b8d67.appspot.com/o/images.png?alt=media&token=530d5d10-49a2-42c2-9be3-77ed7ace364f";
        if(!is_null($user['avatar'])){
          $img = "img/".$user['avatar'];  
        }
        $_SESSION['avatar'] = $img;
        echo "<script>console.log('Login Successfully');</script>";
        header("Location: index.php");
        exit(); // Ensure no further output after redirect
     
    }else{
        header("Location: login.php");
    }

}

?>
