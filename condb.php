<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'db_634230044';//ชื่อ ฐานข้อมูล
$table = 'tb_shoesProduct'; //ชื่อ table
$user_table = 'users';
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password); //เชื่อมต่อฐานข้อมูล

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //   echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
    } catch (PDOException $e) {
      echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage();
    }
?>