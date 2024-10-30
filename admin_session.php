<?php
if(session_status() == PHP_SESSION_NONE) session_start();

if($_SESSION['role'] != 1){
    $_SESSION['error'] = "คุณไม่ได้รับอนุญาติ";
    header('Location: index.php');
    exit();
}

?>